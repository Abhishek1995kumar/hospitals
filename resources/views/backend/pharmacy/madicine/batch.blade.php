@extends('backend.layouts.admin')
@section('content')
    <div id="">
        <a href="javascript:void(0)" class="btn btn-info mb-4" id="backPharmacyBatchMadicineList">
            {{ __('Back')}}
        </a>

        <form method="POST" enctype="matching/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold m-0">{{ __('Basic Batch Madicine Details')}} </h3>
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
                                <div class="col-md-12 mb-4 " id="medicine_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Medicine')}}</label>
                                        <select name="medicine_id" id="medicine_id" class="form-select search" data-control="select2" data-placeholder="Select medicine" >
                                            @if($medicines)
                                                @foreach($medicines as $id => $medicine)
                                                    <option value="{{ $id }}">{{ $medicine }}</option> 
                                                @endforeach
                                            @else
                                                <option value="">{{ __('Data not available')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="vendor_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Vendor')}}</label>
                                        <select name="vendor_id" id="vendor_id" class="form-select search" data-control="select2" data-placeholder="Select vendor" >
                                            @if($vendors)
                                                @foreach($vendors as $id => $vendor)
                                                    <option value="{{ $id }}">{{ $vendor }}</option> 
                                                @endforeach
                                            @else
                                                <option value="">{{ __('Data not available')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="batch_numberDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Batch Number')}}</label>
                                        <input name="batch_number" id="batch_number" class="form-control" type="text" maxlength="100" placeholder="Enter batch number" >
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
                                <div class="col-md-6 mb-4 " id="mfg_dateDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Mfg Date')}}</label>
                                        <input name="mfg_date" id="mfg_date" class="form-control datepicker" type="text" placeholder="Enter mfg date">
                                        <span id="mfgDateError" style="color: red; display: none;">{{ __('Invalid Mfg Date')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="expiry_dateDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Expiry Date')}}</label>
                                        <input name="expiry_date" id="expiry_date" class="form-control datepicker" type="text" placeholder="Enter expiry date">
                                        <span id="expiryDateError" style="color: red; display: none;">{{ __('Invalid Expiry Date')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="purchase_qtyDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Purchase Qty')}}</label>
                                        <input name="purchase_qty" id="purchase_qty" class="form-control" type="text" maxlength="10" placeholder="Enter purchase qty" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="current_qtyDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Current Qty')}}</label>
                                        <input name="current_qty" id="current_qty" class="form-control" type="text" maxlength="10" placeholder="Enter current qty" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="unit_cost_priceDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Unit Cost Price')}}</label>
                                        <input name="unit_cost_price" id="unit_cost_price" class="form-control" type="text" maxlength="10" placeholder="Enter unit cost price" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="unit_mrpDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Unit Mrp')}}</label>
                                        <input name="unit_mrp" id="unit_mrp" class="form-control" type="decimal" maxlength="10" placeholder="Enter unit mrp" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="selling_priceDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Selling Price')}}</label>
                                        <input name="selling_price" id="selling_price" class="form-control" type="text" maxlength="10" placeholder="Enter selling price" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="tax_percentageDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Tax Percentage')}}</label>
                                        <input name="tax_percentage" id="tax_percentage" class="form-control" type="decimal" maxlength="10" placeholder="Enter tax percentage" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer modal-footer">
                            <button type="submit" form="supplierForm" class="btn btn-primary savePharmacyBatchMadicineBtn" id="" onclick="savePharmacyBatchMadicine(event)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


