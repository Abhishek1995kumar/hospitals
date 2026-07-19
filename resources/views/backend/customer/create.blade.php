@extends('backend.layouts.admin')
@section('content')
    <div id="">
        <a href="javascript:void(0)" class="btn btn-info mb-4" id="backCustomerList">
            {{ __('Back')}}
        </a>
        <form method="POST" enctype="matching/form-data">
            <input type="hidden" name="application_category_id" value="8">
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
                                <div class="col-md-12 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Name')}}</label>
                                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter customer name" maxlength="200" >
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2"> {{ __('Contact')}}</label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter contact number"  maxlength="10" oninput="validationNumber(this)"  >
                                        <span id="mobileError" style="color: red; display: none;">Invalid Mobile Number</span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2"> {{ __('Alternate Contact')}}</label>
                                        <input type="text" name="alternate_mobile" id="alternate_mobile" class="form-control" placeholder="Enter alternate mobile"  maxlength="10" oninput="validationAlternateNumber(this)" >
                                        <span id="alternateMobileError" style="color: red; display: none;">Invalid Alternate Mobile Number</span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2"> {{ __('Email ID')}}</label>
                                        <input type="text" name="email" id="emailDetails" class="form-control" placeholder="Enter machine email" maxlength="200" >
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2"> {{ __('Customer Website')}}</label>
                                        <input type="url" name="website" id="website" class="form-control" placeholder="https://example.com"  maxlength="100" oninput="validationWebsite(this)" >
                                        <span id="websiteError" style="color: red; display: none;">{{ __('Invalid Website (e.g. https://example.com)')}}</span>
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
                                <div class="col-md-6 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{('Current Plan')}}</label>
                                        <select name="plan_name" class="form-select" id="plan_name" data-control="select2" data-placeholder="Select current plan" >
                                            <option value=""></option>
                                            <option value="1">Trial</option>
                                            <option value="2">Starter</option>
                                            <option value="3">Professional</option>
                                            <option value="4">Enterprise</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('IS Hospital/Clinic')}}</label>
                                        <select name="is_hospital_clinic" class="form-select" id="is_hospital_clinic" data-control="select2" data-placeholder="Select is trial" >
                                            <option selected disabled ></option>
                                            <option value="1">Hospital</option>
                                            <option value="2">Clinic</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">Country Name</label>
                                        <select name="country" class="form-select" id="country_name">
                                            <option selected disabled>{{ __('Select Country Name')}}</option>
                                            @foreach($countries as $name => $id)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">State Name</label>
                                        <select name="state" class="form-select" id="state_name" data-control="select2" data-placeholder="Select State Name">
                                            <option selected disabled >{{ __('Select State Name')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4 ">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2">City Name</label>
                                        <select name="city" class="form-select" id="city_name" data-control="select2" data-placeholder="Select City Name" >
                                            <option selected disabled >{{ __('Select City Name')}}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-4 " id="addressDiv">
                                    <div class="form-group">
                                        <label class="required fs-6 fw-semibold mb-2" for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer modal-footer">
                            <button type="submit" form="customerForm" class="btn btn-primary saveCustomerBtn" id="" onclick="saveCustomer(event)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


