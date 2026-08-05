<?php

namespace App\Traits;

use Exception;
use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Backend\Role;
use App\Models\Backend\Plan;
use App\Models\Backend\Feature;
use App\Models\Backend\Customer;
use App\Models\Admin\Department;
use App\Models\Admin\Designation;
use App\Models\Backend\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\FeaturePlan;
use Illuminate\Support\Facades\Log;
use App\Models\Backend\RolePermission;
use Illuminate\Support\Facades\Validator;

trait ValidationTrait {
    // User Validation Trait
        public function validateUser($data) {
            try{
                $errors = [];
                $rules = [
                    'role_id' => ['required', 'integer', 'exists:roles,id'],
                    'username' => ['required', 'string', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:255', 'unique'],
                    'date_of_birth' => ['required', 'date'],
                    'address' => ['required', 'string', 'max:255'],                    
                ];
                
                $messages = [
                    'role_id.required' => 'The role field is required.',
                    'role_id.exists' => 'The selected role does not exist.',
                    'username.required' => 'The username field is required.',
                    'username.string' => 'The username must be a string.',
                    'username.max' => 'The username may not be greater than 255 characters.',
                    'name.required' => 'The name field is required.',
                    'name.string' => 'The name must be a string.',
                    'name.max' => 'The name may not be greater than 255 characters.',
                    'phone.required' => 'The phone field is required.',
                    'phone.string' => 'The phone must be a string.',
                    'phone.max' => 'The phone may not be greater than 255 characters.',
                    'email.required' => 'The email field is required.',
                    'email.string' => 'The email must be a string.',
                    'email.max' => 'The email may not be greater than 255 characters.',
                    'date_of_birth.required' => 'The date of birth field is required.',
                    'date_of_birth.date' => 'The date of birth must be a string.',
                    'address.required' => 'The address field is required.',
                    'address.string' => 'The address must be a string.',
                    'address.max' => 'The address may not be greater than 255 characters.',
                ];
                
                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        }
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        }
                        if ($rule === 'exists' && !isset($value)) {
                            $errors[$field][] = $messages["{$field}.exists"];

                        } 
                        if ($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        } 
                        if ($rule === 'date' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.date"];

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }

                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }
    // User Validation Trait


    public function loginValidationTrait($data) {
        try {
            $loginInput = trim($data['login']);
            $encryptedLogin = secure($loginInput, 'E');
            $user = User::where(function ($query) use ($loginInput, $encryptedLogin) {
                            $query->where('email', $encryptedLogin)
                                ->orWhere('phone', $encryptedLogin)
                                ->orWhere('email', $loginInput)
                                ->orWhere('phone', $loginInput)
                                ->orWhere('username', $loginInput); // Username generally encrypted nahi hota
                        })->first();
            if (!$user) {
                return $errors["login"][] = "Invalid user credential";
            }

            $rules = [
                'login' => ['required'],
                'password' => ['required'],
            ];

            $messages = [
                'login.required' => 'The login field is required.',
                'password.required' => 'The password field is required.',
            ];
            
            $errors = [];
            foreach ($rules as $field => $fieldRules) {
                $value = $data[$field] ?? null;
                foreach ($fieldRules as $rule) {
                    if ($rule === 'required' && empty($value)) {
                        $errors[$field][] = $messages["{$field}.required"];

                    }
                }
            }
            return $errors;

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 422, $th->getMessage());
        }
    }

    // Department Validation Trait
        public function parentValidationDepartmentTrait($data) {
            try {
                $errors = [];
                $code  = trim(preg_replace('/[^a-zA-Z0-9]+/', '_', strtolower($data['name'])));
                $exists = DB::table('departments')->where('slug', $code)->whereNull('parent_id')->exists();
                if(!empty($exists)) {
                    return $errors['name'][] = 'Already department exists, please enter anyother department name.';
                }

                $rules = [
                    'name' => ['required', 'string', 'min:3', 'max:255'],
                ];
                $messages = [
                    'name.required' => 'The:name field is required.',
                    'name.string' => 'The:name must be a string.',
                    'name.max' => 'The:name may not be greater than 255 characters.',
                    'name.min' => 'The:name may not be less than 3 characters.',
                ];
                
                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } elseif ($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } elseif (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        } elseif (Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if (strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }

        public function childValidationDepartmentTrait($data) {
            try {
                $department = Department::where('name', $data['name'])->first();
                if(!empty($department)) {
                    return $errors['name'][] = 'Already department exists, please enter anyother department name.';
                }
                $rules = [
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['string', 'max:255'],
                ];

                $messages = [
                    'name.required' => 'The name field is required.',
                    'name.string' => 'The name must be a string.',
                    'name.max' => 'The name may not be greater than 255 characters.',
                    'description.string' => 'The description must be a string.',
                    'description.max' => 'The description may not be greater than 255 characters.',
                ];

                $errors = [];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } elseif ($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } elseif (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }
    // Department Validation Trait


    // Designation Validation Trait
        public function designationValidationTrait($data) {
            try {
                $departments = Department::where('deleted_at', null)->where('id', json_decode($data['department_id']))->get();
                $designation = Designation::where('name', $data['name'])->first();
                if(empty($departments)){
                    return $errors['department_id'][] = 'Invalid department selected.';
                }
                if(!empty($designation)){
                    return $errors['name'][] = 'Already designation exists, please enter anyother designation name.';
                }
                $rules = [
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['string', 'max:255'],
                    'department_id' => ['required']
                ];

                $messages = [
                    'name.required' => 'The name field is required.',
                    'name.string' => 'The name must be a string.',
                    'name.max' => 'The name may not be greater than 255 characters.',
                    'description.string' => 'The description must be a string.',
                    'description.max' => 'The description may not be greater than 255 characters.',
                    'department_id.required' => 'The department field is required.',
                ];

                $errors = [];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } elseif ($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } elseif (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        }
                    }
                }
                return $errors;
                
            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }
    // Designation Validation Trait

    
    // Role, Permission, Role Permission Mapping Validation Trait
        public function roleValidationTrait($data) {
            try {
                $customerId = (int) auth()->user()->customer_id;
                $code       = trim(str_replace(' ', '_', strtolower($data['name'])));
                // $exists     = Role::where('code', $code)
                //             ->when(
                //                 $customerId,
                //                 fn($query) => $query->where('customer_id', $customerId),
                //                 fn($query) => $query->whereNull('customer_id')
                //             )->exists();
                $query = Role::where('code', $code);
                if(!is_null($customerId) && !empty($customerId)) {
                    $query->where('customer_id', $customerId);
                } else {
                    $query->whereNull('customer_id');
                }
                $exists = $query->exists();
                if(!empty($exists)) {
                    return $errors['code'][] = 'This role is already exists, please enter anyother role name.';
                }

                $rules = [
                    'name' => ['required', 'string', 'min:3', 'max:255'],
                    'hospital_id' => ['nullable'],
                    'firm_id' => ['nullable'],
                    'role_priority' => ['integer']
                ];

                $messages = [
                    'name.required' => 'The:name field is required.',
                    'name.string' => 'The:name must be a string.',
                    'name.max' => 'The:name may not be greater than 255 characters.',
                    'name.min' => 'The:name may not be less than 3 characters.',
                    'role_priority.integer' => 'The:role priority is numeric.',
                    // 'hospital_id.integer' => 'Please select valid hospital',
                    // 'firm_id.integer' => 'Please select valid firm',
                ];

                $errors = [];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        }
                        if($rule === 'date' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.date"];

                        }
                        // if (Str::startsWith($rule, 'unique:')) {
                        //     [$table, $column] = explode(',', Str::after($rule, 'unique:'));
                        //     if (DB::table($table)->where($column, $value)->exists()) {
                        //         $errors[$field][] = $messages["{$field}.unique"];
                        //     }
                        // } 
                        
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }


        public function updateRoleValidationTrait($data) {
            try {
                $rules = [
                    'role' => ['string', 'max:255'],
                ];

                $messages = [
                    'role.string' => 'The name must be a string.',
                    'role.max' => 'The name may not be greater than 255 characters.',
                ];

                $errors = [];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int) Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }
        

        public function permissionValidationTrait(array $data) {
            try {
                $errors = [];
                $moduleId = !empty($data['child']) ? (int) $data['child'] : (!empty($data['parent']) ? (int) $data['parent'] : null);
                $moduleSlug = DB::table('modules')->where('id', $moduleId)->value('slug');
                $permissionName = permissionSlug($data['permission']);
                $value = $moduleSlug . '.' . $permissionName;
                $exists = DB::table('permissions')->where('action', $value)->exists();
                if ($exists) {
                    return $errors['action'][] = 'This permission is already exists.';
                }
                $rules = [
                    'permission' => ['required', 'string', 'min:3', 'max:100'],
                    // 'action' => ['required', 'string', 'max:100']
                ];
                
                $messages = [
                    'permission.required' => 'The permission field is required.',
                    'permission.string' => 'The permission must be a string.',
                    'permission.min' => 'The permission must be at least 3 characters.',
                    'permission.max' => 'The permission may not be greater than 50 characters.',
                    // 'action.required' => 'The action field is required.',
                    // 'action.string' => 'The action must be a string.',
                    // 'action.max' => 'The action may not be greater than 100 characters.'
                ];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required') {
                            if ($value === null || $value === '') {
                                $errors[$field][] = $messages["{$field}.required"];
                                continue 2;
                            }
                        }
                        if ($rule === 'string') {
                            if (!is_string($value)) {
                                $errors[$field][] = $messages["{$field}.string"];
                            }
                        }
                        if (Str::startsWith($rule, 'min:')) {
                            $min = (int) Str::after($rule, 'min:');
                            if (strlen((string)$value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int) Str::after($rule, 'max:');
                            if (strlen((string)$value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        }

                        // if (Str::startsWith($rule, 'in:')) {
                        //     $allowed = explode(',', Str::after($rule, 'in:'));
                        //     if (!in_array((string)$value, $allowed, true)) {
                        //         $errors[$field][] = "The {$field} value is invalid.";
                        //     }
                        // }

                        // if (Str::startsWith($rule, 'unique:')) {
                        //     $unique = explode(',', Str::after($rule, 'unique:'));
                        //     $table = $unique[0];
                        //     $column = $unique[1] ?? $field;
                        //     $exists = DB::table($table)->where($column, $value)->exists();
                        //     if ($exists) {
                        //         $errors[$field][] = $messages["{$field}.unique"] ?? "The {$field} has already been taken.";

                        //     }
                        // }

                        // if ($rule === 'email') {
                        //     if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        //         $errors[$field][] = $messages["{$field}.email"] ?? "The {$field} must be a valid email address.";
                        //     }

                        // }

                        // if (Str::startsWith($rule, 'exists:')) {
                        //     $existsRule = explode(',', Str::after($rule, 'exists:'));
                        //     $table = $existsRule[0];
                        //     $column = $existsRule[1] ?? $field;
                        //     $exists = DB::table($table)->where($column, $value)->exists();
                        //     if (!$exists) {
                        //         $errors[$field][] = $messages["{$field}.exists"] ?? "The selected {$field} is invalid.";
                        //     }
                        // }

                        // $date = DateTime::createFromFormat('Y-m-d', $value);
                        // if (!$date || $date->format('Y-m-d') !== $value) {
                        //     $errors[$field][] = "The {$field} must be a valid date.";
                        // }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }


        public function updatePermissionValidationTrait($data) {
            try {
                $errors = [];
                $rules = [
                    'permission' => ['string', 'max:255'],
                    'module' => ['integer']
                ];

                $messages = [
                    'permission.string' => 'The name must be a string.',
                    'permission.max' => 'The name may not be greater than 255 characters.',
                    'app_url.string' => 'The application url must be a string.',
                    'app_url.max' => 'The application url may not be greater than 255 characters.',
                    'module.integer' => 'The module name must be a integer.',

                ];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        } 
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }


        public function rolePermissionMappingValidationTrait($data) {
            $validator = Validator::make($data, [
                'role_id' => 'required|exists:roles,id',
                'permission_id' => 'required|array|min:1',
                'permission_id.*' => 'exists:permissions,id',
            ], [
                'role_id.required' => 'The role field is required.',
                'role_id.exists' => 'The selected role does not exist.',
                'permission_id.required' => 'The permission field is required.',
                'permission_id.array' => 'The permission must be an array.',
                'permission_id.min' => 'Please select at least one permission.',
                'permission_id.*.exists' => 'One or more selected permissions do not exist.',
            ]);

            if ($validator->fails()) {
                return $validator->errors()->toArray();
            }

            $customerId = auth()->user()->customer_id;
            $errors = [];

            foreach ($data['permission_id'] as $permissionId) {
                $query = RolePermission::where('role_id', $data['role_id'])->where('permission_id', $permissionId);
                if ($customerId) {
                    $query->where('customer_id', $customerId);
                } else {
                    $query->whereNull('customer_id');
                }
                if ($query->exists()) {
                    $errors['permission_id'][] = "Permission ID {$permissionId} is already mapped to this role.";
                }
            }

            return $errors;
        }

        public function validationModuleTrait($data) {
            try {
                $errors = [];
                $code  = trim(preg_replace('/[^a-zA-Z0-9]+/', '_', strtolower($data['name'])));
                $exists = DB::table('modules')->where('slug', $code)->exists(); 
                if(!empty($exists)) {
                    return $errors['name'][] = 'This module is already exists, please enter anyother module name.';
                }

                $rules = [
                    'name' => ['required', 'string', 'min:3', 'max:255'],
                ];
                $messages = [
                    'name.required' => 'The:name field is required.',
                    'name.string' => 'The:name must be a string.',
                    'name.max' => 'The:name may not be greater than 255 characters.',
                    'name.min' => 'The:name may not be less than 3 characters.',
                ];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }

        public function validationChildModuleTrait($data) {
            try {
                $errors = [];
                $code  = trim(str_replace(' ', '_', strtolower($data['name'])));
                $exists = DB::table('modules')->where('slug', $code)->exists(); 
                if(!empty($exists)) {
                    return $errors['name'][] = 'This module is already exists, please enter anyother module name.';
                }

                $rules = [
                    'parent_id' => ['required', 'integer'],
                    'name' => ['required', 'string', 'min:3', 'max:255'],
                ];
                $messages = [
                    'parent_id.required' => 'The:parent module name field is required.',
                    'parent_id.string' => 'The:parent module name must be a numeric.',
                    'name.required' => 'The:name field is required.',
                    'name.string' => 'The:name must be a string.',
                    'name.max' => 'The:name may not be greater than 255 characters.',
                    'name.min' => 'The:name may not be less than 3 characters.',
                ];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        }
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return json_response(false, 422, $th->getMessage());
            }
        }
        
    // Role, Permission, Role Permission Mapping Validation Trait End
 


    // Plan, Feature and Plan Feature Mapping Start
        public function validationPlanTait($data) {
            try {
                $errors = [];
                $planName   = trim($data['plan_name']);
                $exists     = Plan::where('plan_name', $planName)->where('status', 1)->exists();
                if(!empty($exists)) {
                    return $errors['plan_name'][] = 'This plan is already exists, please enter anyother plan name.';
                }

                $rules = [
                    'plan_name' => ['required', 'string', 'min:3', 'max:255'],
                    'price' => ['decimal'],
                    'duration_days' => ['required', 'integer'],
                    'max_hospitals' => ['required', 'integer'],
                    'max_firms' => ['required', 'integer'],
                    'max_users' => ['required', 'integer'],
                ];

                $messages = [
                    'plan_name.required' => 'The:plan_name field is required.',
                    'plan_name.string' => 'The:plan_name must be a string.',
                    'plan_name.max' => 'The:plan_name may not be greater than 255 characters.',
                    'plan_name.min' => 'The:plan_name may not be less than 3 characters.',
                    'price.required' => 'The:price field is required.',
                    'price.decimal' => 'The:price is decimal.',
                    'duration_days.required' => 'The:duration_days field is required.',
                    'duration_days.decimal' => 'The:duration_days is decimal.',
                    'max_hospitals.required' => 'The:max_hospitals field is required.',
                    'max_hospitals.decimal' => 'The:max_hospitals is decimal.',
                    'max_firms.required' => 'The:max_firms field is required.',
                    'max_firms.decimal' => 'The:max_firms is decimal.',
                    'max_users.required' => 'The:max_users field is required.',
                    'max_users.decimal' => 'The:max_users is decimal.',
                ];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        }
                        if($rule === 'decimal' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.decimal"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                // return json_response(false, 422, $th->getMessage());
            }
        }

        public function validationFeatureTait($data) {
            try {
                $errors = [];
                $featureName = trim(preg_replace('/[^a-zA-Z0-9]+/', '_', strtolower($data['feature_name'])));
                $exists      = Feature::where('feature_slug', $featureName)->where('status', 1)->exists();
                if(!empty($exists)) {
                    return $errors['feature_name'][] = 'This feature is already exists, please enter anyother feature name.';
                }
                $rules = [
                    'feature_name' => ['required', 'string', 'min:3', 'max:100'],
                    'module_name' => ['required', 'string'],
                    'description' => ['string'],
                ];

                $messages = [
                    'feature_name.required' => 'The:feature_name field is required.',
                    'feature_name.string' => 'The:feature_name must be a string.',
                    'feature_name.max' => 'The:feature_name may not be greater than 255 characters.',
                    'feature_name.min' => 'The:feature_name may not be less than 3 characters.',
                    'module_name.required' => 'Module name field is required.',
                    'module_name.string' => 'Module name must be a string.',
                    'description.string' => 'The:description must be a string.'
                ];

                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if($rule === 'integer' && !is_int($value)) {
                            $errors[$field][] = $messages["{$field}.integer"];
                        }
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }
                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
            }
        }

        public function validationPlanFeatureMappingTait($data) {
            $validator = Validator::make($data, [
                'plan_id' => 'required|exists:plans,id',
                'feature_id' => 'required|array|min:1',
                'feature_id.*' => 'exists:features,id',
            ], [
                'plan_id.required' => 'The role field is required.',
                'plan_id.exists' => 'The selected role does not exist.',
                'feature_id.required' => 'The permission field is required.',
                'feature_id.array' => 'The permission must be an array.',
                'feature_id.min' => 'Please select at least one permission.',
                'feature_id.*.exists' => 'One or more selected features do not exist.',
            ]);

            if ($validator->fails()) {
                return $validator->errors()->toArray();
            }

            $errors = [];
            foreach ($data['feature_id'] as $featureId) {
                $query = FeaturePlan::where('plan_id', $data['plan_id'])->where('feature_id', $featureId);
                if ($query->exists()) {
                    $errors['feature_id'][] = "Feature ID {$featureId} is already mapped to this plan.";
                }
            }

            return $errors;
        }
    // Plan, Feature and Plan Feature Mapping End




    // Customer Validation Start
        public function validationCustomerTait($data) {
            try {
                $errors = [];
                $email   = trim($data['email']);
                $exists  = Customer::where('email', $email)->where('status', 1)->exists();
                if(!empty($exists)) {
                    return $errors['email'][] = 'This email is already exists, please enter anyother email.';
                }
                $rules = [
                    'customer_name' => ['required', 'string', 'min:3', 'max:100'],
                    'mobile_no' => ['required', 'string', 'min:10', 'max:15'],
                    'alternate_mobile' => ['string', 'min:10', 'max:15'],
                    'email' => ['required', 'string', 'exists:customers,email', 'min:10', 'max:200', 'email'],
                    'website' => ['string', 'min:10', 'max:200'],
                    'plan_name' => ['required', 'integer'],
                ];

                $messages = [
                    'customer_name.required' => 'The:customer name field is required.',
                    'customer_name.string' => 'The:customer name must be a string.',
                    'customer_name.max' => 'The:customer name may not be greater than 200 characters.',
                    'customer_name.min' => 'The:customer name may not be less than 5 characters.',
                    'mobile_no.required' => 'The:mobile no field is required.',
                    'mobile_no.string' => 'The:mobile no must be a string.',
                    'mobile_no.max' => 'The:mobile no may not be greater than 15 characters.',
                    'mobile_no.min' => 'The:mobile no may not be less than 10 characters.',
                    'alternate_mobile.string' => 'The:alternate mobile no must be a string.',
                    'alternate_mobile.max' => 'The:alternate mobile no may not be greater than 15 characters.',
                    'alternate_mobile.min' => 'The:alternate mobile no may not be less than 10 characters.',
                    'email.required' => 'The:email address field is required.',
                    'email.exists' => 'The:email address already exists.',
                    'email.string' => 'The:email address must be a string.',
                    'email.max' => 'The:email address may not be greater than 200 characters.',
                    'email.min' => 'The:email address may not be less than 10 characters.',
                    'website.string' => 'The:website must be a string.',
                    'website.max' => 'The:website may not be greater than 200 characters.',
                    'website.min' => 'The:website may not be less than 10 characters.',
                    'plan_name.required' => 'The:plan name field is required.',
                    'plan_name.integer' => 'The:plan name field must be number.',
                ];
                
                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        } 
                        if ($rule === 'exists' && !isset($value)) {
                            $errors[$field][] = $messages["{$field}.exists"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                // return json_response(false, 422, $th->getMessage());
            }
        }
    // Customer Validation End




    // Pharmacy Start
        public function validationPartySupplierTrait($data) {
            try {
                $errors = [];
                $email  = trim($data['email']);
                $gst_no = trim($data['gst_no']);
                $pan_no = trim($data['pan_no']);

                $exists  = DB::table('pharmacy_suppliers')
                            ->where('gst_no', $gst_no)
                            ->where('status', 1)
                            ->exists();

                $pan_no_exists  = DB::table('pharmacy_suppliers')
                            ->where('pan_no', $pan_no)
                            ->where('status', 1)
                            ->exists();

                if(!empty($exists)) {
                    return $errors['gst_no'][] = 'This gst number is already exists, please enter anyother gst number.';
                }
                if(!empty($pan_no_exists)) {
                    return $errors['pan_no'][] = 'This pan number is already exists, please enter anyother pan number.';
                }
                if(trim($data['party_type']) == 2 || trim($data['party_type']) == 3 || trim($data['party_type']) == 4) {
                    $drugLicence = trim($data['drug_license_no']) ?? NULL;
                    if(!empty($drugLicence) && !drugLicence($drugLicenseInput)) {
                        return $errors['drug_license_no'][] = 'Invalid Drug License Number format.';
                    }
                }
                
                $rules = [
                    // 'hospital_id'      => ['nullable', 'integer'],
                    // 'firm_id'          => ['nullable', 'integer'],
                    'company_name'     => ['required', 'string', 'min:3', 'max:100'],
                    'name'             => ['required', 'string', 'min:5', 'max:100'],
                    'contact'          => ['required', 'string', 'min:10', 'max:15'],
                    'email'            => ['required', 'string', 'exists:customers,email', 'min:10', 'max:200', 'email'],
                    'gst_no'           => ['string', 'min:14', 'max:18'],
                    'pan_no'           => ['string', 'min:10', 'max:10'],
                    'doctor_name'      => ['required', 'string', 'min:5', 'max:100'],
                    'doctor_address'   => ['nullable', 'string'],
                    'balance_type'     => ['nullable', 'integer'],
                    'party_type'       => ['required', 'integer'],
                ];

                $messages = [
                    'company_name.required' => 'The:customer name field is required.',
                    'company_name.string' => 'The:customer name must be a string.',
                    'company_name.max' => 'The:customer name may not be greater than 200 characters.',
                    'company_name.min' => 'The:customer name may not be less than 5 characters.',
                    'name.required' => 'The:name field is required.',
                    'name.string' => 'The:name must be a string.',
                    'name.max' => 'The:name may not be greater than 15 characters.',
                    'name.min' => 'The:name may not be less than 10 characters.',
                    'contact.required' => 'The:contact no field is required.',
                    'contact.string' => 'The:contact no must be a string.',
                    'contact.max' => 'The:contact no may not be greater than 15 characters.',
                    'contact.min' => 'The:contact no may not be less than 10 characters.',
                    'gst_no.string' => 'The:gst no must be a string.',
                    'gst_no.max' => 'The:gst no may not be greater than 14 characters.',
                    'gst_no.min' => 'The:gst no may not be less than 18 characters.',
                    'pan_no.string' => 'The:pan no must be a string.',
                    'pan_no.max' => 'The:pan no may not be greater than 10 characters.',
                    'pan_no.min' => 'The:pan no may not be less than 10 characters.',
                    'email.required' => 'The:email address field is required.',
                    'email.exists' => 'The:email address already exists.',
                    'email.string' => 'The:email address must be a string.',
                    'email.max' => 'The:email address may not be greater than 200 characters.',
                    'email.min' => 'The:email address may not be less than 10 characters.',
                    'doctor_name.required' => 'The:doctor name field is required.',
                    'doctor_name.string' => 'The:doctor name must be a string.',
                    'doctor_name.max' => 'The:doctor name may not be greater than 100 characters.',
                    'doctor_name.min' => 'The:doctor name may not be less than 5 characters.',
                    'doctor_address.string' => 'The:doctor name must be a string.',
                    'party_type.required' => 'The:party type field is required.',
                    'party_type.integer' => 'The:party type field must be number.',
                ];
                
                foreach ($rules as $field => $fieldRules) {
                    $value = $data[$field] ?? null;
                    foreach ($fieldRules as $rule) {
                        if ($rule === 'required' && empty($value)) {
                            $errors[$field][] = $messages["{$field}.required"];

                        } 
                        if($rule === 'string' && !is_string($value)) {
                            $errors[$field][] = $messages["{$field}.string"];

                        } 
                        if ($rule === 'integer') {
                            if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                                $errors[$field][] = $messages["{$field}.integer"];
                            }
                        } 
                        if ($rule === 'exists' && !isset($value)) {
                            $errors[$field][] = $messages["{$field}.exists"];

                        } 
                        if (Str::startsWith($rule, 'max:')) {
                            $max = (int)Str::after($rule, 'max:');
                            if (strlen($value) > $max) {
                                $errors[$field][] = $messages["{$field}.max"];
                            }

                        } 
                        if(Str::startsWith($rule, 'min:')) {
                            $min = (int)Str::after($rule, 'min:');
                            if(strlen($value) < $min) {
                                $errors[$field][] = $messages["{$field}.min"];
                            }
                        }
                    }
                }
                
                return $errors;

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                // return json_response(false, 422, $th->getMessage());
            }
        }

    // Pharmacy End









    public function holidayValidationTrait($data) {
        try {
            $errors = [];
            $rules = [
                'firm_id'            => ['required', 'string'],
                'holiday_name'       => ['required', 'string', 'max:255'],
                'day_of_holiday'     => ['required', 'string'],
                'month_of_holiday'   => ['required', 'string'],
                'year_of_holiday'    => ['required', 'string'],
                'holiday_start_date' => ['required', 'date'],
                'holiday_end_date'   => ['required', 'date'],
                'color'              => ['required', 'string'],
                'holiday_image'      => ['nullable', 'string', 'max:500'],
                'description'        => ['nullable', 'string', 'max:500'],
                'category'           => ['required', 'integer'],
            ];

            $messages = [
                'holiday_name.required'       => 'The holiday name field is required.',
                'holiday_name.string'         => 'The holiday name must be a string.',
                'holiday_name.max'            => 'The holiday name may not be greater than 255 characters.',
                'day_of_holiday.required'     => 'The day of holiday field is required.',
                'day_of_holiday.string'       => 'The day of holiday must be a string.',
                'month_of_holiday.required'   => 'The month of holiday field is required.',
                'month_of_holiday.string'     => 'The month of holiday must be a string.',
                'year_of_holiday.required'    => 'The year of holiday field is required.',
                'year_of_holiday.string'      => 'The year of holiday must be a string.',
                'holiday_start_date.required' => 'The holiday start date field is required.',
                'holiday_start_date.date'     => 'The holiday start date must be a date type like (2025-06-21).',
                'holiday_end_date.required'   => 'The holiday end date field is required.',
                'holiday_end_date.date'       => 'The holiday end date must be a date type like (2025-06-21).',
                'color.required'              => 'The color field is required.',
                'color.string'                => 'The color must be a string.',
                'holiday_image.string'        => 'The holiday image must be a string.',
                'holiday_image.max'           => 'The holiday image may not be greater than 255 characters.',
                'description.string'          => 'The description must be a string.',
                'description.max'             => 'The description may not be greater than 255 characters.',
                'category.required'           => 'The category field is required.',
                'category.integer'            => 'The category must be a integer.',
            ];

            foreach ($rules as $field => $fieldRules) {
                $value = $data[$field] ?? null;

                foreach ($fieldRules as $rule) {
                    if ($rule === 'nullable' && is_null($value)) {
                        continue 2;
                    }
                    if ($rule === 'required' && (is_null($value) || $value === '')) {
                        $errors[$field][] = $messages["{$field}.required"];
                    }
                    if ($rule === 'string' && !is_string($value)) {
                        $errors[$field][] = $messages["{$field}.string"];
                    }
                    if (Str::startsWith($rule, 'max:')) {
                        $max = (int) Str::after($rule, 'max:');
                        if (!is_null($value) && strlen($value) > $max) {
                            $errors[$field][] = $messages["{$field}.max"];
                        }
                    }
                    if ($rule === 'integer') {
                        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                            $errors[$field][] = $messages["{$field}.integer"];
                        }
                    }
                    if ($rule === 'date' && (strtotime($value) === false)) {
                        $errors[$field][] = $messages["{$field}.date"];
                    }
                }
            }

            return $errors;

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 422, $th->getMessage());
        }
    }


    public function subjectValidationTrait($data) {
        try {
            $errors = [];
            $rules = [
                'subject_name'       => ['required', 'string', 'max:255'],
                'description'        => ['nullable', 'string', 'max:500'],
            ];

            $messages = [
                'subject_name.required'       => 'The holiday name field is required.',
                'subject_name.string'         => 'The holiday name must be a string.',
                'subject_name.max'            => 'The holiday name may not be greater than 255 characters.',
                'description.string'          => 'The description must be a string.',
                'description.max'             => 'The description may not be greater than 255 characters.',
            ];

            foreach ($rules as $field => $fieldRules) {
                $value = $data[$field] ?? null;

                foreach ($fieldRules as $rule) {
                    if ($rule === 'nullable' && is_null($value)) {
                        continue 2; // skip remaining rules for this field
                    }
                    if ($rule === 'required' && (is_null($value) || $value === '')) {
                        $errors[$field][] = $messages["{$field}.required"];
                        
                    } 
                    if ($rule === 'string' && !is_string($value)) {
                        $errors[$field][] = $messages["{$field}.string"];

                    } 
                    if (Str::startsWith($rule, 'max:')) {
                        $max = (int) Str::after($rule, 'max:');
                        if (!is_null($value) && strlen($value) > $max) {
                            $errors[$field][] = $messages["{$field}.max"];
                        }
                    }
                }
            }

            return $errors;

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 422, $th->getMessage());
        }
    }


    public function interviewValidationTrait($data) {
        try {
            $errors = [];
            $rules = [
                'subject_id'            => ['required', 'integer'],
                'interview_name'        => ['required', 'string', 'max:500'],
                'interview_time'        => ['required', 'string'],
                'interview_date'        => ['required', 'string', 'date'],
                'attempted'             => ['required', 'integer'],
            ];

            $messages = [
                'subject_id.required'     => 'The subject name field is required.',
                'subject_id.integer'      => 'Please enter the valid subject name.',
                'interview_name.required' => 'The subject name field i required.',
                'interview_name.string'   => 'The subject name must be a integer.',
                'interview_name.max'      => 'The interview name may not be greater than 255 characters.',
                'interview_time.required' => 'The interview time field i required.',
                'interview_time.string'   => 'The interview time must be a string.',
                'interview_date.required' => 'The interview date field i required.',
                'interview_date.string'   => 'The interview date must be a string.',
                'interview_date.date'     => 'The interview date must be a date type like (2025-06-21).',
                'attempted.required'      => 'The interview attempted field i required.',
                'attempted.integer'       => 'The interview attempted must be a integer.',
            ];
            
            foreach ($rules as $field => $fieldRules) {
                $value = $data[$field] ?? null;
                foreach ($fieldRules as $rule) {
                    if ($rule === 'nullable' && is_null($value)) {
                        continue 2; // skip remaining rules for this field
                    }
                    if ($rule === 'required' && (is_null($value) || $value === '')) {
                        $errors[$field][] = $messages["{$field}.required"];
                        
                    } 
                    if ($rule === 'string' && !is_string($value)) {
                        $errors[$field][] = $messages["{$field}.string"];

                    } 
                    if (Str::startsWith($rule, 'max:')) {
                        $max = (int) Str::after($rule, 'max:');
                        if (!is_null($value) && strlen($value) > $max) {
                            $errors[$field][] = $messages["{$field}.max"];
                        }
                    } 
                    if ($rule === 'integer') {
                        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                            $errors[$field][] = $messages["{$field}.integer"];
                        }
                    }
                    if ($rule === 'date' && (strtotime($value) === false)) {
                        $errors[$field][] = $messages["{$field}.date"];
                    }
                }
            }

            return $errors;

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 422, $th->getMessage());
        }
    }

}

