<?php

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\Str;
use App\Models\Backend\Customer;
use App\Models\Backend\Hospital;
use App\Models\Backend\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Backend\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use Symfony\Component\Mime\Email;


if (!function_exists('authUser')) {
    function authUser() {
        return session('user_auth_data');
    }
}


if(!function_exists('storeLog')) {
    function storeLog($action, $requestData = []) {
        $auth = Auth::user();
        if ($auth) {
            $userId = $auth->id;
        } else {
            $userId = null;
        }
        $explode = explode(" ", $action);
        try {
            $log                = new AuditLog();
            $log->user_id       = $userId;
            $log->ip_address    = request()->ip();             // User ka IP address yaha se milega
            $log->module        = $explode[0];
            $log->action        = $action;                     // function name 
            $log->browser       = getUserBrowser();            // web/mobile
            $log->device        = getUserDevice();             // Laptop/mobile/tab/
            $log->url           = request()->fullUrl();        // full url
            $log->method        = request()->method();         // GET/POST/PUT/DELETE
            $log->user_os       = getUserOS();                 // GET/POST/PUT/DELETE
            $log->request_data  = !empty($requestData) ? json_encode($requestData) : json_encode(request()->except(['password', 'password_confirmation', '_token'])); // data jo request me aaya hai
            $log->save();
            return true;
        } catch(\Exception $e) {
            \Log::error('Store Log Error : ' . $e->getMessage());
            return false;
        }
    }
}


// Helper Function
if(!function_exists('sendMail')) {
    function sendMail($email, array $data, string $subject, string $view, $mailableClass) {
        Log::info('Sending Email', ['email' => $email, 'subject' => $subject, 'name'=> $data['name'] ?? 'N/A']);
        Mail::to($email)->send(new $mailableClass($data, $subject, $view));
        return true;
    }
}


if(!function_exists('uploadImage')) {
    function uploadImage($file, $path) {
        try {
            $fileName = null;
            // Agar file array hai aur valid tmp_name hai
            if (is_array($file) && isset($file['tmp_name'], $file['name']) && is_uploaded_file($file['tmp_name'])) {
                $uploadDir = public_path('uploads/' . trim($path, '/') . '/');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Unique file name
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('img_', true) . '.' . $ext;

                // Move file
                $destination = $uploadDir . $fileName;
                if (!move_uploaded_file($file['tmp_name'], $destination)) {
                    $fileName = null;
                }

            } elseif (is_string($file) && !empty($file)) { // Agar string pass hua hai (edit ke time already image ka naam)
                $fileName = $file;

            } else {
                $oldImagePath = public_path('uploads/' . trim($path, '/') . '/');
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $fileName = $file;
            }
            return $fileName;

        } catch (\Throwable $th) {
            Log::error('Upload Image Error : '.$th->getMessage());
            return false;
        }
    }
}



if (!function_exists('drugLicence')) {
    function drugLicence($value) {
        $pattern = '#^[A-Z]{2}[-/\s]?[A-Z0-9]{2,5}[-/\s]?(20|20B|20F|20G|21|21B)[-/\s]?[0-9]{4,8}$#i'; // yaha par delimiter # ye hai kyoki yaha par / back slash bahut baar use ho rha hai, jo code ko terminate kar dega iss liye # ye use kiya hai
        if(trim(preg_match($pattern, ((string) $value), $matchs))) {
            return strtoupper($matchs[0]);
        }
        return false;
    }
}


if (!function_exists('gstNumber')) {
    function gstNumber($value) {
        $pattern = '/^[0-9]{2}[aA-zZ]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[aA-zZ]{1}[0-9A-Z]{1}$/';
        if(trim(preg_match($pattern, ((string) $value), $matchs))) {
            return strtoupper($matchs[0]);
        }
        return false;
    }
}


if (!function_exists('panNumber')) {
    function panNumber($value) {
        $pattern = '/^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/';
        if(trim(preg_match($pattern, ((string) $value), $matchs))) {
            return strtoupper($matchs[0]);
        }
        return false;
    }
}


if (!function_exists('hsnNumber')) { // hsn - Harmonized System of Nomenclature
    function hsnNumber($value) {
        $pattern = '/^(\d{6}|\d{8}|\d{10})$/';
        if(trim(preg_match($pattern, ((string) $value), $matchs))) {
            return strtoupper($matchs[0]);
        }
        return false;
    }
}



if (!function_exists('permissionSlug')) {
    function permissionSlug($value): string {
        return trim(
            preg_replace(
                '/_+/',
                '.',
                preg_replace('/[^a-zA-Z]+/', '.', strtolower((string) $value))
            ),
            '.'
        );
    }
}


if (!function_exists('formatedSlug')) {
    function formatedSlug($value): string {
        return trim(
            preg_replace(
                '/_+/',
                '_',
                preg_replace('/[^a-zA-Z]+/', '_', strtolower((string) $value))
            ),
            '_'
        );
    }
}


if (!function_exists('formatedName')) {
    function formatedName($value): string {
        return ucwords(
            trim(
                preg_replace('/_+/', ' ',preg_replace('/[^a-zA-Z]+/', ' ', strtolower((string) $value)))
                ,' ')
            );
    }
}


if (!function_exists('formatedEmail')) {
    function formatedEmail($value): string {
        if (empty($value)) { return ''; }
        $email = strtolower(trim((string) $value)); // Extra spaces remove karein aur lowercase me convert karein
        $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL); // Invalid characters ko sanitize/clean karein
        return $cleanEmail ? : '';
    }
}


if(!function_exists('generateOtp')) {
    function generateOtp() {
        return rand(100000, 999999);
    }
}



if(!function_exists('generateTokenTrait')) {
    function generateTokenTrait() {
        return bin2hex(random_bytes(16));
    }
}



if(!function_exists('json_response')) {
    function json_response(bool $success, int $code, string $message="", mixed $data = []) {
        $response = [
            'success' => $success,
            'code' => $code,
        ];
        if(!is_null($message)) {
            $response['data'] = $message;
        }
        if(!is_null($data)) {
            $response['data'] = $data;
        }
        
        return response()->json($response, $code);
    }
}



if (!function_exists('secure')) {
    function secure($value, $type) {
        if (is_null($value)) {
            return null;
        }
        $output = false;
        $encryptMethod = 'AES-256-CBC';
        $secretKey = config('contant.ENCRYPTION');
        $secretIv = md5(md5($secretKey));
        $key = hash('sha256', $secretKey);
        $iv = substr(hash('sha256', $secretIv), 0, 16);
        try {
            if ($type === 'E') {
                $encrypted = openssl_encrypt($value, $encryptMethod, $key, 0, $iv);
                $output = base64_encode($encrypted);

            } elseif ($type === 'D') {
                $output = openssl_decrypt(base64_decode($value, true), $encryptMethod, $key, 0, $iv);

            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
        return $output;
    }
}

if(!function_exists('otp')) {
    function otp($userId, $email, $otpCode, $name) {
        try {
            $otp = Otp::where('user_id',$userId)->first();
            if ($otp) {
                $otp->otp = $otpCode;
                $otp->expired_at = now()->addMinutes(5);
                $otp->save();
    
            } else {
                $otp = new Otp();
                $otp->otp = $otpCode;
                $otp->user_id = $userId;
                $otp->email = $email;
                $otp->created_by = $userId;
                $otp->expired_at = now()->addMinutes(5);
                $otp->save();
            }
            sendMail($email, ['name'=>$name, 'otp'=> $otpCode], 'Your OTP Generated Successfully', 'backend.emails.otp', OtpVerified::class);
            return true;
    
        } catch (\Exception $e) {
            Log::error('Failed to save login OTP: '.$e->getMessage());
            return false;
        }
    }
}



if (!function_exists('secure1')) {
    function secure1($value, $type) {
        if (is_null($value)) {
            return null;
        }
        try {
            if ($type === 'E') {
                return Crypt::encryptString($value);
            }
            if ($type === 'D') {
                return Crypt::decryptString($value);
            }
            return false;

        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('secure2')) {
    function secure2($value, $type) {
        if (is_null($value)) {
            return null;
        }
        try {
            if ($type === 'E') {
                return rtrim(strtr(encrypt($value), '+/', '-_' ), '=');
            }
            if ($type === 'D') {
                return decrypt(strtr($value, '-_', '+/'));
            }

            return false;

        } catch (\Exception $e) {
            return false;
        }
    }
}



if (!function_exists('generateUniqueUserId')) {
    function generateUniqueUserId() {
        $prefix = 'U_';
        $uniqueId = $prefix . rand(1000000, 9999999);
        $userExists = User::where('user_id', $uniqueId)->exists();
        if($userExists) {
            return generateUniqueUserId();
        }
        return $uniqueId;
    }
}


if (!function_exists('generateUniqueCustomerCode')) {
    function generateUniqueCustomerCode() {
        $prefix = 'C_';
        $uniqueId = $prefix . rand(100000, 999999);
        $userExists = Customer::where('customer_id', $uniqueId)->exists();
        if($userExists) {
            return generateUniqueCustomerCode();
        }
        return $uniqueId;
    }
}


if (!function_exists('generateDepartmentId')) {
    function generateDepartmentId() {
        $prefix = 'D_';
        $uniqueId = $prefix . rand(1000, 9999);
        $departmentExists = Department::where('department_id', $uniqueId)->exists();
        if($departmentExists) {
            return generateDepartmentId();
        }
        return $uniqueId;
    }
}


if (!function_exists('generateUniqueHospitalId')) {
    function generateUniqueHospitalId() {
        $prefix = 'H_';
        $uniqueId = $prefix . rand(100000, 999999);
        $hospitalExists = Hospital::where('hospital_id', $uniqueId)->exists();
        if($hospitalExists) {
            return generateUniqueHospitalId();
        }
        return $uniqueId;
    }
}



if (!function_exists('generateUniqueUsername')) {
    function generateUniqueUsername($email) {
        $emailPart = explode('@', trim($email))[0]; // 1. Email se '@' ke pehle ka part nikaalein (e.g., 'abhishek.kumar12@gmail.com' -> 'abhishek.kumar12')
        $baseUsername = preg_replace('/[^a-zA-Z0-9._]/', '', $emailPart); // 2. Sirf alphanumeric characters aur underscores/dots allow karein (clean username)
        $baseUsername = strtolower($baseUsername);
        $username = $baseUsername;
        $isUnique = false;
        $counter = 1;
        while (!$isUnique) { // Loop chalayein jab tak unique username na mil jaye
            $userExists = User::where('username', $username)->exists(); // Aapka Model aur Column name (Yahan Customer model aur 'username' column check ho raha hai)
            if (!$userExists) {
                $isUnique = true;

            } else {
                $username = $baseUsername . rand(100, 999); // Agar username already hai, toh aage random number ya counter lagayein (e.g., abhishek.kumar952)
                $counter++; // Safety check: Agar bohot baar loop chale toh counter badha dein
                if ($counter > 10) {
                    $username = $baseUsername . time(); // Extreme case me timestamp jod dein
                    break;
                }
            }
        }
        return $username;
    }
}



if (!function_exists('generateUserPassword')) {
    function generateUserPassword($length = 8) {
        // Yeh ek random, secure aur alphanumeric string generate karega (e.g., 'aB3x9Pq2')
        return Str::random($length);
    }
}


if (!function_exists('generateTransactionId')) {
    function generateTransactionId() {
        $prefix = 'CASH-';
        $date = date('Ymd');$uniqueId = $prefix .$date . rand(1000000, 9999999);
        $transactionExists = Subscription::where('transaction_id',$uniqueId)->exists();
        if ($transactionExists) {
            return generateTransactionId();
        }
        return $uniqueId;
    }
}

if (!function_exists('generateInvoiceId')) {
    function generateInvoiceId() {
        $prefix = 'INV-';
        $date = date('Ymd');$uniqueId = $prefix .$date . rand(1000000, 9999999);
        $invoiceExists = Subscription::where('invoice_no',$uniqueId)->exists();
        if ($invoiceExists) {
            return generateInvoiceId();
        }
        return $uniqueId;
    }
}


if (!function_exists('callCurlApi')) {
    function callCurlApi($method, $header, $url, $requestBody = null) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $header,
            CURLINFO_HEADER_OUT => true
        ]);

        // Body sirf tab bhejenge jab available ho
        if (!empty($requestBody)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);
        }

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);

        return [ 'success' => empty($error), 'info' => $info, 'data' => $response, 'error' => $error ];
    }
}
