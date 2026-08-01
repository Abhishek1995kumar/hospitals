<?php

namespace App\Http\Controllers\backend;

use Throwable;
use Illuminate\Http\Request;
use App\Traits\ValidationTrait;
use App\Traits\DatabaseQueryTrait;
use App\Traits\CommanFunctionTrait;
use App\Http\Controllers\Controller;
use App\Services\RegistrationService;

class AuthController extends Controller {
    use ValidationTrait, CommanFunctionTrait, DatabaseQueryTrait;
    public function login() {
        return view("backend.auth.login");
    }

    public function auth(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->loginValidationTrait($data);
            if(!empty($validation)) {
                return json_response(false, 410, "Validation failed", $validation);
            }
            
            return $this->loginTrait($data);

        } catch (\Exception $e) {
            return json_response(false, 500, $e->getMessage());
        }
    }


    public function logout(Request $request) {
        try {
            return $this->logoutTrait();
        } catch(Throwable $e) {
            return json_response(false, 500, $e->getMessage());
        }
    }

    public function forgetPasswordPage() {
        return view("users::forgot-password");
    }

    public function forgetPassword(Request $request) {
        // Placeholder for password reset logic
        return json_response(true, 200, 'Reset instructions sent if email exists.');
    }

    public function subscription(Request $request) {
        return view('subscription.expired');
    }
}
