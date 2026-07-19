<?php

namespace App\Traits;

use Throwable;
use Exception;
use Pusher\Pusher;
use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpVerified;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait CommanFunctionTrait {
    public function loginTrait($data) {
        try {
            $result = User::where("email", $data['login'])->orWhere('phone', $data['login'])->orWhere("username", $data['login'])->first();
            if($result) {
                if ($result->status == 1 && $result->deleted_at == null){
                    if(Hash::check($data['password'], $result->password)){
                        // $result->save();
                        Auth::login($result);
                        request()->session()->regenerate();
                        $name = fullName($result->fname, $result->lname);
                        $email = $result->email;
                        $loginTime = Carbon::now();
                        storeLog("User Login", request()->except(['password', 'password_confirmation']));
                        return json_response(true,200,'Login Success');
                    } else {
                        return json_response(false, 401, 'Incorrect Password');
                    }
                } else {
                    return json_response(false, 403, 'You have been deactivated from logging into the panel. Kindly contact the admin to reinstate your privileges');
                }
            } else {
                return json_response(false, 404, 'Details not found');
                
            }
        } catch (Exception $e) { 
            return json_response(false, 422, $e->getMessage());
        }
    }



    public function logoutTrait() {
        try {
            $user = Auth::user();
            if ($user) {
                $id = $user->id;
                $user->save();
                $logoutTime = Carbon::now();
                storeLog($id, "Logout", "Web", "Laptop", $logoutTime);
                Auth::logout();
                return redirect('/')->with(['success' => 200, 'message' => 'Logged out successfully',]);
            } else {
                return json_response(false, 409, 'User is currently not logged in');
            }
        } catch (Exception $e) {
            return json_response(false, 422, $e->getMessage());
        }
    }


    
    // public function forgetPassword() {
    //     try {
    //         sendMail($email, ['reset_link'=>$link ], 'Reset Password', 'backend.emails.reset', ResetPasswordMail::class);
    //         sendMail($user->email, ['name'=>$user->name ], 'Registration Successful', 'backend.emails.register', UserRegisterMail::class);
    //     } catch() {

    //     }
    // }


}