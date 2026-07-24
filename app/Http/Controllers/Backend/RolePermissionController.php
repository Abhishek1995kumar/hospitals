<?php

namespace App\Http\Controllers\backend;

use Throwable;
use App\Traits\QueryTrait;
use App\Models\Backend\Role;
use Illuminate\Http\Request;
use App\Models\Backend\Module;
use App\Traits\ValidationTrait;
use App\Models\Backend\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Backend\RolePermission;

class RolePermissionController extends Controller {
    use ValidationTrait, QueryTrait;
    public function index() {
        try {
            $user = auth()->user();
            $modules = DB::table('modules')
                        ->where('status', 1)
                        ->whereNull('parent_id')
                        ->orderBy('name')
                        ->select('name', 'id')
                        ->get();
        
            $loggedInRoles = DB::table('user_roles')
                                ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                                ->join('users', 'users.id', '=', 'user_roles.user_id')
                                ->where('user_roles.user_id', $user->id)
                                ->select('roles.id', 'roles.code', 'roles.is_system', 'roles.scope', 'roles.customer_id', 'roles.hospital_id', 'roles.firm_id', 'roles.is_full_access', 'users.user_type')
                                ->get();
            if ($loggedInRoles->isEmpty()) {
                return redirect()->back()->with('error', 'Aapko koi role assigned nahi hai.');
            }

            // Arrays ko empty collections se initialize karein
            $roles = ['system' => collect(), 'customer' => collect()];
            $permissions = ['system' => collect(), 'customer' => collect()];
            $users = ['system' => collect(), 'customer' => collect()];

            $roleCodes = $loggedInRoles->pluck('code')->toArray(); // Saare assigned roles ke codes aur flags nikalen
            
            $userCustomerId = $user->customer_id;  // Shart 4 & 5: Pata karein ki user System (Project Owner) ka hai ya Client (Customer) ka Hum user ke tables ke static customer_id par trust karenge taaki cross-access na ho
            // SCENARIO A: User System/Project Owner ki Company ka hai
            if (empty($userCustomerId)) {
                $status = 1;
                $query ="SELECT r.id, r.name, r.is_full_access, CONCAT(u.fname, ' ', u.lname) user_name
                                FROM roles r
                                JOIN user_roles ur ON ur.role_id = r.id 
                                JOIN users u ON u.id = ur.user_id
                                WHERE r.status = ?";
                $binding = [$status]; 
                if(!in_array('super_admin', $roleCodes)) {
                    $query .= " AND r.code != ?";
                    $binding[] = 'super_admin';
                }
                $roles['system'] = DB::select($query, $binding);
                $systemPerms = DB::table('permissions')
                                ->leftJoin('modules', 'modules.id', '=', 'permissions.module_id')
                                ->where('permissions.status', 1)
                                ->select('permissions.id', 'modules.name as module_name', 'permissions.name')
                                ->get();
                $permissions['system'] = $systemPerms->groupBy('module_name');
                
                // System Users (Sirf project owner ki company ke log)
                $systemUser = DB::table('users')
                                ->select('id', 'fname', 'lname', 'user_type')
                                ->where('status', 1)
                                ->whereNull('customer_id');

                if(!in_array('super_admin', $roleCodes)) {
                    $systemUser->where('user_type', '!=', 1);
                }
                $users['system'] = $systemUser->get();
            } 
            
            // SCENARIO B: User kisi Client/Customer (Tenant) ka employee hai
            else {
                // Shart 2 & 3: Ek customer ka employee apne hi customer_id ka data dekhega. Agar uske multiple roles hain (Hospital A aur Hospital B ke), toh hum un saare hospitals ki IDs nikalenge.
                $hospitalIds = $loggedInRoles->pluck('hospital_id')->filter()->unique();
                $firmIds = $loggedInRoles->pluck('firm_id')->filter()->unique();

                $customerQuery = DB::table('roles')
                            ->select('id', 'name', 'is_full_access')
                            ->where('status', 1)
                            ->where('is_system', 1)
                            ->where('scope', 1)
                            ->where('customer_id', $userCustomerId); // Strictly locked to his own customer

                // Shart 3: Agar user 'customer_admin' hai, toh usko pure customer/client ke saare hospitals ka access do. Agar customer_admin nahi hai, toh sirf unhi hospitals/firms ka data dikhao jinka use role mila hua hai.
                if (!in_array('customer_admin', $roleCodes)) {
                    $customerQuery->where('code', '!=', 'customer_admin')
                        ->whereIn('hospital_id', $hospitalIds)
                        ->whereIn('firm_id', $firmIds);
                }
                $roles['customer'] = $customerQuery->get();

                // Customer Users (Sirf isi customer ke employees)
                $customerUsersQuery = DB::table('users')
                    ->select('id', 'fname', 'lname', 'user_type')
                    ->where('status', 1)
                    ->where('customer_id', $userCustomerId);
                
                // Agar employee pure customer ka admin nahi hai, toh users list bhi wahi dikhao jo uske mapped hospitals mein hain
                if (!in_array('customer_admin', $roleCodes)) {
                    $customerUsersQuery->whereIn('hospital_id', $hospitalIds);
                }

                $users['customer'] = $customerUsersQuery->get();
            }
            
            return view('backend.settings.permission.index', [
                'roles' => $roles,
                'permissions' => $permissions,
                'users' => $users,
                'modules' => $modules
            ]);

        } catch(\Throwable $th) {
            Log::error('Permission Index Error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Kuch error aayi hai. Kripya logs check karein.');
        }
    }


    public function authenticationList(Request $request) {
        try {
            if (!$request->filled('type')) {
                return json_response(false, 400, 'List type is required');
            }
            
            $user = auth()->user();
            
            // 1. Logged-in user ke saare roles fetch karein (Collection milega)
            $loggedInRoles = DB::table('user_roles')
                            ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                            ->where('user_roles.user_id', $user->id)
                            ->select('roles.code', 'roles.is_system', 'roles.scope', 'roles.customer_id', 'roles.hospital_id', 'roles.firm_id')
                            ->get();

            if ($loggedInRoles->isEmpty()) {
                return json_response(false, 403, 'Aapko koi role assigned nahi hai.');
            }

            $roleCodes = $loggedInRoles->pluck('code')->toArray(); // 2. Flags aur IDs nikalen multiple roles ko handle karne ke liye
            
            // Check karein kya user ke paas system role hai ya customer role
            $isSystemUser = $loggedInRoles->where('is_system', 0)->where('scope', 0)->isNotEmpty();
            $isCustomerUser = $loggedInRoles->where('is_system', 1)->where('scope', 1)->isNotEmpty();

            // Customer user ke case mein saare unique customer, hospital aur firm IDs nikalein
            $customerId = $loggedInRoles->pluck('customer_id')->filter()->first(); // Ek user ek hi customer ka employee hoga
            $hospitalIds = $loggedInRoles->pluck('hospital_id')->filter()->unique()->toArray();
            $firmIds = $loggedInRoles->pluck('firm_id')->filter()->unique()->toArray();

            $data = [];
            $message = '';

            switch ($request->type) {
                case 'role':
                    if ($isSystemUser) {
                        $system = DB::table('roles')
                            ->select('id', 'name', 'code', 'is_system', 'scope', 'customer_id', 'hospital_id', 'firm_id', 'role_priority')
                            ->where('status', 1)
                            ->where('is_system', 0)
                            ->where('scope', 0);

                        // Agar roles mein 'super_admin' nahi hai, toh super_admin role hide kar do
                        if (!in_array('super_admin', $roleCodes)) {
                            $system->where('code', '!=', 'super_admin');
                        }
                        $data['system'] = $system->get();

                    } elseif ($isCustomerUser) {
                        $customer = DB::table('roles')
                            ->select('id', 'name', 'code', 'is_system', 'scope', 'customer_id', 'hospital_id', 'firm_id', 'role_priority')
                            ->where('status', 1)
                            ->where('is_system', 1)
                            ->where('scope', 1)
                            ->where('customer_id', $customerId);

                        // Agar user 'customer_admin' NAHI hai, toh sirf uske assigned hospitals/firms ke roles dikhao
                        if (!in_array('customer_admin', $roleCodes)) {
                            $customer->whereIn('hospital_id', $hospitalIds)
                                    ->whereIn('firm_id', $firmIds)
                                    ->where('code', '!=', 'customer_admin');
                        } 
                        $data['customer'] = $customer->get();
                    }
                    $message = 'Roles fetched successfully';
                    break;

                case 'permission':
                    $data['system'] = DB::table('permissions')
                        ->leftJoin('modules', 'modules.id', '=', 'permissions.module_id')
                        ->select('permissions.id', 'modules.name as modules_name', 'permissions.name', 'permissions.action')
                        ->where('permissions.status', 1)
                        ->get();
                    $message = 'Permissions fetched successfully';
                    break;

                case 'rolePermission':
                    if ($isSystemUser) {
                        $data['system'] = DB::table('role_permissions')
                                    ->leftJoin('roles', 'roles.id', '=', 'role_permissions.role_id')
                                    ->leftJoin('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                                    ->select('role_permissions.id', 'roles.name as role_name', 'permissions.action as permission_action', 'roles.customer_id', 'role_permissions.customer_id')
                                    ->whereNull('role_permissions.customer_id')
                                    ->get();
                    
                    } elseif ($isCustomerUser) {
                        $data['customer'] = DB::table('role_permissions')
                                    ->leftJoin('roles', 'roles.id', '=', 'role_permissions.role_id')
                                    ->leftJoin('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                                    ->select('role_permissions.id', 'roles.name as role_name', 'permissions.action as permission_action', 'roles.customer_id', 'role_permissions.customer_id')
                                    ->where('role_permissions.customer_id', $customerId)
                                    ->get();
                    }
                    $message = 'Role permissions fetched successfully';
                    break;

                case 'roleUser':
                    if ($isSystemUser) {
                        $data['system'] = DB::table('user_roles')
                                    ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
                                    ->leftJoin('users', 'users.id', '=', 'user_roles.user_id')
                                    ->select('user_roles.id', 'roles.name as role_name', 'users.fname', 'users.lname', 'user_roles.customer_id')
                                    ->whereNull('user_roles.customer_id')
                                    ->get();

                    } elseif ($isCustomerUser) {
                        $data['customer'] = DB::table('user_roles')
                                    ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
                                    ->leftJoin('users', 'users.id', '=', 'user_roles.user_id')
                                    ->select('user_roles.id', 'roles.name as role_name', 'users.fname', 'users.lname', 'user_roles.customer_id')
                                    ->where('user_roles.customer_id', $customerId)
                                    ->get();
                    }
                    
                    $message = 'User role fetched successfully';
                    break;

                case 'module':
                    $data['parentModules'] = DB::table('modules')
                        ->where('status', 1)
                        ->whereNull('parent_id')
                        ->get();

                case 'child-module':
                    $data['childModules'] = DB::table('modules')
                        ->join('modules as mp', 'mp.id', '=', 'modules.parent_id')
                        ->where('modules.status', 1)
                        ->whereNotNull('modules.parent_id')
                        ->select('modules.id', 'mp.name as parent_name', 'modules.name')
                        ->get();
                    
                    $message = 'User role fetched successfully';
                    break;

                default:
                    return json_response(false, 400, 'Invalid list type');
            }
            
            return json_response(true, 200, $message, $data);

        } catch (\Exception $e) {
            Log::error('Permission Management Error: ' . $e->getMessage());
            return json_response(false, 500, 'Something went wrong. Please check logs.');
        }
    }


    public function roleSave(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->roleValidationTrait($data);
            if(!empty($validation)) {
                return json_response(false, 410, "Validation failed", $validation);
            }

            $customerId            = (int) auth()->user()->customer_id;
            $code                  = trim(str_replace(' ', '_', strtolower($data['name'])));

            $roles                 = new Role();
            $roles->customer_id    = $customerId ? $customerId : NULL;
            $roles->hospital_id    = $customerId ? (int) trim($data['hospital_id']) : NULL;
            $roles->firm_id        = $customerId ? (int) trim($data['firm_id']) : NULL;
            $roles->name           = trim($data['name']);
            $roles->role_priority  = trim($data['role_priority']);
            $roles->code           = trim(str_replace(' ', '_', strtolower($data['name'])));
            $roles->scope          = $customerId ? 1 : 0;
            $roles->is_system      = $customerId ? 1 : 0;
            $roles->protected_role = $customerId ? 1 : 0;
            $roles->status         = 1;
            $roles->save();
            storeLog("Role Create");
            return json_response(true, 200, 'Role created successfully.');
            
        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 500, $e->getMessage());
        }
    }


    public function permissionSave(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->permissionValidationTrait($data);
            if ($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }
            $moduleId = !empty($data['child']) ? (int) $data['child'] : (!empty($data['parent']) ? (int) $data['parent'] : null);
            $moduleSlug = DB::table('modules')->where('id', $moduleId)->value('slug');
            $permissionName = permissionSlug($data['permission']);
            $value = $moduleSlug . '.' . $permissionName;
            $customerId              = auth()->user()->customer_id;
            $permission              = new Permission();
            $permission->module_id   = (int) $moduleId;
            $permission->name        = formatedName($data['permission']);
            $permission->action      = $value;
            $permission->status      = 1;
            $permission->save();

            storeLog("Permission Create");
            return json_response(true, 200, "Premission Module", $data['permission'] . ' permission successfully accepted.');

        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return json_response(false, 500, $th->getMessage());
        }
    }


    public function rolePermissionSave(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->rolePermissionMappingValidationTrait($data);
            if($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }
            $customerId = DB::table('roles')->where('roles.id', $data['role_id'])->pluck('customer_id')->first();
            DB::transaction(function () use ($data, $customerId) {
                foreach ($data['permission_id'] as $permission) {
                    RolePermission::create([
                        'customer_id'  => $customerId ?? NULL,
                        'role_id'      => (int) $data['role_id'],
                        'permission_id'=> (int) $permission,
                    ]);
                }
            });

            storeLog("Role Permission Mapping");
            return json_response(true, 200, 'Role permssion mapping created successfully.');

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 500, $th->getMessage());
        }
    }

    public function rolePermissionUpdate(Request $request) {
        // 1. Simple manual validation check
        if (!$request->has('role_id')) {
            return json_response(false, 400, "Role select karna zaroori hai.");
        }

        $roleId = (int) $request->role_id;
        $customerId = auth()->user()->customer_id; // Agar system user hai to null milega, customer hai to ID milega
        $permissions = $request->input('permission_id', []); // Agar koi check nahi hai to khali array milega

        // 2. Database Transaction taaki koi error aaye to data safe rahe
        DB::transaction(function () use ($roleId, $customerId, $permissions) {
            
            // PEHLE: Purani saari mappings delete karo is role ke liye
            $deleteQuery = DB::table('role_permissions')->where('role_id', $roleId);
            
            if (empty($customerId)) {
                $deleteQuery->whereNull('customer_id');
            } else {
                $deleteQuery->where('customer_id', $customerId);
            }
            $deleteQuery->delete();

            // PHIR: Agar user ne naye checkboxes select kiye hain, to unhe insert karo
            if (!empty($permissions)) {
                $insertData = [];
                foreach ($permissions as $permId) {
                    $insertData[] = [
                        'customer_id'   => $customerId ?? NULL,
                        'role_id'       => $roleId,
                        'permission_id' => (int) $permId,
                        'created_at'    => now(), // Agar timestamps hain to
                        'updated_at'    => now(),
                    ];
                }
                DB::table('role_permissions')->insert($insertData);
            }
        });

        storeLog("Role Permission Mapping Updated");
        return json_response(true, 200, 'Role permissions successfully update ho gayi hain.');
    }


    public function saveModule(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->validationModuleTrait($data);
            if($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }

            $module = new Module();
            $module->name = formatedName($data['name']);
            $module->parent_id = NULL;
            $module->slug = formatedSlug($data['name']);
            $module->icon = $data['icon'];
            $module->updated_at = NULL;
            $module->save();
            storeLog("Parent Module Create");
            return json_response(true, 200, 'Module created successfully.');

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 500, $th->getMessage());
        }
    }

    public function saveChileModule(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->validationChildModuleTrait($data);
            if($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }

            $module = new Module();
            $module->name = trim(ucwords($data['name']));
            $module->parent_id = (int) trim($data['parent_id']);
            $module->slug = preg_replace('/[^a-zA-Z0-9]+/', '_', trim(strtolower($data['name'])));
            $module->icon = $data['icon'];
            $module->updated_at = NULL;
            $module->save();
            storeLog("Child Module Create");
            return json_response(true, 200, 'Child module created successfully.');

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 500, $th->getMessage());
        }
    }


    public function getModule() {
        $moduleData = DB::table('modules')
                        ->where('status', 1)
                        ->whereNull('parent_id')
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray();
        return response()->json($moduleData);
    }
     
    
    public function childModule($parent_id) {
        $childModuleData = DB::table('modules')
                            ->where('status', 1)->where('parent_id', $parent_id)
                            ->orderBy('name')->pluck('name', 'id')->toArray();
        return response()->json($childModuleData);
    }




}
