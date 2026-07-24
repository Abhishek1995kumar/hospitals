<?php

namespace App\Helpers;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionHelper {
    public static function hasPermission($permissionAction) {
        try {
            $user = auth()->user();
            if (!$user) {
                return false;
            }
            
            $isSystem = empty($user->customer_id);

            $query = DB::table('user_roles')
                        ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                        ->where('user_roles.user_id', $user->id)
                        ->select('roles.id', 'roles.code');
            if($isSystem) {
                $query->whereNull('user_roles.customer_id');
            } else {
                $query->where('user_roles.customer_id', $user->customer_id);
            }

            $roles = $query->get();

            if ($roles->isEmpty()) {
                return false;
            }

            // Super Admin ko database permission bypass direct allow karein
            foreach ($roles as $role) {
                if ($role->code === 'super_admin') {
                    return true;
                }
            }
            
            $rolesIds = $roles->pluck('id')->toArray();
            
            $permissionQuery = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->whereIn('role_permissions.role_id', $rolesIds) // multiple roles ke liye whereIn jaruri hai
                ->where('permissions.action', $permissionAction); // database array key check fix kiya

            if ($isSystem) {
                return $permissionQuery->whereNull('role_permissions.customer_id')->exists();
            } else {
                return $permissionQuery->where('role_permissions.customer_id', $user->customer_id)->exists();
            }

        } catch (Throwable $th) {
            Log::error('Permission Error: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            return false;
        }
    }

    
    public static function afterLoginGenerateAuthUserSession($result) {
        try {
            // ye session ke liye hai
            $userData = DB::table('users as u')
                            ->join('user_roles as ur', 'ur.user_id', '=', 'u.id')
                            ->join('roles as r', 'r.id', '=', 'ur.role_id')
                            ->leftJoin('customers as c', 'c.id', '=', 'u.customer_id')
                            ->leftJoin('plans as p', 'p.id', '=', 'c.current_plan_id')
                            // Latest active subscription ke liye subquery se join karein taaki duplicate records na banein
                            ->leftJoin('customer_subscriptions as cs', function($join) {
                                $join->on('cs.customer_id', '=', 'c.id')
                                    ->where('cs.status', '=', 1);
                            })
                            ->leftJoin('hospitals as h', function($join) {
                                $join->on('h.id', '=', 'u.hospital_id')
                                    ->on('h.customer_id', '=', 'u.customer_id');
                            })
                            ->leftJoin('firms as f', function($join) {
                                $join->on('f.id', '=', 'u.firm_id')
                                    ->on('f.hospital_id', '=', 'h.id')
                                    ->on('f.customer_id', '=', 'c.id');
                            })
                            ->where('u.id', $result->id)
                            ->select(
                                'u.id', 'u.customer_id', 'u.hospital_id', 'u.firm_id', 'u.user_id', 'u.is_system', 'u.email', 'u.phone', 'u.user_type',
                                DB::raw("CONCAT(u.fname, ' ', u.lname) AS user_name"),
                                // Multiple roles ke liye Group Concat (Comma separated milega: e.g. "Admin, Doctor")
                                DB::raw("GROUP_CONCAT(r.name) as role_names"),
                                DB::raw("GROUP_CONCAT(r.code) as role_codes"),
                                DB::raw("MAX(r.is_full_access) as is_full_access"),

                                'c.customer_name', 'c.max_hospitals', 'c.max_users', 'c.max_firms', 
                                'c.subscription_status', 'c.last_payment_date', 'c.next_billing_date', 'c.logo as customer_logo',
                                
                                'cs.invoice_no', 'cs.transaction_id', 'cs.amount', 'cs.start_date', 'cs.end_date', 'cs.payment_gateway', 'cs.payment_status',
                                
                                'p.plan_name', 'p.duration_days',
                                
                                'h.name as hospital_name', 'h.registration_no', 'h.license_no', 'h.hospital_id as hospital_slug', 
                                'h.phone as hospital_number', 'h.total_beds', 'h.total_icu_beds', 'h.total_operation_theatres', 
                                'h.total_ambulances', 'h.total_wards', 'h.logo as hospital_logo', 'h.opening_time', 'h.closing_time',
                                
                                'f.name as firm_name', 'f.firm_id', 'f.address as firm_address'
                            )
                            ->groupBy(
                                'u.id', 'u.customer_id', 'u.hospital_id', 'u.firm_id', 'u.user_id', 'u.is_system', 'u.email', 'u.phone', 'u.user_type', 'u.fname', 'u.lname',
                                'c.customer_name', 'c.max_hospitals', 'c.max_users', 'c.max_firms', 'c.subscription_status', 'c.last_payment_date', 'c.next_billing_date', 'c.logo',
                                'cs.invoice_no', 'cs.transaction_id', 'cs.amount', 'cs.start_date', 'cs.end_date', 'cs.payment_gateway', 'cs.payment_status',
                                'p.plan_name', 'p.duration_days',
                                'h.name', 'h.registration_no', 'h.license_no', 'h.hospital_id', 'h.phone', 'h.total_beds', 'h.total_icu_beds', 'h.total_operation_theatres', 'h.total_ambulances', 'h.total_wards', 'h.logo', 'h.opening_time', 'h.closing_time',
                                'f.name', 'f.firm_id', 'f.address'
            )->first();

            return $userData;

            // agar redis cache ka use karna ho tab
            // $userId = Auth::id(); // Logged-in user ki ID
            // $cacheKey = 'user_cache_' . $userId;
            // $redisData = Cache::remember($cacheKey, now->addHours(48), function() use ($userId) {
            //     DB::table('users as u')
            //         ->join('user_roles as ur', 'ur.user_id', '=', 'u.id')
            //         ->join('roles as r', 'r.id', '=', 'ur.role_id')
            //         ->leftJoin('customers as c', 'c.id', '=', 'u.customer_id')
            //         ->leftJoin('hospitals as h', function($join) {
            //             $join->on('h.id', '=', 'u.hospital_id')
            //                 ->on('h.customer_id', '=', 'u.customer_id');
            //         })
            //         ->leftJoin('firms as f', function($join) {
            //             $join->on('f.id', '=', 'u.firm_id')
            //                 ->on('f.hospital_id', '=', 'h.id')
            //                 ->on('f.customer_id', '=', 'c.id');
            //         })
            //         ->where('u.id', $userId)
            //         ->select(
            //             'u.id', 'u.user_id', 'u.is_system', 'u.email', 'u.phone', 'u.user_type',
            //             DB::raw("CONCAT(u.fname, ' ', u.lname) AS user_name"),
            //             'r.name as role_name', 'r.code as role_code', 'r.is_full_access',
            //             'c.customer_name', 'c.max_hospitals', 'c.max_users', 'c.max_firms',
            //             'h.name as hospital_name', 'h.registration_no',
            //             'f.name as firm_name'
            //     )->first();
            // })
        } catch (Throwable $th) {
            Log::error('Permission Error: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            return false;
        }
    }



}