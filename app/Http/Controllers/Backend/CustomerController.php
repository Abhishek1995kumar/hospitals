<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Backend\Role;
use App\Traits\ValidationTrait;
use App\Models\Backend\Customer;
use App\Models\Backend\Hospital;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\Backend\Department;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\CustomerRegistrationService;

class CustomerController extends Controller {
    use ValidationTrait;
    public function index(Request $request) {
        if ($request->ajax()) {
            $view = view('backend.customer.index');
            return $view->renderSections()['content']; 
        }
        return view('backend.customer.index');
    }

    public function create(Request $request) {
        $countries = DB::table('countries')->pluck('id', 'name')->toArray();
        if ($request->ajax()) {
            $view = view('backend.customer.create', compact('countries'));
            return $view->renderSections()['content'];
        }
        return view('backend.customer.index'); // Normal load par index par hi rakhe
    }


    public function getStates($country_id) {
        $states = DB::table('states')
                    ->where('country_id', $country_id)
                    ->pluck('name', 'id'); // [id => name] array return karega

        return response()->json($states);
    }

    public function getCities($state_id) {
        $states = DB::table('cities')
                    ->where('state_id', $state_id)
                    ->pluck('name', 'id'); // [id => name] array return karega

        return response()->json($states);
    }


    public function save(Request $request, CustomerRegistrationService $registrationService) {
        try {
            $data = $request->all();
            $validation = $this->validationCustomerTait($data);
            if ($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }

            $customerData = $registrationService->register($data); // Register Customer via Service
            SendWelcomeEmailJob::dispatch(
                $customerData['email'],
                [
                    'name'     => $customerData['name'],
                    'email'    => $customerData['email'],
                    'password' => $customerData['password']
                ],
                'Registration Successful',
                'backend.emails.customer_register',
                CustomerRegisterMail::class
            );

            // Log Action
            storeLog("Customer Registration");

            return json_response(true, 200, "Customer created successfully.");

        } catch (\Throwable $th) {
            \Log::error("Customer Save Error: " . $th->getMessage());
            return json_response(false, 500, "Something went wrong: " . $th->getMessage());
        }
    }


}
