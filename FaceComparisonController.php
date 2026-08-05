<?php

namespace App\Http\Controllers;

use App\Http\Requests\Aadhaar\ImageUploadRequest;
use App\Http\Requests\User\FaceVerificationRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FaceComparisonController extends ApiController
{
    public function index(FaceVerificationRequest $request)
    {
        try {
            $data = [];
            $request->merge(['request_id' => uniqid()]);
            $employee_id = $request->session()->get('employee_id');

            $time = Carbon::now()->getTimestampMs();
            $salt = config('aadhar.face_comparison_salt');
            $client_code = config('aadhar.face_comparison_client_code');

            $header = [
                'client_code' => $client_code,
                'sub_client_code' => $client_code,
                'channel_code' => '',
                'channel_version' => '',
                'stan' => $request->request_id,
                'client_ip' => '',
                'transmission_datetime' => $time,
                'operation_mode' => 'DEFAULT',
                'run_mode' => 'REAL',
                'actor_type' => 'CUSTOMER',
                'user_handle_type' => 'DEFAULT',
                'user_handle_value' => 'DEFAULT',
                'location' => '',
                'function_code' => 'DEFAULT',
                'function_sub_code' => 'DEFAULT',
            ];

            $requests=[];
            $requests['api_key'] = config('aadhar.face_comparison_api_key');
            $requests['purpose'] = 'Tesing';
            $requests['request_id'] = $request->request_id;

            //creating hash
            $hash = "{$client_code}|{$request->request_id}|{$requests['api_key']}|{$salt}";
            $requests['hash'] = hash('sha256', $hash);

            //$requests['image_1'] = base64_encode(file_get_contents($request->file('image')));
            $request->session()->get('aadhar_face');
            $requests['image_2'] = base64_encode(file_get_contents($request->file('image')));
           
            \Log::error([$requests]);

            $data['headers'] = $header;
            $data['request'] = $requests;

            $url = config('aadhar.face_comparison_url');

            $comparison = Http::withBody(json_encode($data), 'application/json')
                ->post($url);
            \Log::info($comparison);

            $result = json_decode($comparison);

            if ($result->response_data) {
                \Log::error([$result->response_data]);
                $score = $result->response_data->score;

                if ($score >= 80) {
                    //saving the image of the user
                    $directoryImage = 'employee/images/';
                    if (! is_dir($directoryImage)) {
                        mkdir($directoryImage, 0755, true);
                    }

                    $user_image = $request->image;
                    $imageName = $employee_id.'.png';
                    $imagePath = $user_image->storeAs('public/employee/images', $imageName);
                    $imageUrl = 'storage/employee/images/'.$imageName;

                    \Log::info($imageUrl);
                    $user = User::where('employee_id', $employee_id)->update([
                        'image' => $imageUrl,
                    ]);

                    $response = [
                        'score' => round($result->response_data->score, 2).'%',
                        'code' => 200,
                        'message' => 'Face data Matched successfully!',
                    ];

                    return response()->json($response, 200);
                } else {
                    $response = [
                        'score' => round($result->response_data->score, 2).'%',
                        'code' => 410,
                        'message' => 'Face not Recognized Try again!',
                    ];

                    return response()->json($response, 404);
                }
            }
        } catch (\Exception $e) {
            \Log::error([$e->getMessage(), $e->getFile()]);

            return $this->respondInternalError('Something went wrong!');
        }
    }

    public function validation(ImageUploadRequest $request)
    {
        // $uploadedImage = $request->file('image');
        // \Log::info($uploadedImage);
        // // Get the size in bytes
        // $sizeInBytes = $uploadedImage->getSize();
        // $sizeInkb = $sizeInBytes / 1024;
        // \Log::info(['Image size in MB' => $sizeInkb / 1024]);

        return $this->success('Validation Success');
    }
}
