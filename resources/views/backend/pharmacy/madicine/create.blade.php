@extends('backend.layouts.admin')
@section('content')
    <div id="">
        <a href="javascript:void(0)" class="btn btn-info mb-4" id="backPharmacyMadicineList">
            {{ __('Back')}}
        </a>

        <form method="POST" enctype="matching/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold m-0">Basic Madicine Details </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4 " id="pharmacy_supplier_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Pharmacy Supplier')}}</label>
                                        <select name="pharmacy_supplier_id" id="pharmacy_supplier_id" class="form-select search" data-control="select2" data-placeholder="Select supplier" >
                                            <option selected disabled >{{ __('Select Pharmacy Supplier')}}</option>
                                            @if($suppliers)
                                                @foreach($suppliers as $id => $supplier)
                                                    <option value="{{ $id }}">{{ $supplier }}</option> 
                                                @endforeach
                                            @else
                                                <option value="">{{ __('Data not available')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="category_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Pharmacy Category')}}</label>
                                        <select name="category_id" id="category_id" class="form-select search" data-control="select2" data-placeholder="Select category" >
                                            <option selected disabled >{{ __('Select Pharmacy Category')}}</option>
                                            @if($categories)
                                                @foreach($categories as $id => $category)
                                                    <option value="{{ $id }}">{{ $category }}</option> 
                                                @endforeach
                                            @else
                                                <option disabled >{{ __('Data not available')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="brand_nameDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Brand Name')}}</label>
                                        <input name="brand_name" id="brand_name" class="form-control" type="text" maxlength="100" placeholder="Enter brand name" >
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="generic_nameDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Generic Name')}}</label>
                                        <input name="generic_name" id="generic_name" class="form-control" type="text" maxlength="100" placeholder="Enter generic name" >
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="hsn_codeDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('HSN Code')}}</label>
                                        <input name="hsn_code" id="hsn_code" class="form-control" type="text" maxlength="100" placeholder="Enter hsn code" oninput="validateHNS(this)" >
                                        <span id="hsnCodeError" style="color: red; display: none;">{{ __('Invalid hsn code (e.g. user@example.com)')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="drug_typeDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Drug Type')}}</label>
                                        <select name="drug_type" id="drug_type" class="form-select search" data-control="select2" data-placeholder="Select drug type" >
                                            <option selected disabled >Select Drug Type</option>
                                            <option value="1">OTC</option>
                                            <option value="2">SCHEDULE_H</option>
                                            <option value="2">SCHEDULE_H1</option>
                                            <option value="2">NARCOTIC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="unit_of_measureDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Unit Of Measure')}}</label>
                                        <input name="unit_of_measure" id="unit_of_measure" class="form-control search" placeholder="Select unit of measure" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="min_reorder_levelDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Min Reorder Level')}}</label>
                                        <input name="min_reorder_level" id="min_reorder_level" class="form-control" type="text" maxlength="100" placeholder="Enter min reorder level" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="rack_numberDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Rack Number')}}</label>
                                        <input name="rack_number" id="rack_number" class="form-control" type="decimal" maxlength="10" placeholder="Enter rack number" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="shelf_numberDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Shelf Number')}}</label>
                                        <input name="shelf_number" id="shelf_number" class="form-control" type="text" maxlength="100" placeholder="Enter shelf number" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer modal-footer">
                            <button type="submit" form="madicineForm" class="btn btn-primary savePharmacyMadicineBtn" id="" onclick="savePharmacyMadicine(event)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


