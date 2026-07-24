<?php

namespace App\Http\Controllers\Backend;

use Throwable;
use Illuminate\Http\Request;
use App\Exports\SupplierExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


use App\Http\Controllers\Controller;

class ExcelController extends Controller {
    public function export(Request $request, $type = null) {
        try {
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 0);
            set_time_limit(0);

            // Path ya Query String dono se type capture karna
            $type = $type ?? $request->get('type');

            switch ($type) {
                case 'supplier':
                    $supplierSheetRow = config('constant.FORMATTED_ROWS', 100);
                    $hospitals = DB::table('hospitals')
                                    ->where('customer_id', authUser()->customer_id)
                                    ->pluck('name', 'id')
                                    ->toArray();

                    $firms = DB::table('firms')
                                ->where('customer_id', authUser()->customer_id)
                                ->where('hospital_id', authUser()->hospital_id)
                                ->get();

                    $columns = [
                        'Hospital Name', 'Firm Location', 'Company Name', 'Name', 'Email', 'Contact',
                        'GST Number', 'Pan Number', 'Doctor Name', 'Doctor Address', 'Balance Type', 'Party Type',
                        'Opening Balance', 'Credit Limit (Only Customer)', 'Credit Days (Only Supplier)', 
                        'Contact Person (Only Supplier)', 'Drug License Number (Only Supplier)',
                    ];

                    $partyType = ['Customer', 'Supplier', 'Customer+Supplier', 'Vendor', 'Referral Doctor', 'Manufacturer'];

                    $data = [
                        'hospital_column_index' => 0,
                        'hospital_column' => $hospitals,
                        'firm_location_column_index' => 1,
                        'firm_location_column' => $firms,
                        'party_type_column_index' => 11,
                        'party_type_column' => $partyType,
                    ];
                    
                    $fileName = 'supplier-sample-' . time() . '.xlsx';

                    // Direct browser me local system par download karwane ke liye Excel::download use karein
                    return Excel::download(
                        new SupplierExport($columns, $supplierSheetRow, $data), 
                        $fileName
                    );

                default:
                    return redirect()->back()->with('error', 'Invalid export type.');
            }

        } catch (Throwable $th) {
            Log::error(['message' => $th->getTraceAsString()]);
            return redirect()->back()->with('error', 'Export Error: ' . $th->getMessage());
        }
    }
}
