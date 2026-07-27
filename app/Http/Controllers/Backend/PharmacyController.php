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
    public function list(Request $request) {
        try {
            $type = $request->get('type');
            $data = [];
            switch ($type) {
                case 'madicine':
                    $data = DB::table('pharmacy_medicines')
                        ->leftJoin('pharmacy_suppliers', 'pharmacy_suppliers.id', '=', 'pharmacy_medicines.pharmacy_supplier_id')
                        ->leftJoin('pharmacy_categories', 'pharmacy_categories.id', '=', 'pharmacy_medicines.category_id') // Corrected Join
                        ->select(
                            'pharmacy_medicines.id', 'pharmacy_medicines.brand_name', 'pharmacy_medicines.generic_name', 'pharmacy_medicines.hsn_code', 
                            'pharmacy_medicines.drug_type', 'pharmacy_medicines.unit_of_measure', 'pharmacy_medicines.min_reorder_level', 
                            'pharmacy_medicines.rack_number', 'pharmacy_medicines.shelf_number',
                            'pharmacy_suppliers.name as supplier_name', 
                            'pharmacy_categories.name as category_name'
                        )
                        // ->where('pharmacy_medicines.customer_id', authUser()->customer_id) // Added Table Prefix
                        ->get();
                    break;

                case 'batchMadicine':
                    $data = DB::table('pharmacy_medicine_batches')
                        ->leftJoin('pharmacy_medicines', 'pharmacy_medicines.id', '=', 'pharmacy_medicine_batches.medicine_id')
                        ->leftJoin('pharmacy_suppliers', 'pharmacy_suppliers.id', '=', 'pharmacy_medicines.pharmacy_supplier_id')
                        ->leftJoin('pharmacy_categories', 'pharmacy_categories.id', '=', 'pharmacy_medicines.category_id')
                        ->select(
                            'pharmacy_medicine_batches.id', 'pharmacy_medicine_batches.mfg_date', 'pharmacy_medicine_batches.expiry_date',
                            'pharmacy_medicine_batches.purchase_qty', 'pharmacy_medicine_batches.current_qty', 'pharmacy_medicine_batches.unit_cost_price',
                            'pharmacy_medicine_batches.unit_mrp', 'pharmacy_medicine_batches.selling_price', 'pharmacy_medicine_batches.tax_percentage',
                            'pharmacy_medicine_batches.batch_number',
                            'pharmacy_medicines.generic_name', 'pharmacy_medicines.brand_name',
                            'pharmacy_suppliers.name as supplier_name'
                        )
                        // ->where('pharmacy_medicines.customer_id', authUser()->customer_id)
                        ->get();
                    break;
                
                default:
                $firstExpireFirstOut = DB::select("SELECT b.id AS batch_id, b.batch_number,
                                b.current_qty, b.expiry_date, b.unit_mrp, b.selling_price
                                FROM pharmacy_medicine_batches b
                                WHERE b.expiry_date >= CURDATE() 
                                AND b.customer_id=?
                                AND b.medicine_id=?
                                AND b.current_qty > 0
                                ORDER BY b.expiry_date ASC
                            ");

                    $expiredMedicineAlert = DB::select("SELECT m.brand_name, m.generic_name, b.batch_number, b.current_qty,
                                            b.expiry_date, s.company_name AS supplier_name
                                        FROM pharmacy_medicine_batches b
                                        JOIN pharmacy_medicines m ON m.id = b.medicine_id
                                        LEFT JOIN pharmacy_suppliers s ON s.id = b.pharmacy_supplier_id
                                        WHERE b.customer_id=? 
                                        AND b.current_qty > 0 
                                        AND b.expiry_date < CURDATE();
                            ");

                    $nearExpiryWarning = DB::select("SELECT m.brand_name, b.batch_number, b.current_qty,
                                                b.expiry_date, DATEDIFF(b.expiry_date, CURDATE()) AS days_left
                                            FROM pharmacy_medicine_batches b
                                            JOIN pharmacy_medicines m ON m.id = b.medicine_id
                                            WHERE b.customer_id=?
                                            AND b.current_qty > 0 
                                            AND b.expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 60 DAY)
                                            ORDER BY b.expiry_date ASC;
                            ");

                    $lowStockAndReorderAlerts = DB::select("SELECT m.id AS medicine_id, m.brand_name, m.generic_name,
                                                        m.min_reorder_level, COALESCE(SUM(b.current_qty), 0) AS total_available_qty,
                                                        s.company_name AS preferred_supplier
                                                    FROM pharmacy_medicines m
                                                    LEFT JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id AND b.expiry_date >= CURDATE()
                                                    LEFT JOIN pharmacy_suppliers s ON s.id = m.pharmacy_supplier_id
                                                    WHERE m.customer_id=? 
                                                    AND m.status = 1
                                                    GROUP BY m.id, m.brand_name, m.generic_name, m.min_reorder_level, s.company_name
                                                    HAVING total_available_qty <= m.min_reorder_level;
                            ");

                    $medicineSearchAndLocation = DB::select("SELECT m.brand_name, m.generic_name, m.rack_number,
                                                                    m.shelf_number, c.name AS category_name, SUM(b.current_qty) AS stock_available
                                                                FROM pharmacy_medicines m
                                                                LEFT JOIN pharmacy_categories c ON c.id = m.category_id
                                                                LEFT JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id
                                                                WHERE m.customer_id = ? 
                                                                AND m.brand_name LIKE '%?%'
                                                                GROUP BY m.id, m.brand_name, m.generic_name, m.rack_number, m.shelf_number, c.name;
                            ");

                    $scheduleHNarcoticMedicinesList = DB::select("SELECT m.brand_name, m.generic_name, m.hsn_code,
                                                                CASE 
                                                                    WHEN m.drug_type = 1 THEN 'OTC'
                                                                    WHEN m.drug_type = 2 THEN 'SCHEDULE_H'
                                                                    WHEN m.drug_type = 3 THEN 'SCHEDULE_H1'
                                                                    WHEN m.drug_type = 4 THEN 'NARCOTIC'
                                                                END AS drug_category, SUM(b.current_qty) AS total_stock
                                                            FROM pharmacy_medicines m
                                                            JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id
                                                            WHERE m.customer_id = ? 
                                                            AND m.drug_type IN (2, 3, 4)
                                                            GROUP BY m.id, m.brand_name, m.generic_name, m.hsn_code, m.drug_type;
                            ");

                    $ledgerAndAccountingQueries = DB::select("SELECT s.id, s.company_name, s.name, s.contact,
                                                        s.gst_no, s.drug_license_no, s.opening_balance, s.credit_limit
                                                    FROM pharmacy_suppliers s
                                                    WHERE s.customer_id = ? 
                                                    AND s.party_type IN (2, 3) -- 2 = Supplier
                                                    AND s.status = 1;
                            ");

                    $udharOverlimitCustomerAlert = DB::select("SELECT s.name AS customer_name,
                                                        s.contact, s.opening_balance, s.credit_limit
                                                    FROM pharmacy_suppliers s
                                                    WHERE s.customer_id = ? 
                                                    AND s.party_type IN (1, 3) -- Customer or Both
                                                    AND s.balance_type = 1 -- Credit
                                                    AND s.opening_balance > s.credit_limit;
                            ");

                    $salesStockDeduction = DB::select("UPDATE pharmacy_medicine_batches 
                                                    SET current_qty = current_qty - 5,
                                                        updated_at = NOW()
                                                    WHERE id = ?
                                                    AND customer_id = ? 
                                                    AND current_qty >= 5;
                            ");

                    $totalPharmacyStockValueReport = DB::select("SELECT 
                                                        COUNT(DISTINCT b.medicine_id) AS total_unique_medicines,
                                                        SUM(b.current_qty) AS total_items_in_stock,
                                                        SUM(b.current_qty * b.unit_cost_price) AS total_investment_cost,
                                                        SUM(b.current_qty * b.unit_mrp) AS total_mrp_value,
                                                        SUM(b.current_qty * b.selling_price) AS total_expected_revenue
                                                    FROM pharmacy_medicine_batches b
                                                    WHERE b.customer_id = ? 
                                                    AND b.current_qty > 0 
                                                    AND b.expiry_date >= CURDATE();
                            ");

                    $categoryWiseStockBreakdown = DB::select("SELECT 
                                                    c.name AS category_name,
                                                    COUNT(m.id) AS total_medicines,
                                                    COALESCE(SUM(b.current_qty), 0) AS total_quantity,
                                                    COALESCE(SUM(b.current_qty * b.selling_price), 0) AS category_stock_value
                                                FROM pharmacy_categories c
                                                LEFT JOIN pharmacy_medicines m ON m.category_id = c.id
                                                LEFT JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id
                                                WHERE c.customer_id = ?
                                                GROUP BY c.id, c.name;
                            ");

                    $multiTenantAnalyticsBySuperAdmin = DB::select("SELECT 
                                                            c.customer_id,
                                                            COUNT(DISTINCT m.id) AS total_medicines_added,
                                                            COUNT(DISTINCT b.id) AS total_active_batches,
                                                            SUM(b.current_qty) AS total_inventory_units
                                                        FROM pharmacy_categories c
                                                        LEFT JOIN pharmacy_medicines m ON m.customer_id = c.customer_id
                                                        LEFT JOIN pharmacy_medicine_batches b ON b.customer_id = c.customer_id
                                                        GROUP BY c.customer_id;
                            ");

                    return response()->json(['status' => false, 'message' => 'Invalid type', 'data' => []], 400);
            }

            return response()->json([
                'status' => true,
                'data'   => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


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
