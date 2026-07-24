<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder {
    public function run(): void {
        // create super admin
            DB::table('departments')->truncate();
            $department = [
                'customer_id' => NULL,
                'hospital_id' => NULL,
                'firm_id' => NULL,
                'department_id' => generateDepartmentId(),
                'name' => 'Administrator',
                'description' => 'Super Admin department',
                'status' => 1,
                'updated_at' => NULL
            ];
            $dapartmentId = DB::table('departments')->insertGetId($department);
            DB::table('users')->truncate();

            $userData = [
                'customer_id' => NULL,
                'hospital_id' => NULL,
                'firm_id' => NULL,
                'department_id' => $dapartmentId,
                'user_id' => generateUniqueUserId(),
                'senior_user_id' => 1,
                'fname' => 'Super',
                'lname' => 'Admin',
                'username' => generateUniqueUsername('superadmin@hms.in'),
                'phone' => secure('9415058209', 'E'),
                'email' => secure('superadmin@hms.in', 'E'),
                'password' => Hash::make('admin'),
                'default_password' => 'admin',
                'gender' => 'male',
                'user_type' => 1,
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ];
            $userId = DB::table('users')->insertGetId($userData);

            DB::table('roles')->truncate();
            $roleData = [
                'customer_id' => NULL,
                'hospital_id' => NULL,
                'firm_id' => NULL,
                'name' => 'Super Admin',
                'code' => 'super_admin',
                'role_priority' => 100,
                'protected_role' => 0,
                'scope' => 0,
                'is_system' => 0,
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => NULL
            ];
            $roleId = DB::table('roles')->insertGetId($roleData);

            DB::table('user_roles')->truncate();
            $mappingData = [
                'user_id' => $userId,
                'role_id' => $roleId
            ];
            DB::table('user_roles')->insert($mappingData);
        // end super admin creation


        // create admin 
            $secondUserData = [
                'customer_id' => NULL,
                'hospital_id' => NULL,
                'firm_id' => NULL,
                'department_id' => $dapartmentId,
                'user_id' => generateUniqueUserId(),
                'senior_user_id' => 1,
                'fname' => 'Komal',
                'lname' => 'Mishra',
                'username' => generateUniqueUsername('admin@hms.in'),
                'phone' => '9415058209',
                'email' => 'admin@hms.in',
                'password' => Hash::make('admin'),
                'default_password' => 'admin',
                'gender' => 'male',
                'user_type' => 1,
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ];
            $secondUserId = DB::table('users')->insertGetId($secondUserData);

            $secondRoleData = [
                'customer_id' => NULL,
                'hospital_id' => NULL,
                'firm_id' => NULL,
                'name' => 'Admin',
                'code' => 'admin',
                'role_priority' => 90,
                'protected_role' => 0,
                'scope' => 0,
                'is_system' => 0,
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => NULL
            ];
            $secondRoleId = DB::table('roles')->insertGetId($secondRoleData);
            $secondMappingData = [
                'user_id' => $secondUserId,
                'role_id' => $secondRoleId
            ];
            DB::table('user_roles')->insert($secondMappingData);
        // end create admin 
    }
}


