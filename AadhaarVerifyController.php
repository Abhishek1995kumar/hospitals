<?php

namespace App\Http\Controllers;

use App\Http\Requests\Aadhaar\GetOtpRequest;
use App\Http\Requests\Aadhar\VerifyOtpRequest;
use App\Models\AadhaarVerificationLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AadhaarVerifyController extends ApiController
{
    public function getOtp(GetOtpRequest $request)
    {
        try {
            $request->merge(['request_id' => uniqid()]);
            $salt = config('aadhar.aadhar_salt');
            $time = Carbon::now()->getTimestampMs();
            $client_code = config('aadhar.aadhar_client_code');

            $header = [
                'client_code' => $client_code,
                'sub_client_code' => $client_code,
                // "channel_code"          => "1",
                // "channel_version"       => "1",
                // "stan"                  => "3472bc0b97fge07ff",
                // "client_ip"             => "1",
                // "transmission_datetime" => $time,
                // "operation_mode"        => "DEFAULT",
                // "run_mode"              => "TRIAL",
                // "actor_type"            => "DEFAULT",
                // "user_handle_type"      => "1",
                // "user_handle_value"     => "1",
                // "location"              => "1",
                'function_code' => 'DEFAULT',
                'function_sub_code' => 'DEFAULT',
            ];

            $user = User::where('employee_id', $request->employee_id)->select('aadhar_number')->first();

            //creating hash
            $apiKey = config('aadhar.aadhar_api_key');
            $hash = "{$client_code}|{$apiKey}|{$salt}";
            $detail['hash'] = hash('sha256', $hash);

            $detail['aadhaar'] = "{$user->aadhar_number}";
            // $detail['captcha']              = $request->captcha;

            $detail['verification_type'] = 'OTP';
            $detail['consent'] = 'YES';

            $data['headers'] = $header;
            $data['request'] = $detail;

            $url = config('aadhar.enter_aadhaar_url');

            $this->createLog($request->employee_id, Auth::id(), 'GET OTP', json_encode($data));

            // $getOtp = Http::withBody(json_encode($data), 'application/json')
            //     ->withOptions([
            //         'verify' => false, // Disable SSL verification - NOT recommended for production
            //         'http_version' => '1.1', // Force HTTP/1.1
            //         'timeout' => 60,
            //     ])
            //     ->post($url);
            // \Log::info($getOtp);
$getOtp='111111';
            $this->createLog($request->employee_id, Auth::id(), 'GET OTP RESPONSE', $getOtp);

            $otp = json_decode($getOtp);

            $uuid = $otp->response_data->uuid ?? null;
            Session::put(['uuid' => $uuid, 'employee_id' => $request->employee_id]);

            switch ($otp) {
                case $otp->response_status->code == 422001:
                    $message = $otp->response_status->message;
                    $code = 404;
                    break;

                case $otp->response_status->code == 422002:
                    $message = $otp->response_status->message;
                    $code = 404;
                    break;

                case $otp->response_status->code == 422003:
                    $message = $otp->response_status->message;
                    $code = 404;
                    break;

                case $otp->response_status->code == 422048:
                    $message = $otp->response_status->message;
                    $code = 404;
                    break;

                case $otp->response_status->code == 470048:
                    $message = $otp->response_status->message;
                    $code = 404;
                    break;
                case $otp->response_status->code == 333:
                    $message = $otp->response_status->message;
                    $code = 404;
                    break;
                case $otp->response_status->code == 000:
                    $message = $otp->response_status->message;
                    $code = 200;
                    break;
                default:
                    $message = 'Facing fluctuation try again after some time';
                    $code = 404;
                    break;
            }

            return $this->responseWithCodeMessage($code, $message);
        } catch (\Exception $e) {
            \Log::error([$e->getMessage(), $e->getFile()]);

            return $this->respondInternalError('Something went wrong!');
        }
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
      // return $this->success('success');
      //   return $this->responseWithCodeMessage(200, 'success');
        try {
            $time = Carbon::now()->getTimestampMs();
            $employee_id = $request->session()->get('employee_id');
            $client_code = config('aadhar.aadhar_client_code');

            $header = [
                'client_code' => $client_code,
                'sub_client_code' => $client_code,
                'channel_code' => '1',
                'channel_version' => '1',
                'stan' => '3472bc0b97fge07ff',
                'client_ip' => '1',
                'transmission_datetime' => $time,
                'operation_mode' => 'DEFAULT',
                'run_mode' => 'TRIAL',
                'actor_type' => 'DEFAULT',
                'user_handle_type' => '1',
                'user_handle_value' => '1',
                'location' => '1',
                'function_code' => 'DEFAULT',
                'function_sub_code' => 'DEFAULT',
            ];

            $detail['uuid'] = $request->session()->get('uuid');
            $detail['otp'] = $request->otp;

            $data['headers'] = $header;
            $data['request'] = $detail;

            $url = config('aadhar.enter_otp_url');

            $this->createLog($employee_id, Auth::id(), 'VERIFY OTP', json_encode($data));

            $verifyOtp = Http::withBody(json_encode($data), 'application/json')
                ->post($url);
            \Log::info($verifyOtp);

            $this->createLog($employee_id, Auth::id(), 'VERIFY OTP RESPONSE', $verifyOtp);

            $userData = json_decode($verifyOtp);

            switch ($userData) {
                case $userData->response_status->code == 422001:
                    $message = $userData->response_status->message;
                    $code = 404;
                    break;

                case $userData->response_status->code == 422002:
                    $message = $userData->response_status->message;
                    $code = 404;
                    break;

                case $userData->response_status->code == 422003:
                    $message = $userData->response_status->message;
                    $code = 404;
                    break;

                case $userData->response_status->code == 422048:
                    $message = $userData->response_status->message;
                    $code = 404;
                    break;

                case $userData->response_status->code == 470048:
                    $message = $userData->response_status->message;
                    $code = 404;
                    break;
                case $userData->response_status->code == 333:
                    $message = $userData->response_status->message;
                    $code = 404;
                    break;
                case $userData->response_status->code == 000:
                    $message = $userData->response_status->message;
                    $code = 200;
                    break;
            }

            $aadharFace = $userData->response_data->doc_face ?? null;
            $aadharName = $userData->response_data->name ?? null;

            Session::put(['aadhar_face' => $aadharFace]);

            $user = User::where('employee_id', $employee_id)->update([
                'aadhar_name' => $aadharName,
            ]);

            return $this->responseWithCodeMessage($code, $message);
        } catch (\Exception $e) {
            \Log::error([$e->getMessage(), $e->getFile()]);

            return $this->respondInternalError('Something went wrong!');
        }
    }

    public function createLog($userId, $approverId, $process, $log)
    {
        AadhaarVerificationLog::create([
            'user_id' => $userId,
            'approver_id' => $approverId,
            'process' => $process,
            'log' => $log,
        ]);
    }
}
