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
    public function ses($result) {
        try {
            
            return $userData;
        } catch(Throwable $th) {
            Log::error($th->getMessage());
            return [];
        }
    }



}