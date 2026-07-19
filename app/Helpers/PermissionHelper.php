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

            if ($isSystem) {
                $query->whereNull('user_roles.customer_id');
            } else {
                $query->where('user_roles.customer_id', $user->customer_id);
            }

            $roles = $query->get();

            if ($roles->isEmpty()) {
                return false;
            }

            // Super Admin aur Customer Admin ko database permission bypass direct allow karein
            foreach ($roles as $role) {
                if ($role->code === 'super_admin' || $role->code === 'customer_admin') {
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
}