@extends('layouts.admin')

@section('title') {{ __('Customers')}} @endsection

@section('style')
<style>
    .swal2-confirm {
        background-color: #66e089 !important;
    }
</style>
@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Customer Create')}}</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ url('/admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">
        <a href="{{ route('admin.master.botler.list') }}" class="text-muted text-hover-primary">{{ __('Customer')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">{{ __('Create')}}</li>
</ul>
@endsection

@section('content')
<!-- Alerts -->
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div class="col-sm-12">
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} </p>
        </div>
    @endif
@endforeach

@if ($errors->any())
    <div class="col-sm-12">
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
    </div>
@endif

<form id="customerForm" action="#" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="application_category_id" value="8">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="fw-bold m-0">Add Botler </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2"> Machine Name</label>
                                <input type="text" name="machine_name" id="nameDetails" class="form-control" placeholder="Enter machine name" maxlength="30" >
                            </div>
                        </div>
                        <div class="col-md-12 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2"> Machine Number</label>
                                <input type="text" name="machine_number" id="mobileDeatils" class="form-control" placeholder="Enter machine number"  maxlength="10" oninput="validationNumber(this)" >
                                <span id="mobileError" style="color: red; display: none;">Invalid Mobile Number</span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2"> Machine Model</label>
                                <input type="text" name="machine_model" id="emailDetails" class="form-control" placeholder="Enter machine model" maxlength="50" >
                            </div>
                        </div>
                        <div class="col-md-12 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2"> Email ID</label>
                                <input type="text" name="machine_email" id="emailDetails" class="form-control" placeholder="Enter machine email" maxlength="50" >
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
                            <label for="instalation_date" class="required fs-6 fw-semibold mb-2">Instalation Date </label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="instalation_date" id="instalation_date" placeholder="Enter Instalation Date" class="date form-control" >
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2">Installed Status</label>
                                <select name="installed_status" class="form-select" id="installed_status" data-control="select2" data-placeholder="Select Installed Status" >
                                    <option value=""></option>
                                    <option value="in-active">In Active</option>
                                    <option value="installed">Installed</option>
                                    <option value="not-installed">Not Installed</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2">Country Name</label>
                                <select name="country_name" class="form-select" id="country_name" data-control="select2" data-placeholder="Select Country Name" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2">State Name</label>
                                <select name="state_name" class="form-select" id="state_name" data-control="select2" data-placeholder="Select Start Name" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 ">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2">City Name</label>
                                <select name="ciy_name" class="form-select" id="ciy_name" data-control="select2" data-placeholder="Select City Name" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 " id="latitudeDiv">
                            <div class="form-group">
                                <label class="fs-6 fw-semibold mb-2" for="latitude">Latitude</label>
                                <input name="latitude" class="form-control" id="latitude"  >
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 " id="longitudeDiv">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2" for="pincode">Longitude</label>
                                <input name="longitude" class="form-control" id="longitude"  >
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 " id="cityNameDiv">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2" for="pincode">Pending For Approval</label>
                                <select name="pending_or_pproval" class="form-select" id="pending_or_pproval" data-control="select2" data-placeholder="Select City Name" >
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 " id="regionDiv">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2" for="region">Region</label>
                                <input name="region" class="form-control" id="region" >
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4 " id="regionDiv">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2" for="region">Address</label>
                                <textarea name="region" class="form-control" id="region" ></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4 " id="machineLengthDiv">
                            <div class="form-group">
                                <label class="required fs-6 fw-semibold mb-2" for="region">Machine Length</label>
                                <input name="machine_length" class="form-control" id="machine_length" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer modal-footer">
                    <button type="submit" form="customerForm" class="btn btn-primary" id="submitCustomer">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>



@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script>
    flatpickr("#instalation_date", {
        dateFormat: "Y-m-d",
        defaultDate: "today",
        minDate: "today", 
    });
    

    function animalCountValidation(elem) {
        elem.value = elem.value.replace(/\D/g, '');
        if (elem.value.length > 2 || elem.value > 10 || elem.value < 1) {
            elem.value = elem.value.slice(0, 2);
            if (elem.value > 10 || elem.value < 1) {
                elem.value = '';
            }
        }
    }
   function validationNumber(elem) {
        elem.value = elem.value.replace(/\D/g, '');
        if (elem.value.length !== 10) {
            document.getElementById("mobileError").style.display = "block";
        } else {
            document.getElementById("mobileError").style.display = "none";
        }
    }

    $("#file_input").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#file_input_div").attr("src", "").hide();
        if (file) {
            let fileName = file.name;
            let fileExtension = fileName.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                Swal.fire({
                    title: 'Invalid File Type',
                    text: "Only PNG, JPG, JPEG, and PDF files are allowed.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                $(this).val(""); // Clear input
                return;
            }

            if (file.size > maxSizeInBytes) {
                Swal.fire({
                    title: 'File Too Large',
                    text: "File size should not exceed 2MB.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                $(this).val(""); // Clear input
                return;
            }

            // Show preview only if valid
            if (['png', 'jpg', 'jpeg', 'pdf'].includes(fileExtension)) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#file_input_div").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("#application_images").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#application_images_div").attr("src", "").hide();
        if (file) {
            let fileName = file.name;
            let fileExtension = fileName.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                Swal.fire({
                    title: 'Invalid File Type',
                    text: "Only PNG, JPG, JPEG, and PDF files are allowed.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                $(this).val(""); // Clear input
                return;
            }

            if (file.size > maxSizeInBytes) {
                Swal.fire({
                    title: 'File Too Large',
                    text: "File size should not exceed 2MB.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                $(this).val(""); // Clear input
                return;
            }

            // Show preview only if valid
            if (['png', 'jpg', 'jpeg', 'pdf'].includes(fileExtension)) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#application_images_div").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });


    $(document).ready(function() {
        // select dog or cat than $("#requestTypeId") issme value aayegi
        $("#animalTypeId").on("change", function() {
            let animalTypeData = $(this).val();
            let requestTypeDropdown = $("#requestTypeId");
            requestTypeDropdown.html('<option value=""></option>'); // Reset dropdown
            let requestOptions = [];
            if (animalTypeData == 1) {
                requestOptions = [{
                        id: 15,
                        name: "Dog Vaccination"
                    },
                    {
                        id: 16,
                        name: "Dog Sterlization"
                    }
                ];
            } else {
                requestOptions = [{
                        id: 17,
                        name: "Cat Sterlization"
                    },
                    {
                        id: 18,
                        name: "Cat Vaccination"
                    }
                ];
            }
            // Insert options dynamically
            requestOptions.forEach(function(option) {
                requestTypeDropdown.append(`<option value="${option.id}">${option.name}</option>`);
            });

        });

        $("#requestTypeId").change(function() {
            let showHidedDiv = $(this).val();
            let  animalTypeId = $("#animalTypeId").val();
            if (showHidedDiv == 11) {
                $("#otherCatReasonDiv").hide();
                $("#otherDogReasonDiv").show();

            } else if (showHidedDiv == 14) {
                $("#otherCatReasonDiv").show();
                $("#otherDogReasonDiv").hide();

            } else{
                $("#otherCatReasonDiv").hide();
                $("#otherDogReasonDiv").hide();
            }
        })

        $("#location").on('change', function() {
            let locationId = $(this).val();
            if (locationId) {
                $.ajax({
                    url: "/admin/get-location/" + locationId,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#pincode').val(response.pincode); // Corrected
                            $('#wardName').val(response.ward_name); // Corrected
                            $('#cityName').val(response.city_name); // Corrected
                            $('#dlesName').val(response.dles_name); // Corrected
                            $('#pincodeDiv').show();
                            $('#wardNameDiv').show();
                            $('#cityNameDiv').show();
                            $('#dlesNameDiv').show();
                        }
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseText);
                    }
                });
            }
        });
    })

    // Form validation and submission
    $("#submitGrievanceDetailsFromAdmin").on("click", function(e) {
        e.preventDefault();
        let form = $("#customerForm")[0];
        let nameDetails = $("#nameDetails").val();
        let mobileDeatils = $("#mobileDeatils").val();
        let emailDetails = $("#emailDetails").val();
        let addressDetails = $("#addressDetails").val();
        let animalTypeId = $("#animalTypeId").val();
        let requestTypeId = $("#requestTypeId").val();
        let animalCount = $("#animalCount").val();          
        let requestSource = $("#requestSource").val();          
        let location = $("#location").val();
        let description = $("#description").val();
        let application_images = $("#application_images").val();
        let namePattern = /^[a-zA-Z\s]{2,30}$/;
        let mobilePattern = /^[0-9]{10}$/;
        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (nameDetails === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter name",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if(namePattern.test(nameDetails) == false) {
            Swal.fire({
                title: 'Data not found',
                text: "Please enter a valid full name.",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return false;
        }

        if (mobileDeatils === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter mobile number",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if(mobilePattern.test(mobileDeatils) == false) {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter a valid mobile number",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }

        if (emailDetails === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter email address",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (emailDetails.includes("..") || emailDetails.includes("...")) {
            Swal.fire({
            title: 'Invalid Email',
            text: "Email address cannot contain consecutive dots (e.g., '..' or '...').",
            icon: 'error',
            confirmButtonText: 'Ok'
            });
            return false;
        }
        if(emailPattern.test(emailDetails) == false) {
            Swal.fire({
                title: 'Data not found',
                text: "Please enter a valid email address (eg abc@gmail.com).",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return false;
        }
        if (addressDetails === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter address details",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (animalTypeId === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter animal type",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (requestTypeId === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter request type",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (animalCount == "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter animal count",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (requestSource === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please select request source",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (location === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter location",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (description === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter description",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        if (application_images === "") {
            Swal.fire({
                title: 'Validation Error',
                text: "Please enter application images",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }
        form.submit();
    })
</script>
@endsection