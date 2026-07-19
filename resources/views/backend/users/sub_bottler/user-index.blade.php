@extends('layouts.admin')

@section('title','Sub Botler List')

@section('header')

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Sub Bottler User List</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/admin/dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Sub Bottler User List</li>
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

<!-- <div class="card">
    <div class="card-body p-0">
        <div class="card-px text-center pt-20 my-10">
            <h2 class="fs-2x fw-bold mb-10">No Request Found</h2>
            <p class="text-gray-400 fs-4 fw-semibold">Looks like you do not have any request here.
            </p>
        </div>
        <div class="text-center ">
            <img class="mw-300 mh-300px" alt="" src="/assets/media/logos/slider.jpg" />
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-3">
        <div class="alert alert-primary text-center border border-primary">
            <h5 class="alert-heading">Total Sub Botler</h5>
            <p class="mb-0" id="totalValue"></p>
        </div>
    </div>
    <div class="col-3">
        <div class="alert alert-warning text-center border border-warning">
            <h5 class="alert-heading">In Process</h5>
            <p class="mb-0" id="pendingValue"></p>
        </div>
    </div>
    <div class="col-3">
        <div class="alert alert text-center border border" style="background-color: #e8ddff; border-color: #8973b8 !important; ">
            <h5 class="alert-heading">Not Instalated</h5>
            <p class="mb-0" id="rejectedValue" ></p>
        </div>
    </div>
    <div class="col-3">
        <div class="alert alert-success text-center border border-success">
            <h5 class="alert-heading">Instalated</h5>
            <p class="mb-0" id="rejectedValue"></p>
        </div>
    </div>
</div>

<div class="card">
    <div class="d-flex flex-row" style="justify-content: space-between;">
        <div class="card-header border-0 pt-6" style="justify-content: left !important;">
            <div class="card-title">
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBotler" class="btn btn-primary" >
                    <i class="fa fa-plus"></i>Add Sub Bottler User </button> 
                    </button>
                </div>
            </div>
            <!-- <div class="card-title">
                <div class="d-flex align-items-center position-relative">
                    <button class="btn btn-success p-3"><i class="fa fa-file-excel"></i>Export</button>
                </div>
            </div> -->
            <!-- <div class="card-title">
                <div class="d-flex align-items-center position-relative">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMachineFilter"><i class="fa fa-fw fa-filter"></i>Filter</button>
                </div>
            </div> -->
            
            <div class="card-title">
                <div class="d-flex align-items-center position-relative">
                    <a href="{{ route('admin.user.sub-botler.list') }}" class="btn btn-light p-3"><i class="fa fa-fw fa-refresh"></i>Refresh</a>
                </div>
            </div>
        </div>
        <div class="card-title pt-10 mx-4">
            <div class="card-toolbar">
                <a href="{{ url('/admin/user/sub-botler/list') }}" class="btn btn-light">Back</a>
            </div>
        </div>
    </div>
        
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table">
            <thead>
                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Botler Name.</th>
                    <th class="min-w-125px">Company</th>
                    <th class="min-w-125px">Logo</th>
                    <th class="min-w-125px">Url</th>
                    <th class="min-w-125px">Color</th>
                    <th class="min-w-125px">Added On</th>
                    <th class="min-w-125px">Status</th>
                    <th class="min-w-125px">Action</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Mahindra 42.</th>
                    <th class="min-w-125px">Mahindra</th>
                    <th class="min-w-125px">Model</th>
                    <th class="min-w-125px">07 April 2025</th>
                    <th class="min-w-125px">Lucknow</th>
                    <th class="min-w-125px">Uttar Pradesh</th>
                    <th class="min-w-125px">Bottler</th>
                    <th class="min-w-125px">
                        <select name="action" class="form-select action-select" data-id="1" onchange="location = this.value;">
                            <option value="">Operation</option>
                            <option value="{{ route('admin.user.sub-botler.list', ['action' => 'botler']) }}">Edit</option>
                            <option value="{{ route('admin.user.sub-botler.list', ['action' => 'botler_user']) }}">Delette</option>
                        </select>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- Create Botler Start -->
    <div class="modal fade modal-lg" id="addBotler" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h2 class="fw-bold">Add Sub Bottler User</h2>
                    <div data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="leaderNameForm" action="{{ route('admin.user.sub-botler.save') }}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" name="application_category_id" value="8">
                                        <div class="row">
                                            <div class="col-md-4 mb-4 " id="leaderNameDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Role Name</label>
                                                    <select type="text" name="leader_name" id="leaderNameId" class="form-control" placeholder="Enter Bottler Name" >
                                                        <option value="">Select Role</option>
                                                        <option value="1">Bottler</option>
                                                        <option value="2">User</option>
                                                        <option value="3">Admin</option>
                                                        <option value="4">Manager</option>
                                                        <option value="5">Supervisor</option>
                                                        <option value="6">Operator</option>
                                                        <option value="7">Sales</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="memberCountDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Bottler</label>
                                                    <select type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name">
                                                        <option value="">Select Bottler</option>
                                                        <option value="1">Cocacola</option>
                                                        <option value="2">Bottler 2</option>
                                                        <option value="3">Bottler 3</option>
                                                        <option value="4">Bottler 4</option>
                                                        <option value="5">Bottler 5</option>
                                                        <option value="6">Bottler 6</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Sub Bottler </label>
                                                    <select type="text" name="volunteer" id="volunteerId" class="form-control" placeholder="Select Status">
                                                        <option value="">Select Sub Bottler</option>
                                                        <option value="1">Sub Bottler 1</option>
                                                        <option value="2">Sub Bottler 2</option>
                                                        <option value="3">Sub Bottler 3</option>
                                                        <option value="4">Sub Bottler 4</option>
                                                        <option value="5">Sub Bottler 5</option>
                                                        <option value="6">Sub Bottler 6</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Name</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Email</label>
                                                    <input type="email" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Password</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Confirm Password</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Contact No</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Personal No</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">User Name</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Date of birth</label>
                                                    <input type="text" name="birth_date" id="birth_date" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">About Me</label>
                                                    <input type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                                                    <select type="text" name="volunteer_contact" id="volunteerContactId" class="form-control" placeholder="Enter Company Url" >
                                                        <option value="">Select Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-footer modal-footer">
                                        <button type="submit" class="btn btn-primary" id="startMission">Add Sub Bottler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Create Botler End -->

<!-- Create Mission Start -->
    <div class="modal fade modal-lg" id="createMachineFilter" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="createMissionTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h2 class="fw-bold">Search Bottler</h2>
                    <div data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="filterBotlerDetails" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" name="application_category_id" value="8">
                                        <div class="row">
                                            <div class="col-md-6 mb-4" id="ngoCenterDiv">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Keyword</label>
                                                    <input name="keyword" id="keyword" class="form-control" placeholder="Enter keyword" type="text" maxlength="50" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer modal-footer">
                                        <button type="submit" class="btn btn-primary" id="submitFilter">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Create Mission End -->

<!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this machine?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Confirmation Modal -->

@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(document).on('change', '.action-select', function () {
        var action = $(this).val();
        var id = $(this).data('id');
        if (action === 'edit') {
            window.location.href = '/admin/master/machine/edit/' + id;
        } else if (action === 'delete') {
            $('#deleteConfirmationModal').modal('show');
            $('#confirmDelete').data('id', id);
        }
    });

    $(document).on('click', '#confirmDelete', function () {
        var id = $(this).data('id');
        // Perform delete operation here (e.g., AJAX request)
        alert('Machine with ID ' + id + ' will be deleted.');
        $('#deleteConfirmationModal').modal('hide');
    });
</script>

<script>
    var KTAppEcommerceCategories = function() {
        var n = () => {

        };
        return {
            init: function() {
                (t = document.querySelector("#kt_table")) && ((e = $(t).DataTable({
                    info: !1,
                    order: [],
                    pageLength: 10,

                })).on("draw", (function() {
                    n()
                })), document.querySelector('[data-kt-table-filter="search"]').addEventListener("keyup", (function(t) {
                    e.search(t.target.value).draw()
                })), n())
            }
        }
    }();
    KTUtil.onDOMContentLoaded((function() {
        KTAppEcommerceCategories.init()
    }));
</script>

<script>
    function machine_number_valid(num) {
        var value = num.value;
        var regex = /^[a-zA-Z0-9]*$/;
        if (!regex.test(value)) {
            num.value = value.replace(/[^a-zA-Z0-9]/g, '');
            Swal.fire({
                title: 'Alert',
                text: "Only alphanumeric characters are allowed. No spaces or special characters..",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }
    }

    $("#submitFilter").on("click", function(e) {
        e.preventDefault();
        let keyword = $("#keyword").val();

        if(keyword == '' || keyword == null) {
            Swal.fire({
                title: 'Alert',
                text: "Please enter keyword.",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return;
        }

        $("#filterBotlerDetails").submit();
    })

</script>

<script>
    $(function() {
        $('#birth_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            $('#birth_date').val(start.format('YYYY-MM-DD'));
        });
    });
</script>
@endsection
