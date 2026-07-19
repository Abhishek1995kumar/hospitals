@extends('layouts.admin')

@section('title','Botler Details')

@section('header')
<style>
    .swal2-confirm {
        background-color: #66e089 !important;
    }
    .buttons-excel {
        margin-top:-5rem !important; 
        margin-left:80rem !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        height: 42px;
    }
</style>

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Botler Detaits</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/admin/dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/admin/user/botler/list')}}" class="text-muted text-hover-primary">Botler Detaits</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Botler List</li>
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
    <div class="row">
        <div class="col-3">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">Botler Name</h5>
                <p class="mb-0" id="completeValue">{{ $botlerDetail->bottler_name }}</p>
            </div>
        </div>
        <div class="col-3">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">Company Name</h5>
                <p class="mb-0" id="completeValue">{{ $botlerDetail->company_name }}</p>
            </div>
        </div>
        <div class="col-2">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">Company URL</h5>
                <p class="mb-0" id="">{{ $botlerDetail->company_url }}</p>
            </div>
        </div>
        <div class="col-2">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">Added On</h5>
                <p class="mb-0" id="totalCatVaccinated">{{ \Carbon\Carbon::parse($botlerDetail->created_at)->format('F d Y') }}</p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header border-0 pt-6">
            <ul class="nav nav-tabs ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-bs-toggle="tab">Sub Botler</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-bs-toggle="tab">Sub Botler User</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-bs-toggle="tab">Assign Machine To Botler</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#tab_4" data-bs-toggle="tab">Assign Machine To Sub Botler</a></li> -->
                <li class="nav-item"><a class="nav-link" href="#tab_5" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_6" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_7" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_8" data-bs-toggle="tab"></a></li>
            </ul>
        </div>
        <div class="card-body create-role-btn">
            <div class="tab-content">
                <!-- Sub Botler -->
                <div class="tab-pane active" id="tab_1">
                    <div class="card-toolbar">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="sub_botler_table">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubBotler">
                                <i class="fa fa-plus"></i> Add Sub Bottler
                            </button>
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Botler Name.</th>
                                    <th class="min-w-125px">Company Name</th>
                                    <th class="min-w-125px">Company Logo</th>
                                    <th class="min-w-125px">Company Url</th>
                                    <th class="min-w-125px">Color</th>
                                    <th class="min-w-125px">Added On</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-125px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php $parent=1; ?>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Rukmani Consultant</th>
                                    <th class="min-w-125px">Rukmani</th>
                                    <th class="min-w-125px">Model</th>
                                    <th class="min-w-125px">20 June 2025</th>
                                    <th class="min-w-125px">Lucknow</th>
                                    <th class="min-w-125px">Uttar Pradesh</th>
                                    <th class="min-w-125px">Sub Bottler</th>
                                    <th class="min-w-125px">
                                        <select name="action" class="form-select action-select"  data-id="{{ $parent }}" onchange="handleSubBotlerAction(this)">
                                            <option value="">Operation</option>
                                            <option value="edit" data-id="{{ $parent }}">Edit</option>
                                            <option value="delete" data-id="{{ $parent }}">Delete</option>
                                        </select>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Sub Botler User -->
                <div class="tab-pane" id="tab_2">
                    <div class="card-toolbar">
                        <div class="card-title">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserBotler" class="btn btn-primary" >
                            <i class="fa fa-plus"></i>Add Sub Bottler User </button>
                            </button>
                        </div>
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="user_botler_table">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Sub Botler Name.</th>
                                    <th class="min-w-125px">Company Name</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Added On</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-125px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <?php $userParentId = 1; ?>
                                    <th class="min-w-125px">Coca Cola</th>
                                    <th class="min-w-125px">CocaCola India</th>
                                    <th class="min-w-125px">Model</th>
                                    <th class="min-w-125px">21 June 2025</th>
                                    <th class="min-w-125px">Active</th>
                                    <th class="min-w-125px">
                                        <select name="action" class="form-select action-select" data-id="{{ $userParentId }}" onchange="handleSubBotlerUserAction(this)">
                                            <option value="">Operation</option>
                                            <option value="user_edit" data-id="{{ $userParentId }}">Edit</option>
                                            <option value="user_delete" data-id="{{ $userParentId }}">Delette</option>
                                        </select>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Assign Machine to Bottler -->
                <div class="tab-pane" id="tab_3">
                    <div class="card-toolbar">
                        <div class="card-title">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assign_machine_botler" class="btn btn-primary" >
                                <i class="fa fa-plus"></i>Assign Machine to Bottler</button>
                            </button>
                        </div>
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="assign_machine_botler_table">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Sub Botler Name.</th>
                                    <th class="min-w-125px">Location</th>
                                    <th class="min-w-125px">Machine Number</th>
                                    <th class="min-w-125px">City</th>
                                    <th class="min-w-125px">State</th>
                                    <th class="min-w-125px">Installed</th>
                                    <th class="min-w-125px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Aryan</th>
                                    <th class="min-w-125px">Mahindra</th>
                                    <th class="min-w-125px">Model</th>
                                    <th class="min-w-125px">07 April 2025</th>
                                    <th class="min-w-125px">Lucknow</th>
                                    <th class="min-w-125px">Uttar Pradesh</th>
                                    <th class="min-w-125px">
                                        <?php $assignParentId = 1; ?>
                                        <select name="action" class="form-select action-select" data-id="1" onchange="handleAssignMachineAction(this)">
                                            <option value="">Operation</option>
                                            <option value="edit_assign_machine" data-id="{{ $assignParentId }}">Edit</option>
                                            <option value="view_assign_machine" data-id="{{ $assignParentId }}">Transactions</option>
                                            <option value="delete_assign_machine" data-id="{{ $assignParentId }}">Delete</option>
                                        </select>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Sub Botler Management Start -->
    <!-- Create Sub Botler Start -->
        <div class="modal fade modal-lg" id="addSubBotler" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Sub Bottler</h2>
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
                        <form id="subBotlerForm" action="{{ route('admin.user.sub-botler.save') }}" method="POST" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-6 " id="bottler_name_in_sub_bottler_create_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Bottler Name</label>
                                                        <select type="text" name="bottler_name" id="bottler_name_in_sub_bottler_create" class="form-select" placeholder="Enter Bottler Name">
                                                            <option value=""></option>
                                                            <option value="Mahindra">Mahindra</option>
                                                            <option value="Tata">Tata</option>
                                                            <option value="Coca">Coca</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-6 " id="sub_botler_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Sub Bottler Name</label>
                                                        <input type="text" name="sub_botler_name" id="sub_bottler_name" class="form-control" placeholder="Enter Sub Botler Name" maxlength="50" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-6 " id="company_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Company Name</label>
                                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" maxlength="100" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-6 " id="company_url_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Company Url</label>
                                                        <input type="text" name="company_url" id="company_url" class="form-control" placeholder="Enter Company Url" disabled>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 mb-6 " id="color_picker_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Choose Color</label>
                                                        <input type="color" name="color" id="color_picker" class="form-control" style="height: 3.3rem !important;">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-6 " id="status_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                                                        <select type="color" name="status" id="status" class="form-select" style="height: 3.3rem !important;">
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 " id="company_logo_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Company Logo (.png)</label>
                                                        <input type="file" name="company_logo" id="company_logo" class="form-control" accept=".png, .jpg, .jpeg, .pdf" >
                                                        <span class="text-muted">Support only png/jpg/jpeg/pdf file and file size less than 2 mb</span>
                                                        <div class="previewContainer" id="companyLogoProof"></div>
                                                        <div class="invalid-feedback d-none">Upload Photo Second required</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary" id="subBotlerSubmit">Add Sub Bottler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Create Sub Botler End -->

    <!-- Edit Sub Botler Start -->
        <div class="modal fade modal-lg" id="editSubBotler" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Sub Bottler</h2>
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
                        <form id="subBotlerForm" action="{{ route('admin.user.sub-botler.save') }}" method="POST" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="application_category_id" value="8">
                                            <div class="row">
                                                <div class="col-md-4 mb-6 " id="leaderNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Bottler Name</label>
                                                        <select type="text" name="leader_name" id="leaderNameId" class="form-control" placeholder="Enter Bottler Name" maxlength="30" >
                                                            <option value="">Mahindra</option>
                                                            <option value="">Tata</option>
                                                            <option value="">Coca</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-6 " id="sub_botler_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Sub Bottler Name</label>
                                                        <input type="text" name="sub_botler_name" id="sub_botler_name" class="form-control" placeholder="Enter Sub Botler Name" maxlength="50" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-6 " id="company_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Company Name</label>
                                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" maxlength="200" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-6 " id="company_url_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Company Url</label>
                                                        <input type="text" name="company_url" id="company_url" class="form-control" placeholder="Enter Company Url" minlength="1" maxlength="100"  >
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 mb-6 " id="volunteerContactDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Choose Color</label>
                                                        <input type="color" name="color" id="colorPicker" class="form-control" style="height: 3.3rem !important;">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-6 " id="volunteerContactDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                                                        <select type="color" name="status" id="status" class="form-control" style="height: 3.3rem !important;">
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 " id="volunteerContactDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Company Logo (.png)</label>
                                                        <input type="file" name="application_images" id="application_images" class="form-control" accept=".png, .jpg, .jpeg, .pdf" >
                                                        <span class="text-muted">Support only png/jpg/jpeg/pdf file and file size less than 2 mb</span>
                                                        <div class="invalid-feedback d-none">Upload Photo Second required</div>
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
    <!-- Edit Sub Botler End -->

    <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="sub_botler_delete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
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
                        <button type="button" class="btn btn-danger" id="confirm_sub_botler_delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Delete Confirmation Modal -->

    <!-- Filter Start -->
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
    <!-- Filter End -->
<!-- Sub Botler Management End -->


<!-- Sub Botler User Management Start -->
    <!-- Create Botler Start -->
        <div class="modal fade modal-lg" id="createUserBotler" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
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
                        <form id="createSubUserForm" action="{{ route('admin.user.sub-botler.save') }}" method="POST" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="application_category_id" value="8">
                                            <div class="row">
                                                <div class="col-md-4 mb-4 " id="role_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Role Name</label>
                                                        <select type="text" name="role_name" id="role_name" class="form-select" placeholder="Enter Role Name" >
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

                                                <div class="col-md-4 mb-4 " id="bottler_name_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Bottler</label>
                                                        <select type="text" name="bottler_name" id="bottler_name_user" class="form-select" placeholder="Enter Company Name">
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

                                                <div class="col-md-4 mb-4 " id="sub_bottler_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Sub Bottler </label>
                                                        <select type="text" name="sub_bottler" id="sub_bottler_user" class="form-select" placeholder="Select Status">
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

                                                <div class="col-md-4 mb-4 " id="name_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                                                        <input type="text" name="name" id="name_user" class="form-control" placeholder="Enter Name" minlength="1" maxlength="50"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="email_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                                                        <input type="email" name="email" id="email_user" class="form-control" placeholder="Enter Email" minlength="1" maxlength="100"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="password_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Password</label>
                                                        <input type="text" name="password" id="password_user" class="form-control" placeholder="Enter Password" minlength="1" maxlength="30"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="confirm_password_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Confirm Password</label>
                                                        <input type="text" name="confirm_password" id="confirm_password_user" class="form-control" placeholder="Enter Confirm Password" minlength="1" maxlength="30"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="contact_number_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Contact No</label>
                                                        <input type="text" name="contact_number" id="contact_number_user" class="form-control" placeholder="Enter Contact Number" oninput="machine_number_valid(this)"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="personal_contact_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Personal No</label>
                                                        <input type="text" name="personal_contact" id="personal_contact_user" class="form-control" placeholder="Enter Personal Number" oninput="personal_number_valid(this)"  >
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 mb-4 " id="birth_date_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Date of birth</label>
                                                        <input type="text" name="birth_date" id="birth_date_user" class="form-control" placeholder="Enter Date of birth" minlength="1" maxlength="100"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="about_me_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">About Me</label>
                                                        <textarea type="text" name="about_me" id="about_me_user" class="form-control" placeholder="Enter About Me" minlength="1" maxlength="100" rows="3" col="2" ></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="status_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                                                        <select type="text" name="status" id="status_user" class="form-select" placeholder="Enter Company Url" >
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary" id="create_sub_bottler_user_submit">Add Sub Bottler</button>
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

    <!-- Update Botler Start -->
        <div class="modal fade modal-lg" id="sub_bottler_user_edit_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Sub Bottler User</h2>
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
                                                <div class="col-md-4 mb-4 " id="role_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Role Name</label>
                                                        <select type="text" name="role_name" id="role_name_edit" class="form-select" placeholder="Enter Role Name" >
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

                                                <div class="col-md-4 mb-4 " id="bottler_name_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Bottler</label>
                                                        <select type="text" name="bottler_name" id="bottler_name_user_edit" class="form-select" placeholder="Enter Company Name">
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

                                                <div class="col-md-4 mb-4 " id="sub_bottler_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Sub Bottler </label>
                                                        <select type="text" name="sub_bottler" id="sub_bottler_user_edit" class="form-select" placeholder="Select Status">
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

                                                <div class="col-md-4 mb-4 " id="name_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                                                        <input type="text" name="name" id="name_user_edit" class="form-control" placeholder="Enter Name" minlength="1" maxlength="50"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="email_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                                                        <input type="email" name="email" id="email_user_edit" class="form-control" placeholder="Enter Email" minlength="1" maxlength="100"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="password_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Password</label>
                                                        <input type="text" name="password" id="password_user_edit" class="form-control" placeholder="Enter Password" minlength="1" maxlength="30"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="confirm_password_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Confirm Password</label>
                                                        <input type="text" name="confirm_password" id="confirm_password_user_edit" class="form-control" placeholder="Enter Confirm Password" minlength="1" maxlength="30"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="contact_number_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Contact No</label>
                                                        <input type="text" name="contact_number" id="contact_number_user_edit" class="form-control" placeholder="Enter Contact Number" oninput="machine_number_valid(this)"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="personal_contact_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Personal No</label>
                                                        <input type="text" name="personal_contact" id="personal_contact_user_edit" class="form-control" placeholder="Enter Personal Number" oninput="personal_number_valid(this)"  >
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 mb-4 " id="birth_date_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Date of birth</label>
                                                        <input type="text" name="birth_date" id="birth_date_user" class="form-control" placeholder="Enter Date of birth" minlength="1" maxlength="100"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="about_me_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">About Me</label>
                                                        <textarea type="text" name="about_me" id="about_me_user_edit" class="form-control" placeholder="Enter About Me" minlength="1" maxlength="100" rows="3" col="2" ></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " id="status_user_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                                                        <select type="text" name="status" id="status_user_edit" class="form-select" placeholder="Enter Company Url" >
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary" id="create_sub_bottler_user_submit">Edit Sub Bottler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Update Botler End -->

    <!-- Filter Start -->
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
    <!-- Filter End -->

    <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="sub_bottler_user_delete_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="sub_bottler_user_delete_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sub_bottler_user_delete_modal_label">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete Sub Botler User?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm_sub_bottler_user_delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Delete Confirmation Modal -->
<!-- Sub Botler User Management End -->


<!-- Assign Machine to Botler -->
    <!-- Create Botler Start -->
        <div class="modal fade modal-lg" id="assign_machine_botler" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Sub Bottler</h2>
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
                        <form id="assignMachineForm" action="{{ route('admin.user.sub-botler.save') }}" method="POST" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-4 " id="bottler_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Bottler Name</label>
                                                        <select type="text" name="bottler_name" id="assign_bottler_name" class="form-select" placeholder="Enter Bottler Name">
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

                                                <div class="col-md-4 mb-4 " id="sub_bottler_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Sub Bottler</label>
                                                        <select type="text" name="sub_bottler_name" id="assign_sub_bottler_name" class="form-select" placeholder="Enter Company Name">
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

                                                <div class="col-md-4 mb-4 " id="machine_number_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Machine Number </label>
                                                        <select type="text" name="machine_number" id="assign_machine_number" class="form-select" placeholder="Select Status">
                                                            <option value="">Select Machine Number</option>
                                                            <option value="1">Machine Number 1</option>
                                                            <option value="2">Machine Number 2</option>
                                                            <option value="3">Machine Number 3</option>
                                                            <option value="4">Machine Number 4</option>
                                                            <option value="5">Machine Number 5</option>
                                                            <option value="6">Machine Number 6</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary" id="createAssigneMachine">Add Sub Bottler</button>
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

    <!-- Update Botler Start -->
        <div class="modal fade modal-lg" id="assign_machine_botler_update" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Assign Machine To Bottler</h2>
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
                        <form id="editAssignMachineForm" action="{{ route('admin.user.sub-botler.save') }}" method="POST" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-4 " id="bottler_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Bottler Name</label>
                                                        <select type="text" name="bottler_name" id="assign_bottler_name_edit" class="form-select" placeholder="Enter Bottler Name">
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

                                                <div class="col-md-4 mb-4 " id="sub_bottler_name_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Sub Bottler</label>
                                                        <select type="text" name="sub_bottler_name" id="assign_sub_bottler_name_edit" class="form-select" placeholder="Enter Company Name">
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

                                                <div class="col-md-4 mb-4 " id="machine_number_div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">Machine Number </label>
                                                        <select type="text" name="machine_number" id="assign_machine_number_edit" class="form-select" placeholder="Select Status">
                                                            <option value="">Select Machine Number</option>
                                                            <option value="1">Machine Number 1</option>
                                                            <option value="2">Machine Number 2</option>
                                                            <option value="3">Machine Number 3</option>
                                                            <option value="4">Machine Number 4</option>
                                                            <option value="5">Machine Number 5</option>
                                                            <option value="6">Machine Number 6</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary" id="editAssigneMachine">Edit Sub Bottler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Update Botler End -->

    <!-- List Botler Start -->
        <div class="modal fade modal-lg" id="assign_machine_botler_view" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addBotlerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">Transactions </h2>
                        <div data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="assign_machine_botler_view_table">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">SR No.</th>
                                    <th class="min-w-125px">Mobile Numbe</th>
                                    <th class="min-w-125px">Coupon</th>
                                    <th class="min-w-125px">Number of bottles</th>
                                    <th class="min-w-125px">Barcode</th>
                                    <th class="min-w-125px">Date and Time</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">1</th>
                                    <th class="min-w-125px">9999999999</th>
                                    <th class="min-w-125px">LS7628</th>
                                    <th class="min-w-125px">64</th>
                                    <th class="min-w-125px"></th>
                                    <th class="min-w-125px">2022-01-31 00:00:00</th>
                                </tr>
                            </tbody>
                            <tfoot class="thead1">
                               
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- List Botler End -->

    <!-- Filter Start -->
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
    <!-- Filter End -->

    <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="delete_assign_machine_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="delete_assign_machine_modal_lebel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete_assign_machine_modal_label">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete assign machine?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm_delete_assign_machine">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Delete Confirmation Modal -->
<!-- Assign Machine to Botler -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure tabs work without changing the base URL
        const tabs = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('href');
                const tabContent = document.querySelector(target);
                if (tabContent) {
                    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                    tabContent.classList.add('active');
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    });

    $(document).ready(function() {
        // role searching
        let table1 = $('#sub_botler_table').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": false,
            // "scrollX": true,
            "scrollCollapse": true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });

        $('#sub_botler_table .thead1 input').on('keyup change clear', function() {
            let index = $(this).parent().index();
            table1.column(index).search(this.value).draw();
        });

        // permission searching
        let table2 = $('#user_botler_table').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": false,
            // "scrollX": true,
            "scrollCollapse": true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });

        $('#user_botler_table .thead1 input').on('keyup change clear', function() {
            let index = $(this).parent().index();
            table2.column(index).search(this.value).draw();
        });

        // breeder searching
        let table3 = $('#assign_machine_botler_table').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": false,
            // "scrollX": true,
            "scrollCollapse": true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });

        $('#assign_machine_botler_table .thead1 input').on('keyup change clear', function() {
            let index = $(this).parent().index();
            table3.column(index).search(this.value).draw();
        });

        // pet shop searching
        let table4 = $('#routePermissionTable').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": false,
            // "scrollX": true,
            "scrollCollapse": true,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print']
        });

        $('#routePermissionTable .thead1 input').on('keyup change clear', function() {
            let index = $(this).parent().index();
            table4.column(index).search(this.value).draw();
        });


        // pet shop searching
        let table5 = $('#assign_machine_botler_view_table').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": false,
            // "scrollX": true,
            "scrollCollapse": true,
            dom: 'Bfrtip',
            buttons: []
        });

        $('#assign_machine_botler_view_table .thead1 input').on('keyup change clear', function() {
            let index = $(this).parent().index();
            table5.column(index).search(this.value).draw();
        });

    });
</script>


<!-- Sub Botler Script -->
<script>
    $("#company_logo").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#companyLogoProof").attr("src", "").hide();
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
                    text: "Company logo size should not exceed 2MB.",
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
                    $("#companyLogoProof").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });

    function previewFiles(inputId, previewContainerId) {
        let fileInput = document.getElementById(inputId);
        let previewContainer = document.getElementById(previewContainerId);

        fileInput.addEventListener("change", function(event) {
            previewContainer.innerHTML = "";

            let files = event.target.files;
            if (files.length > 0) {
                Array.from(files).forEach((file, index) => {
                    let previewWrapper = document.createElement("div");
                    previewWrapper.style.display = "inline-block";
                    previewWrapper.style.position = "relative";
                    previewWrapper.style.margin = "5px";

                    let removeBtn = document.createElement("button");
                    removeBtn.innerHTML = "&#10006;";
                    removeBtn.style.position = "absolute";
                    removeBtn.style.top = "5px";
                    removeBtn.style.right = "5px";
                    removeBtn.style.background = "red";
                    removeBtn.style.color = "white";
                    removeBtn.style.border = "none";
                    removeBtn.style.borderRadius = "50%";
                    removeBtn.style.width = "20px";
                    removeBtn.style.height = "20px";
                    removeBtn.style.cursor = "pointer";
                    removeBtn.style.display = "flex";
                    removeBtn.style.justifyContent = "center";
                    removeBtn.style.alignItems = "center";

                    removeBtn.addEventListener("click", function() {
                        previewWrapper.remove();
                        if (previewContainer.children.length === 0) {
                            fileInput.value = "";
                        }
                    });

                    if (file.type.startsWith("image/")) {
                        let fileReader = new FileReader();
                        fileReader.onload = function(e) {
                            let img = document.createElement("img");
                            img.src = e.target.result;
                            img.style.width = "100px";
                            img.style.border = "1px solid #ccc";
                            previewWrapper.appendChild(img);
                            previewWrapper.appendChild(removeBtn);
                            previewContainer.appendChild(previewWrapper);
                        };
                        fileReader.readAsDataURL(file);
                    } else if (file.type === "application/pdf") {
                        let fileURL = URL.createObjectURL(file);
                        let link = document.createElement("a");
                        link.href = fileURL;
                        link.target = "_blank";
                        link.style.display = "block";

                        let imgPath = document.createElement("img");
                        imgPath.src = "https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"; // PDF icon
                        imgPath.style.width = "100px";
                        imgPath.style.height = "100px";
                        imgPath.style.display = "block";

                        link.appendChild(imgPath);
                        previewWrapper.appendChild(link);
                        previewWrapper.appendChild(removeBtn);
                        previewContainer.appendChild(previewWrapper);
                    }
                });
            }
        });
    }
    previewFiles("company_logo", "companyLogoProof");

    function handleSubBotlerAction(selectElement) {
        var action = selectElement.value;
        var id = selectElement.getAttribute('data-id');
        if (action === 'edit') {
            $('#editSubBotler').modal('show');
            // Pass the ID to the modal or perform any action
        } else if (action === 'delete') {
            $('#sub_botler_delete').modal('show');
            $('#confirm_sub_botler_delete').data('id', id);
        }
    }

    document.getElementById('company_name').addEventListener('input', function() {
        document.getElementById('company_url').value = (this.value).toLowerCase().replace(/\s+/g, '-');
    });

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

    $('#subBotlerSubmit').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let bottler_name_in_sub_bottler_create = $('#bottler_name_in_sub_bottler_create').val();
        let sub_bottler_name_sub = $('#sub_bottler_name').val();
        let company_name_sub = $('#company_name').val();
        let color_picker_sub = $('#color_picker').val();
        let status_sub = $('#status').val();
        let company_logo_sub = $('#company_logo').val();
        let flag = false;

        function checkEmptyField(field, fieldName) {
            if (field === '') {
                flag = true;
                Swal.fire({
                    title: 'Alert',
                    text: fieldName + " is required.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        }

        checkEmptyField(bottler_name_in_sub_bottler_create, 'Bottler Name');
        checkEmptyField(sub_bottler_name_sub, 'Sub Bottler Name');
        checkEmptyField(company_name_sub, 'Company Name');
        checkEmptyField(color_picker_sub, 'Color Picker');
        checkEmptyField(status_sub, 'Status');
        checkEmptyField(company_logo_sub, 'Company Logo');

        if (flag) {
            return false;
        }

        $("#subBotlerForm").submit();
    });
</script>
<!-- Sub Botler Script -->



<!-- Sub Botler User Script -->
<script>
    function handleSubBotlerUserAction(selectElement) {
        var action = selectElement.value;
        var id = selectElement.getAttribute('data-id');
        if (action === 'user_edit') {
            $('#sub_bottler_user_edit_modal').modal('show');
        } else if (action === 'user_delete') {
            $('#sub_bottler_user_delete_modal').modal('show');
            $('#confirm_sub_bottler_user_delete').data('id', id);
        }
    }

    function machine_number_valid(num) {
        var value = num.value;
        var regex = /^[0-9]*$/;
        if (!regex.test(value)) {
            num.value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        }
        if (num.value.length > 10) {
            num.value = num.value.slice(0, 10); // Limit to 10 digits
        }
    }

    function personal_number_valid(num) {
        var value = num.value;
        var regex = /^[0-9]*$/;
        if (!regex.test(value)) {
            num.value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        }
        if (num.value.length > 10) {
            num.value = num.value.slice(0, 10); // Limit to 10 digits
        }
    }

    flatpickr("#birth_date_user", {
        // enableTime: true,
        // dateFormat: "Y-m-d H:i",
        // time_24hr: true,
        maxDate: "today",
    });

    $('#create_sub_bottler_user_submit').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let role_name = $('#role_name').val();
        let bottler_name_user = $('#bottler_name_user').val();
        let sub_bottler_user = $('#sub_bottler_user').val();
        let name_user = $('#name_user').val();
        let email_user = $('#email_user').val();
        let password_user = $('#password_user').val();
        let confirm_password_user = $('#confirm_password_user').val();
        let contact_number_user = $('#contact_number_user').val();
        let personal_contact_user = $('#personal_contact_user').val();
        let birth_date_user = $('#birth_date_user').val();
        let about_me_user = $('#about_me_user').val();
        let status_user = $('#status_user').val();

        let namePattern = /^[a-zA-Z\s]{2,30}$/;
        let mobilePattern = /^[0-9]{10}$/;
        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/; // At least 5 characters, at least one letter and one number

        let flag = false;

        function checkEmptyField(field, fieldName) {
            if (field === '') {
                flag = true;
                Swal.fire({
                    title: 'Alert',
                    text: fieldName + " is required.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        }

        function checkPattern(field, pattern, fieldName, errorMessage) {
            if (!pattern.test(field)) {
                flag = true;
                Swal.fire({
                    title: 'Alert',
                    text: fieldName + " " + errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        }

        checkEmptyField(birth_date_user, 'Birth Date');

        checkEmptyField(personal_contact_user, 'Personal Contact Number');
        if (!flag) {
            checkPattern(personal_contact_user, mobilePattern, 'Personal Contact Number', 'must be a valid 10-digit number.');
        }

        checkEmptyField(contact_number_user, 'Contact Number');
        if(!flag) {
            checkPattern(contact_number_user, mobilePattern, 'Contact Number', 'must be a valid 10-digit number.');
        }

        checkEmptyField(confirm_password_user, 'Confirmed Password');
        if (password_user !== confirm_password_user) {
            flag = true;
            Swal.fire({
                title: 'Alert',
                text: "Password and Confirm Password do not match.",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }

        checkEmptyField(password_user, 'Password');
        if(!flag) {
            checkPattern(password_user, passwordPattern, 'Password', 'must be at least 5 characters long and contain at least one letter and one number.');
        }

        checkEmptyField(email_user, 'Email');
        if(!flag) {
            checkPattern(email_user, emailPattern, 'Email', 'is not valid.');
        }

        checkEmptyField(name_user, 'Name');
        if(!flag) {
            checkPattern(name_user, namePattern, 'Name', 'should only contain letters and spaces (2-30 characters).');
        }
        checkEmptyField(sub_bottler_user, 'Sub Bottler Name');
        checkEmptyField(bottler_name_user, 'Bottler Name');
        checkEmptyField(role_name, 'Role Name');

        if (!flag) {
            $("#createSubUserForm").submit();
        }
    });
</script>
<!-- Sub Botler User Script -->



<!-- Assign Machine To Bottler Start -->
<script>
    function handleAssignMachineAction(selectedElement) {
        let action = selectedElement.value;
        let id = selectedElement.getAttribute('data-id');
        if(action === 'edit_assign_machine') {
            $('#assign_machine_botler_update').modal('show');
            
        } else if (action === 'view_assign_machine') {
            $('#assign_machine_botler_view').modal('show');

        } else if (action === 'delete_assign_machine') {
            $('#delete_assign_machine_modal').modal('show');
            $('#confirm_delete_assign_machine').data('id', id);
        }
    }

    $("#createAssigneMachine").on("click", function () {
        let assign_bottler_name = $("#assign_bottler_name").val();
        let assign_sub_bottler_name = $("#assign_sub_bottler_name").val();
        let assign_machine_number = $("#assign_machine_number").val();
        let flag = false;

        function checkEmptyField(field, fieldName) {
            if (field === '') {
                flag = true;
                Swal.fire({
                    title: 'Alert',
                    text: fieldName + " is required.",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        }

        checkEmptyField(assign_machine_number, 'Machine Number');
        checkEmptyField(assign_sub_bottler_name, 'Sub Bottler Name');
        checkEmptyField(assign_bottler_name, 'Bottler Name');

        if (flag) {
            return false;
        }

        $("#assignMachineForm").submit();
    });
</script>
<!-- Assign Machine To Bottler End -->
@endsection

