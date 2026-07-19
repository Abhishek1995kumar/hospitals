<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller {
    public function index() {
        return view('backend.settings.maintenance.index')->with('success', 'Application optimized successfully.');
    }

    public function route() {
        Artisan::call('route:cache');
        return json_response(true, 200, 'Application route cache successfully.');
    }

    public function cache() {
        Artisan::call('config:cache');
        return json_response(true, 200, 'Application config cache successfully.');
    }

    public function config() {
        Artisan::call('config:clear');
        return json_response(true, 200, 'Application config clear successfully.');
    }

    public function optimizer() {
        Artisan::call('optimize:clear');
        return json_response(true, 200, 'Application optimized clear successfully.');
    }
}
