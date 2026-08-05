<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Plan;
use App\Models\Backend\Feature;
use App\Models\Backend\FeaturePlan;

use App\Traits\ValidationTrait;
use App\Traits\DatabaseQueryTrait;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;

class FeaturePlanController extends Controller {
    use ValidationTrait, DatabaseQueryTrait;

    public function index() {
        $plans = $this->planListTrait();
        $features = $this->featureListTrait();
        // dd($features);
        $modules = $this->getAllModulesListTrait();
        return view('backend.settings.plans.index', [
            'plans' => $plans,
            'features' => $features,
            'modules' => $modules
        ]);
    }


    public function list(Request $request) {
        try {
            if (!$request->filled('type')) {
                return json_response(false, 400, 'List type is required');
            }
            // $loggedInRole = $this->loggedInRolesTrait();
            
            switch ($request->type) {
                case 'plan':
                    // if($loggedInRole[0]->is_system == 0 && $loggedInRole[0]->scope == 0) {
                        $plans = $this->planListTrait();
                        $data = $plans;
                    // }
                    $message = 'Plan fetched successfully';
                    break;

                case 'feature':
                    // if($user->customer_id == NULL || $user->customer_id == '') {
                        $features = $this->featureListTrait();
                        $data = $features;
                    // }
                    $message = 'Feature fetched successfully';
                    break;

                case 'planFeature':
                    // if($user->customer_id == NULL || $user->customer_id == '') {
                        $featurePlans = $this->planFeatureListTrait();
                        $data = $featurePlans;
                    // } 
                    $message = 'Feature plan fetched successfully';
                    break;

                default:
                    return json_response(false, 400, 'Invalid list type');
            }
            
            return json_response(true, 200, $message, $data);

        } catch (\Exception $e) {
            return json_response(false, 500, $e->getMessage());

        }
    }


    public function save(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->validationPlanTait($data);
            if ($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }

            $plan                 = new Plan();
            $plan->plan_name      = trim($data['plan_name']);
            $plan->price          = trim($data['price']);
            $plan->duration_days  = (int) $data['duration_days'];
            $plan->max_hospitals  = $data['max_hospitals'];
            $plan->max_firms      = $data['max_firms'];
            $plan->max_users      = $data['max_users'];
            $plan->status         = 1;
            $plan->updated_at     = NULL;
            $plan->save();
            storeLog("Plan Create");
            return json_response(true, 200, 'Plan created successfully.');

        } catch (Throwable $th) {
            Log::error($th);
            return json_response(false, 500, $th->getMessage());
        }
    }

    public function featureSave(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->validationFeatureTait($data);
            if ($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }
            
            $feature               = new Feature();
            $feature->feature_name = trim(ucwords($data['feature_name']));
            $feature->feature_slug = trim(str_replace(' ', '_', strtolower($data['feature_name'])));
            $feature->module_id    = (int) $data['module_name'];
            $feature->description  = trim(ucwords($data['description']));
            $feature->status       = 1;
            $feature->updated_at   = NULL;
            $feature->save();
            storeLog("Feature Create");
            return json_response(true, 200, 'Feature created successfully.');

        } catch (Throwable $th) {
            Log::error($th);
            return json_response(false, 500, $th->getMessage());
        }
    }


    public function planFeatureMapping(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->validationPlanFeatureMappingTait($data);
            if($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }
            
            DB::transaction(function () use ($data) {
                foreach($data['feature_id'] as $feature) {
                    FeaturePlan::create([
                        'plan_id'    => (int) $data['plan_id'],
                        'feature_id' => (int) $feature,
                        'created_at' => now(),
                        'updated_at' => NULL,
                    ]);
                }
            });

            storeLog("Feature Plan Mapping");
            return json_response(true, 200, 'Feature plan mapping created successfully.');

        } catch(Throwable $th) {
            Log::error(['message' => $th->getMessage()]);
            return json_response(false, 500, $th->getMessage());
        }
    }
}
