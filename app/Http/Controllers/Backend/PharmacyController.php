<?php

namespace App\Http\Controllers\Backend;

use Throwable;
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
use Illuminate\Support\Facades\Log;
use App\Models\Backend\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\CustomerRegistrationService;

class PharmacyController extends Controller {
    use ValidationTrait;
    // Customer Start
        public function parties(Request $request) {
            if ($request->ajax()) {
                $view = view("backend.pharmacy.parties.index");
                return $view->renderSections()['content']; 
            }
            return view("backend.pharmacy.parties.index");
        }

        public function partyCreate(Request $request) {
            $hospitals = DB::table('hospitals')->where('customer_id', authUser()->customer_id)
                            ->pluck('name', 'id')->toArray();
            $firms = DB::table('firms')->where('customer_id', authUser()->customer_id)
                            ->where('hospital_id', authUser()->hospital_id)
                            ->pluck('name', 'id')->toArray();
            if ($request->ajax()) {
                $view = view("backend.pharmacy.parties.create", [
                            'hospitals' => $hospitals,
                            'firms' => $firms,
                        ]);

                return $view->renderSections()['content'];
            }
            return view("backend.pharmacy.parties.index", [
                'firms' => $firms,
                'hospitals' => $hospitals,
            ]); // Normal load par index par hi rakhe
        }

        public function partySave(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationPartySupplierTrait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }

                // Safe Helper to handle Null & Trim together
                $customer = [
                    'customer_id'      => authUser()->customer_id,
                    'hospital_id'      => isset($data['hospital_id']) ? trim($data['hospital_id']) : null,
                    'firm_id'          => isset($data['firm_id']) ? trim($data['firm_id']) : null,
                    'company_name'     => isset($data['company_name']) ? formatedName($data['company_name']) : null,
                    'name'             => isset($data['name']) ? formatedName($data['name']) : null,
                    'slug'             => isset($data['name']) ? formatedSlug($data['name']) : null,
                    'doctor_name'      => isset($data['doctor_name']) ? formatedName($data['doctor_name']) : null,
                    'email'            => isset($data['email']) ? formatedEmail($data['email']) : null,
                    'gst_no'           => isset($data['gst_no']) ? gstNumber($data['gst_no']) : null,
                    'pan_no'           => isset($data['pan_no']) ? panNumber($data['pan_no']) : null,
                    'contact'          => isset($data['contact']) ? trim($data['contact']) : null,
                    'doctor_address'   => isset($data['doctor_address']) ? trim($data['doctor_address']) : null,
                    'balance_type'     => isset($data['balance_type']) ? (int) $data['balance_type'] : null,
                    'party_type'       => isset($data['party_type']) ? (int) $data['party_type'] : 1,
                    'opening_balance'  => isset($data['opening_balance']) ? (float) $data['opening_balance'] : 0.00,
                    'credit_limit'     => isset($data['credit_limit']) ? (float) $data['credit_limit'] : 0.00,
                    'status'           => 1,
                    'created_at'       => now()
                ];
                
                $lastId = DB::table('pharmacy_suppliers')->insertGetId($customer);
                storeLog("Pharmacy Customer Created");
                return json_response(true, 200, 'Pharmacy Customer created successfully.');

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return redirect()->back()->with('error', 'Export Error: ' . $th->getMessage());
            }
        }

    // Customer End



    // Supplier Start
        public function supplier(Request $request) {
            if ($request->ajax()) {
                $view = view("backend.pharmacy.supplier.index");
                return $view->renderSections()['content']; 
            }
            return view("backend.pharmacy.supplier.index");
        }

        public function supplierCreate(Request $request) {
            $hospitals = DB::table('hospitals')->where('customer_id', authUser()->customer_id)
                            ->pluck('name', 'id')->toArray();
            $firms = DB::table('firms')->where('customer_id', authUser()->customer_id)
                            ->where('hospital_id', authUser()->hospital_id)
                            ->pluck('name', 'id')->toArray();
            if ($request->ajax()) {
                $view = view("backend.pharmacy.supplier.create", [
                            'hospitals' => $hospitals,
                            'firms' => $firms,
                        ]);

                return $view->renderSections()['content'];
            }
            return view("backend.pharmacy.supplier.index", [
                'firms' => $firms,
                'hospitals' => $hospitals,
            ]); // Normal load par index par hi rakhe
        }

        public function supplierSave(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationPartySupplierTrait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }

                // Safe Helper to handle Null & Trim together
                $supplier = [
                    'customer_id'      => authUser()->customer_id,
                    'hospital_id'      => isset($data['hospital_id']) ? trim($data['hospital_id']) : null,
                    'firm_id'          => isset($data['firm_id']) ? trim($data['firm_id']) : null,
                    'company_name'     => isset($data['company_name']) ? formatedName($data['company_name']) : null,
                    'name'             => isset($data['name']) ? formatedName($data['name']) : null,
                    'slug'             => isset($data['name']) ? formatedSlug($data['name']) : null,
                    'doctor_name'      => isset($data['doctor_name']) ? formatedName($data['doctor_name']) : null,
                    'contact_person'   => isset($data['contact_person']) ? formatedName($data['contact_person']) : null,
                    'email'            => isset($data['email']) ? formatedEmail($data['email']) : null,
                    'gst_no'           => isset($data['gst_no']) ? gstNumber($data['gst_no']) : null,
                    'pan_no'           => isset($data['pan_no']) ? panNumber($data['pan_no']) : null,
                    'contact'          => isset($data['contact']) ? trim($data['contact']) : null,
                    'address'          => isset($data['address']) ? trim($data['address']) : null,
                    'doctor_address'   => isset($data['doctor_address']) ? trim($data['doctor_address']) : null,
                    'balance_type'     => isset($data['balance_type']) ? (int) $data['balance_type'] : null,
                    'party_type'       => isset($data['party_type']) ? (int) $data['party_type'] : null,
                    'opening_balance'  => isset($data['opening_balance']) ? (float) $data['opening_balance'] : 0.00,
                    'credit_days'      => isset($data['credit_days']) ? (int) $data['credit_days'] : 0,
                    'drug_license_no'  => isset($data['drug_license_no']) ? drugLicence($data['drug_license_no']) : null,
                    'status'           => 1,
                    'created_at'       => now(),
                ];
                
                $lastId = DB::table('pharmacy_suppliers')->insertGetId($supplier);
                storeLog("Supplier Created");
                return json_response(true, 200, 'Supplier created successfully.');

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return redirect()->back()->with('error', 'Export Error: ' . $th->getMessage());
            }
        }

    // Supplier End



    // Vendor Start
        public function vendor(Request $request) {
            if ($request->ajax()) {
                $view = view("backend.pharmacy.vendor.index");
                return $view->renderSections()['content']; 
            }
            return view("backend.pharmacy.vendor.index");
        }

        public function vendorCreate(Request $request) {
            $hospitals = DB::table('hospitals')->where('customer_id', authUser()->customer_id)
                            ->pluck('name', 'id')->toArray();
            $firms = DB::table('firms')->where('customer_id', authUser()->customer_id)
                            ->where('hospital_id', authUser()->hospital_id)
                            ->pluck('name', 'id')->toArray();
            if ($request->ajax()) {
                $view = view("backend.pharmacy.vendor.create", [
                            'hospitals' => $hospitals,
                            'firms' => $firms,
                        ]);

                return $view->renderSections()['content'];
            }
            return view("backend.pharmacy.vendor.index", [
                'firms' => $firms,
                'hospitals' => $hospitals,
            ]); // Normal load par index par hi rakhe
        }

        public function vendorSave(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationPartySupplierTrait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }
                // Safe Helper to handle Null & Trim together
                $vendor = [
                    'customer_id'      => authUser()->customer_id,
                    'hospital_id'      => isset($data['hospital_id']) ? trim($data['hospital_id']) : null,
                    'firm_id'          => isset($data['firm_id']) ? trim($data['firm_id']) : null,
                    'company_name'     => isset($data['company_name']) ? formatedName($data['company_name']) : null,
                    'name'             => isset($data['name']) ? formatedName($data['name']) : null,
                    'slug'             => isset($data['name']) ? formatedSlug($data['name']) : null,
                    'doctor_name'      => isset($data['doctor_name']) ? formatedName($data['doctor_name']) : null,
                    'email'            => isset($data['email']) ? formatedEmail($data['email']) : null,
                    'gst_no'           => isset($data['gst_no']) ? gstNumber($data['gst_no']) : null,
                    'pan_no'           => isset($data['pan_no']) ? panNumber($data['pan_no']) : null,
                    'contact'          => isset($data['contact']) ? trim($data['contact']) : null,
                    'address'          => isset($data['address']) ? trim($data['address']) : null,
                    'doctor_address'   => isset($data['doctor_address']) ? trim($data['doctor_address']) : null,
                    'balance_type'     => isset($data['balance_type']) ? (int) $data['balance_type'] : 1,
                    'drug_license_no'  => isset($data['drug_license_no']) ? drugLicence($data['drug_license_no']) : null,
                    'party_type'       => 4,
                    'status'           => 1,
                    'created_at'       => now()
                ];
                
                $lastId = DB::table('pharmacy_suppliers')->insertGetId($vendor);
                storeLog("Vendor Created");
                return json_response(true, 200, 'Vendor created successfully.');

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return redirect()->back()->with('error', 'Export Error: ' . $th->getMessage());
            }
        }
    // Vendor End



    // Madicine Start
        public function madicine(Request $request) {
            if ($request->ajax()) {
                $view = view("backend.pharmacy.madicine.index");
                return $view->renderSections()['content']; 
            }
            return view("backend.pharmacy.madicine.index");
        }

        public function madicineCreate(Request $request) {
            $suppliers = DB::table('pharmacy_suppliers')->where('customer_id', authUser()->customer_id)
                            ->whereIn('party_type', [2,3,4])
                            ->pluck('name', 'id')->toArray();

            $categories = DB::table('pharmacy_categories')->where('customer_id', authUser()->customer_id)
                            ->pluck('name', 'id')->toArray();

            if ($request->ajax()) {
                $view = view("backend.pharmacy.madicine.create", [
                            'suppliers' => $suppliers,
                            'categories' => $categories,
                        ]);

                return $view->renderSections()['content'];
            }
            return view("backend.pharmacy.madicine.index", [
                'suppliers' => $suppliers,
                'categories' => $categories,
            ]); // Normal load par index par hi rakhe
        }

        public function madicineSave(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationPartySupplierTrait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }
                // Safe Helper to handle Null & Trim together
                $vendor = [
                    'customer_id'      => authUser()->customer_id,
                    'hospital_id'      => isset($data['hospital_id']) ? trim($data['hospital_id']) : null,
                    'firm_id'          => isset($data['firm_id']) ? trim($data['firm_id']) : null,
                    'company_name'     => isset($data['company_name']) ? formatedName($data['company_name']) : null,
                    'name'             => isset($data['name']) ? formatedName($data['name']) : null,
                    'slug'             => isset($data['name']) ? formatedSlug($data['name']) : null,
                    'doctor_name'      => isset($data['doctor_name']) ? formatedName($data['doctor_name']) : null,
                    'email'            => isset($data['email']) ? formatedEmail($data['email']) : null,
                    'gst_no'           => isset($data['gst_no']) ? gstNumber($data['gst_no']) : null,
                    'pan_no'           => isset($data['pan_no']) ? panNumber($data['pan_no']) : null,
                    'contact'          => isset($data['contact']) ? trim($data['contact']) : null,
                    'address'          => isset($data['address']) ? trim($data['address']) : null,
                    'doctor_address'   => isset($data['doctor_address']) ? trim($data['doctor_address']) : null,
                    'balance_type'     => isset($data['balance_type']) ? (int) $data['balance_type'] : 1,
                    'drug_license_no'  => isset($data['drug_license_no']) ? drugLicence($data['drug_license_no']) : null,
                    'party_type'       => 4,
                    'status'           => 1,
                    'created_at'       => now()
                ];
                
                $lastId = DB::table('pharmacy_suppliers')->insertGetId($vendor);
                storeLog("Vendor Created");
                return json_response(true, 200, 'Vendor created successfully.');

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return redirect()->back()->with('error', 'Export Error: ' . $th->getMessage());
            }
        }

        public function batchCreate(Request $request) {
            $suppliers = DB::table('pharmacy_suppliers')->where('customer_id', authUser()->customer_id)
                            ->whereIn('party_type', [2,3,4])
                            ->pluck('name', 'id')->toArray();

            $vendors = DB::table('pharmacy_suppliers')->where('customer_id', authUser()->customer_id)
                            ->where('party_type', 4)
                            ->pluck('name', 'id')->toArray();

            $medicines = DB::table('pharmacy_categories')->where('customer_id', authUser()->customer_id)
                            ->pluck('name', 'id')->toArray();

            if ($request->ajax()) {
                $view = view("backend.pharmacy.madicine.batch", [
                            'suppliers' => $suppliers,
                            'medicines' => $medicines,
                            'vendors' => $vendors,
                        ]);
                
                return $view->renderSections()['content'];
            }
            return view("backend.pharmacy.madicine.index", [
                'suppliers' => $suppliers,
                'medicines' => $medicines,
                'vendors' => $vendors,
            ]); // Normal load par index par hi rakhe
        }

        public function batchSave(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationPartySupplierTrait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }
                // Safe Helper to handle Null & Trim together
                $vendor = [
                    'customer_id'      => authUser()->customer_id,
                    'hospital_id'      => isset($data['hospital_id']) ? trim($data['hospital_id']) : null,
                    'firm_id'          => isset($data['firm_id']) ? trim($data['firm_id']) : null,
                    'company_name'     => isset($data['company_name']) ? formatedName($data['company_name']) : null,
                    'name'             => isset($data['name']) ? formatedName($data['name']) : null,
                    'slug'             => isset($data['name']) ? formatedSlug($data['name']) : null,
                    'doctor_name'      => isset($data['doctor_name']) ? formatedName($data['doctor_name']) : null,
                    'email'            => isset($data['email']) ? formatedEmail($data['email']) : null,
                    'gst_no'           => isset($data['gst_no']) ? gstNumber($data['gst_no']) : null,
                    'pan_no'           => isset($data['pan_no']) ? panNumber($data['pan_no']) : null,
                    'contact'          => isset($data['contact']) ? trim($data['contact']) : null,
                    'address'          => isset($data['address']) ? trim($data['address']) : null,
                    'doctor_address'   => isset($data['doctor_address']) ? trim($data['doctor_address']) : null,
                    'balance_type'     => isset($data['balance_type']) ? (int) $data['balance_type'] : 1,
                    'drug_license_no'  => isset($data['drug_license_no']) ? drugLicence($data['drug_license_no']) : null,
                    'party_type'       => 4,
                    'status'           => 1,
                    'created_at'       => now()
                ];
                
                $lastId = DB::table('pharmacy_suppliers')->insertGetId($vendor);
                storeLog("Vendor Created");
                return json_response(true, 200, 'Vendor created successfully.');

            } catch(Throwable $th) {
                Log::error(['message' => $th->getMessage()]);
                return redirect()->back()->with('error', 'Export Error: ' . $th->getMessage());
            }
        }

    // Madicine End



    // Inventory Start
        public function inventory() {
            return view("backend.pharmacy.inventory.index");
        }
        
    // Inventory End



    // Purchase Start
        public function purchase() {
            return view("backend.pharmacy.purchase.index");
        }
        
    // Purchase End



    // Sales Start
        public function sales() {
            return view("backend.pharmacy.sales.index");
        }
        
    // Sales End



    // Stock Start
        public function stock() {
            return view("backend.pharmacy.stock.index");
        }
        
    // Stock End



    // Report Start
        public function report() {
            return view("backend.pharmacy.report.index");
        }
        
    // Report End




}
