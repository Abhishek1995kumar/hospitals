<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller {
    public function index() {
        return view('backend.department.index');
    }

    public function parentSave(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->parentValidationDepartmentTrait($data);

        } catch(Throwable $th) {

        }
    }

    public function childSave(Request $request) {
        try {
            $data = $request->all();
            $validation = $this->childValidationDepartmentTrait($data);

        } catch(Throwable $th) {

        }
    }
}
