<?php

namespace App\Traits;

use Exception;
use Throwable;
use App\Models\Logs;
use App\Models\User;
use App\Mail\OtpVerified;
use App\Models\Admin\LoginOtp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait QueryTrait {
    public function routePermission() {
        try {
            $user = Auth::user();
            // Super Admin ko by default sabhi permission dena
            $role = DB::table('roles')->where('id', $user->role_id)->first();
            if ($role && $role->slug === 'super_admin') {
                return DB::select('SELECT app_url AS route_url FROM permissions');
                
            } else {
                // Normal role ke liye jo assign kiya gaya hai wahi permission milega
                return DB::select("SELECT rp.route_url 
                    FROM users us 
                    JOIN role_permission rp ON rp.role_id = us.role_id 
                    WHERE us.id = ?
                ", [$user->id]);

            }


        } catch(\Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }


    public function allAssignedPermission() {
        try {
            return DB::select("SELECT id, role_id, role_name, 
                            GROUP_CONCAT(permission_name SEPARATOR ',') AS permission_name
                            FROM role_permission
                            GROUP BY role_id, role_name
                            ORDER BY permission_name ASC
                ");

        } catch(\Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }


    public function allPermission() {
        try {
            return DB::select("SELECT id, 
                            module_id, 
                            module_name, 
                            GROUP_CONCAT(name SEPARATOR ',') AS permission_names, 
                            GROUP_CONCAT(id SEPARATOR ',') AS permission_ids
                        FROM permissions 
                        GROUP BY module_id, module_name
                    ");

        } catch(\Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }
    

    public function getSystemRoles() {
        try {
            // JSON_ARRAYAGG tab lete hai different different array me value lena ho;
            // $roles = DB::select("SELECT
                //                     (SELECT JSON_ARRAYAGG( 
                //                             JSON_OBJECT(
                //                                 'id', id,
                //                                 'firm_id', firm_id,
                //                                 'customer_id', customer_id,
                //                                 'hospital_id', hospital_id,
                //                                 'name', name,
                //                                 'code', code,
                //                                 'is_system', is_system,
                //                                 'scope', scope
                //                             )
                //                         )
                //                         FROM roles
                //                         WHERE status = 1
                //                         AND scope = 0
                //                         AND is_system = 0
                //                     ) AS system_roles,
                //                     (SELECT JSON_ARRAYAGG(
                //                         JSON_OBJECT(
                //                             'id', id,
                //                             'firm_id', firm_id,
                //                             'customer_id', customer_id,
                //                             'hospital_id', hospital_id,
                //                             'name', name,
                //                             'code', code,
                //                             'is_system', is_system,
                //                             'scope', scope
                //                         )
                //                     )
                //                         FROM roles
                //                         WHERE status = 1
                //                         AND scope = 1
                //                         AND is_system = 1
                //                     ) AS customer_roles;
            // ");

            // foreach ($roles as $role) {
                //     match (true) { // jab ek se jada condition ho like (is_system,scope) tab match(true) karna hota hai
                //         $role->is_system == 0 && $role->scope == 0 && $role->customer_id == NULL
                //             => $systemRoles[] = $role,

                //         $role->is_system == 1 && $role->scope == 1 && $role->customer_id == auth()->user()->customer_id
                //             => $customerRoles[] = $role,

                //         default => null,
                //     };
            // }
            $user = auth()->user();
            $loggedInRole = DB::table('user_roles')
                ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                ->where('user_roles.user_id', $user->id)
                ->value('roles.code');

            $query = DB::table('roles')
                ->select('id', 'name', 'code', 'is_system', 'scope', 'customer_id', 'hospital_id', 'firm_id')
                ->where('status', 1)
                ->where('is_system', 0)
                ->where('scope', 0);
            
            // Agar Super Admin nahi hai to Super Admin role hide kar do
            if ($loggedInRole !== 'RS_10001') {
                $query->where('code', '!=', 'RS_10001');
            }

            return $query->get();

        } catch(Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }

    public function getCustomerRoles() {
        try {
            $loggedInUser = auth()->user();
            $accessLevel = Role::where('id', $loggedInUser->role_id)->value('access_level');
            
            $customers = DB::select("SELECT id, name, code, is_system, scope, customer_id, hospital_id, firm_id
                                FROM roles WHERE status = 1 AND is_system = 1
                                AND scope = 1 AND customer_id = ? AND access_level != 1
                            ", [$loggedInUser->customer_id]
            );

            foreach($customers as $role) {
                if($accessLevel->access_level == 1) {
                    $customerRoles[] = $role;

                } elseif ($accessLevel->access_level == 2 && $role->hospital_id == $loggedInUser->hospital_id && $role->firm_id == $loggedInUser->firm_id ) { // Customer Admin hide
                    $customerRoles[] = $role;
                }
            }
            return $customerRoles;
        } catch(Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }

    public function getSubject() {
        try {
            // return DB::select("SELECT ss.id, ss.subject_name, GROUP_CONCAT(its.interview_name) interview_name, GROUP_CONCAT(its.interview_time) interview_time,
            //                     GROUP_CONCAT(its.interview_date) interview_date FROM subjects ss 
            //                     JOIN subject_interviews its on its.subject_id = ss.id 
            //                     GROUP BY ss.id
            //                     ORDER BY id DESC
            //       ");

            return DB::select("SELECT ss.id, its.id it_id, ss.subject_name, its.interview_name interview_name, its.interview_time interview_time,
                                its.interview_date interview_date, ss.created_by FROM subjects ss 
                                JOIN subject_interviews its on its.subject_id = ss.id
                                WHERE its.deleted_at IS NULL
                                ORDER BY ss.id DESC
                  ");
        } catch(Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }
}