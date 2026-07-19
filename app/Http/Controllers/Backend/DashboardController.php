<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    public function index() {
        // $permissions = DB::table('role_permissions')
        //     ->join('permissions','permissions.id','=','role_permissions.permission_id')
        //     ->where('role_permissions.role_id',$roleId)
        //     ->pluck('permissions.code')
        //     ->toArray();
        // session([
        //     'permissions' => $permissions
        // ]);
        storeLog("User Dashboard");
        return view("backend.dashboard");
    }
}
