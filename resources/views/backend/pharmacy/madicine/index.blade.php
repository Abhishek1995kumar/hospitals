@extends('backend.layouts.admin')
@section('title') {{ __('Madicine')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Madicine')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Madicine')}}</li>
    </ul>
@endsection

@section('content')
    @foreach(['danger', 'warning', 'success', 'info'] as $msg)
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
                <h5 class="alert-heading">{{ __('Total Madicine')}}</h5>
                <p class="mb-0" id="completeValue"></p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header border-0 pt-6">
            <ul class="nav nav-tabs" id="roleTabMenu" role="tablist">
                @permission('authentication.view')
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="roleTabBtn" data-bs-toggle="tab" data-bs-target="#roleTab" type="button" role="tab"> {{ __('Madicine Dashboard') }} </button>
                </li>
                @endpermission

                @permission('module.view')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moduleTabBtn" data-bs-toggle="tab" data-bs-target="#moduleTab" type="button" role="tab"> {{ __('Parent Module') }} </button>
                </li>
                @endpermission
            </ul>
        </div>

        <div class="card-body pt-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="roleTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput" class="form-control w-250px ps-15" placeholder="Search role" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addRole" class="btn btn-primary" id="addModalBtnRole" >
                                {{ __('Add Role')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="roleTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Name')}}</th>
                                    <th class="text-center">{{ __('Scope')}}</th>
                                    <th class="text-center">{{ __('Priority')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="moduleTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput" class="form-control w-250px ps-15" placeholder="Search permission" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addModule" class="btn btn-primary" id="addModuleModal" >
                                {{ __('Add Module')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="moduleTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Parent Module')}}</th>
                                    <th class="text-center">{{ __('Module')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="childModuleTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput" class="form-control w-250px ps-15" placeholder="Search permission" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addChildModule" class="btn btn-primary" id="addChildModuleModal" >
                                {{ __('Add Child Module')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="childModuleTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Parent Module')}}</th>
                                    <th class="text-center">{{ __('Module')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="permissionTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput" class="form-control w-250px ps-15" placeholder="Search permission" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addPermission" class="btn btn-primary" id="addModalBtnPermission" >
                                    {{ __('Add Permission')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="permissionTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Module')}}</th>
                                    <th class="text-center">{{ __('Permission')}}</th>
                                    <th class="text-center">{{ __('Permission Type')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="rolePermissionTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-15" placeholder="Search role permission" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addRolePermissionMapping" class="btn btn-primary"  id="createRolePermissionMapping">
                                    {{ __('Add Role Permission Mapping')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="rolePermissionTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-125px">{{ __('Id')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Role')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Permision')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="roleUserTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-15" placeholder="Search role permission" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addRoleUserMapping" class="btn btn-primary"  id="createUserRoleMappingModal">
                                {{ __('Add User Role Mapping')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="userRoleTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-125px">{{ __('Id')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Role')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Employee')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Role start -->
        <div class="modal fade modal-lg" id="addRole" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Role')}}</h2>
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
                        <form id="roleForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="hospital_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" id="hospital_id" class="form-select search" data-control="select2" data-placeholder="Select customer" >

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="firm_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Firm Location')}}</label>
                                                        <select name="firm_id" id="firm_id" class="form-select search" data-control="select2" data-placeholder="Select firm" >
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="roleNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Role')}}</label>
                                                        <input type="text" name="name" id="roleName" class="form-control" maxlength="100" placeholder="Enter role name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="rolePriorityDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Role Priority')}}</label>
                                                        <select name="role_priority" id="role_priority" class="form-select search" data-control="select2" data-placeholder="Select role priority" >
                                                            <option selected disabled ></option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                            <option value="40">40</option>
                                                            <option value="50">50</option>
                                                            <option value="60">60</option>
                                                            <option value="70">70</option>
                                                            <option value="80">80</option>
                                                            <option value="90">90</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary roleBtn" id="roleBtnId" onclick="saveRole(event)">{{ __('Create Role')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade modal-md" id="editRole" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addRoleTitle">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Update Role')}}</h2>
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
                        <form id="roleForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="roleId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-4 " id="updateDescriptionDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Role')}}</label>
                                                        <input type="text" name="name" id="updateDescription" class="form-control" maxlength="100" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-4 " id="updateDescriptionDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Role')}}</label>
                                                        <input type="text" name="description" id="updateDescription" class="form-control" maxlength="100" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary roleBtn" id="updateRoleBtnId" onclick="editRoleBtn(event)" >{{ __('Update Role')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Role end -->



    <!-- Parent Module start -->
        <div class="modal fade modal-md" id="addModule" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addModuleTitle">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Module')}}</h2>
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
                        <form id="moduleForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="module_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Parent Module')}}</label>
                                                        <input type="text" name="name" id="module_id" class="form-control" maxlength="100" placeholder="Enter module" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="parent_module_icon_Div">
                                                    <div class="form-group">
                                                        <label class="fs-6 fw-semibold mb-2">{{ __('Module Icon')}}</label>
                                                        <input type="text" name="icon" id="parent_module_icon" class="form-control" maxlength="100" placeholder="Enter parent module icon" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary moduleBtn" id="saveModuleBtn" onclick="saveModule(event)">{{ __('Create Module')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Parent Module End -->


    
    <!-- Child Module start -->
        <div class="modal fade modal-md" id="addChildModule" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addChildModuleTitle">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Child Module')}}</h2>
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
                        <form id="childModuleForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="parent_module_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Parent Module')}}</label>
                                                        <select name="parent_id" id="parent_module_id" class="form-select search parent_permission_module_id" data-control="select2" data-placeholder="Select parent module">
                                                            <option selected disabled> {{ __('Select Parent Module')}} </option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="child_moduleDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Child Module')}}</label>
                                                        <input type="text" name="name" id="child_module_id" class="form-control" maxlength="100" placeholder="Enter module" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="child_module_icon_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Child Module Icon')}}</label>
                                                        <input type="text" name="icon" id="child_module_icon" class="form-control" maxlength="100" placeholder="Enter child module icon" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary childModuleBtn" id="saveChildModuleBtn" onclick="saveChildModule(event)">{{ __('Create Child Module')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Child Module End -->




    <!-- Permission start -->
        <div class="modal fade modal-md" id="addPermission" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addPermissionTitle">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Permission')}}</h2>
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
                        <form id="permissionForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="module_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Module')}}</label>
                                                        <select name="module_id" id="parent_permission_module_id" class="form-select search parent_permission_module_id" data-control="select2" data-placeholder="Select module">
                                                            <option selected disabled> {{ __('Select Parent Module')}} </option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="module_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Child Module')}}</label>
                                                        <select name="module_id" id="child_permission_module_id" class="form-select search" data-control="select2" data-placeholder="Select child module">
                                                            <option selected disabled> {{ __('Select Child Module')}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="nameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Permission')}}</label>
                                                        <input type="text" name="name" id="permissionName" class="form-control" maxlength="100" placeholder="Enter permission name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary permissionBtn" id="savePermissionBtn" onclick="savePermission(event)">{{ __('Create Permission')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade modal-md" id="editPermission" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editPermissionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Update Permission')}}</h2>
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
                        <form id="updatePermissionForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="hiddenPremissionId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="updatePermissionNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Permission')}}</label>
                                                        <input type="text" name="permission" id="updatePermissionName" class="form-control" maxlength="100" placeholder="Enter role name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary permissionBtn" id="updatePermissionBtn" onclick="updatePermission(event)">{{ __('Update Permission')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Permission end -->


    <!-- Role permission mapping start -->
        <div class="modal fade modal-lg" id="addRolePermissionMapping" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addRolePermissionMappingTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Role Permission Mapping')}}</h2>
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
                        <form id="rolePermissionMappingForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="ngoCenterDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Role')}}</label>
                                                        <select name="role_id" class="form-select search" id="roleMappingId" data-control="select2" data-placeholder="Select role">
                                                            <option selected disabled> {{ __('Select Role')}} </option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-4 mt-3" id="ngoCenterDiv">
                                                    <label class="required fs-6 fw-semibold mb-2">{{ __('Permission')}}</label>
                                                    <div class="form-group">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary" id="createRolePermissionMappingBtn" onclick="saveRolePermissionMapping(event)">{{ __('Assign Role Permission')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Role permission mapping end -->


    <!-- User role mapping start -->
        <div class="modal fade modal-lg" id="addRoleUserMapping" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addRoleUserMappingTitle">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create User Role Mapping')}}</h2>
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
                        <form id="roleUserMappingForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="roleUserMappingDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Role')}}</label>
                                                        <select name="role_id[]" class="form-select search" id="roleUserMappingId" multiple data-control="select2" data-placeholder="Select role">
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="userRoleMappingDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Employee Name')}}</label>
                                                        <select name="user_id[]" class="form-select search" id="userMappingId" multiple data-control="select2" data-placeholder="Select employee">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary" id="createUserRoleMappingBtn" onclick="saveUserRoleMapping(event)">{{ __('Assign User Role')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- User role mapping end -->
@endsection

@section('scripts')
<script src="{{ asset('backend/js/custom/comman.js') }}"></script>
<script src="{{ asset('backend/js/custom/insert.js') }}"></script>
<script>
    $(document).ready(function() {
        let url = '/admin/authentication/list/';
        loadData('role', url);
        $('#roleTabBtn').on('show.bs.tab', function (e) {
            loadData('role', url);
        });
        $('#moduleTabBtn').on('show.bs.tab', function (e) {
            loadData('module', url);
        });
        $('#childModuleTabBtn').on('show.bs.tab', function (e) {
            loadData('child-module', url);
        });
        $('#permissionTabBtn').on('show.bs.tab', function (e) {
            loadData('permission', url);
        });
        $('#rolePermissionTabBtn').on('show.bs.tab', function (e) {
            loadData('rolePermission', url);
        });
        $('#roleUserTabBtn').on('show.bs.tab', function (e) {
            loadData('roleUser', url);
        });

        $('#addRole').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });

        $('#editRole').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });
        $('#addPermission').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });
        $('#addRolePermissionMapping').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });
        $('#addChildModule').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });
    });
</script>
@endsection





