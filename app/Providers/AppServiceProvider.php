<?php

namespace App\Providers;

use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }


    public function boot(): void {
        Blade::if('permission', function ($permission) {
            return PermissionHelper::hasPermission($permission);
        });
    }

    

}
