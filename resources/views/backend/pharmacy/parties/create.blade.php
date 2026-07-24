@extends('backend.layouts.admin')
@section('content')
    <div id="">
        <a href="javascript:void(0)" class="btn btn-info mb-4" id="backPharmacyCustomerList">
            {{ __('Back')}}
        </a>

        <form method="POST" enctype="matching/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold m-0">Basic Customer Details </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4 " id="hospital_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                        <select name="hospital_id" id="hospital_id" class="form-select search" data-control="select2" data-placeholder="Select customer" >
                                            @if($hospitals)
                                                @foreach($hospitals as $id => $hospital)
                                                    <option value="{{ $id }}">{{ $hospital }}</option> 
                                                @endforeach
                                            @else
                                                <option value="">{{ __('Data not available')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="firm_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Firm Location')}}</label>
                                        <select name="firm_id" id="firm_id" class="form-select search" data-control="select2" data-placeholder="Select firm" >
                                            @if($firms)
                                                @foreach($firms as $id => $firm)
                                                    <option value="{{ $id }}">{{ $firm }}</option> 
                                                @endforeach
                                            @else
                                                <option value="">{{ __('Data not available')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="company_nameDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Company')}}</label>
                                        <input name="company_name" id="company_name" class="form-control" type="text" maxlength="100" placeholder="Enter role name" >
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="name_idDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Name')}}</label>
                                        <input name="name" id="name" class="form-control" type="text" maxlength="100" placeholder="Enter name" >
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 " id="emailDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Email')}}</label>
                                        <input name="email" id="email" class="form-control" type="text" maxlength="100" placeholder="Enter email" oninput="validateEmail(this)" >
                                        <span id="emailError" style="color: red; display: none;">{{ __('Invalid email address (e.g. user@example.com)')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2"> {{ __('Contact')}}</label>
                                        <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter alternate mobile"  maxlength="10" oninput="validationAlternateNumber(this)" >
                                        <span id="alternateMobileError" style="color: red; display: none;">Invalid Mobile Number</span>
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
                                <div class="col-md-6 mb-4 " id="gst_noDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('GST Number')}}</label>
                                        <input name="gst_no" id="gst_no" class="form-control" oninput="validateGstNumber(this)" type="text" minlength="14" maxlength="17" placeholder="Enter gst no" >
                                        <span id="gstError" style="color: red; display: none;">{{ __('Invalid gst number (e.g. 06BZAHM6385P6Z2)')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="pan_noDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Pan Number')}}</label>
                                        <input name="pan_no" id="pan_no" class="form-control" type="text" maxlength="10" oninput="validatePanNumber(this)" placeholder="Enter pan no" >
                                        <span id="panError" style="color: red; display: none;">{{ __('Invalid pan number (e.g. ASDFG1234Q)')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="doctor_nameDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Doctor Name')}}</label>
                                        <input name="doctor_name" id="doctor_name" class="form-control" type="text" maxlength="100" placeholder="Enter doctor name" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="doctor_addressDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Doctor Address')}}</label>
                                        <input name="doctor_address" id="doctor_address" class="form-control" type="text" maxlength="200" placeholder="Enter doctor address" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="balance_typeDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Balance Type')}}</label>
                                        <select name="balance_type" id="balance_type" class="form-select search" data-control="select2" data-placeholder="Select balance type" >
                                            <option selected disabled >Select Balance Type</option>
                                            <option value="1">Credit</option>
                                            <option value="2">Debit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="party_typeDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Party Type')}}</label>
                                        <select name="party_type" id="party_type" class="form-select search" data-control="select2" data-placeholder="Select party type" >
                                            <option selected disabled >Select Party Type</option>
                                            <option value="1">Customer</option>
                                            <option value="3">Customer+Supplier</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 " id="opening_balanceDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Opening Balance')}}</label>
                                        <input name="opening_balance" id="opening_balance" class="form-control" type="text" maxlength="100" placeholder="Enter opening balance" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 " id="credit_limitDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Credit Limit')}}</label>
                                        <input name="credit_limit" id="credit_limit" class="form-control" type="decimal" maxlength="10" placeholder="Enter credit limit" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer modal-footer">
                            <button type="submit" form="supplierForm" class="btn btn-primary savePharmacyCustomerBtn" id="" onclick="savePharmacyCustomer(event)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


