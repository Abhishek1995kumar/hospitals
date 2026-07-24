<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller {
    public function index() {
        try {
            storeLog("User Dashboard");
            return view("backend.dashboard");

        } catch(Throwable $th) {
            \Log::info($th->getMessages());
            throw($th);
        }
    }
}
