@extends('backend.layouts.admin')
@section('title') {{ __('Departments')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Department')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Department')}}</li>
    </ul>
@endsection

@section('content')
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
                <h5 class="alert-heading">{{ __('Total Cost')}}</h5>
                <p class="mb-0" id="completeValue"></p>
            </div>
        </div>

        <div class="col-3">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">{{ __('Total Parent Departments')}}</h5>
                <p class="mb-0" id="completeValue"></p>
            </div>
        </div>
        
        <div class="col-3">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">{{ __('Total Child Departments')}}</h5>
                <p class="mb-0" id="completeValue"></p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header border-0 pt-6">
            <ul class="nav nav-tabs" id="roleTabMenu" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="costTabBtn" data-bs-toggle="tab" data-bs-target="#costTab" type="button" role="tab"> {{ __('Cost Center') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="parentTabBtn" data-bs-toggle="tab" data-bs-target="#parentTab" type="button" role="tab"> {{ __('Department') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="childTabBtn" data-bs-toggle="tab" data-bs-target="#childTab" type="button" role="tab"> {{ __('Child Department') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="budgetTabBtn" data-bs-toggle="tab" data-bs-target="#budgetTab" type="button" role="tab"> {{ __('Budget') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="budgetAllocationTabBtn" data-bs-toggle="tab" data-bs-target="#budgetAllocationTab" type="button" role="tab"> {{ __('Budget Allocation') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="expenseTabBtn" data-bs-toggle="tab" data-bs-target="#expenseTab" type="button" role="tab"> {{ __('Expenses') }} </button>
                </li>
                @if(authUser()->customer_id != '' || authUser()->customer_id != null)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ asset('backend/documents/pharmacy/madicine_user.pdf') }}" target="_blank" class="btn btn-danger btn-sm">
                            <i class="bi bi-book"></i> {{ __('User Guide')}}
                        </a>
                    </li>
                @else
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ asset('backend/documents/pharmacy/madicine_user.pdf') }}" target="_blank" class="btn btn-danger btn-sm">
                            <i class="bi bi-book"></i> {{ __('User Guide')}}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="documentationTabBtn" href="{{ asset('backend/documents/pharmacy/madicine_developer.pdf') }}" target="_blank" class="btn btn-danger btn-sm">
                            <i class="bi bi-book"></i> {{ __('Developer Guide')}}
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="card-body pt-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="costTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput" class="form-control w-250px ps-15" placeholder="Search cost center" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addCostCenter" class="btn btn-primary" id="addCostCenterModal" >
                                {{ __('Add Cost Center')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="roleTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Center Name')}}</th>
                                    <th class="text-center">{{ __('Amount')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="parentTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" id="searchInput" class="form-control w-250px ps-15" placeholder="Search department" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addDepartment" class="btn btn-primary" id="addDepartmentModal" >
                                    {{ __('Add Department')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="permissionTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Cost Amount')}}</th>
                                    <th class="text-center">{{ __('Department')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="childTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-15" placeholder="Search child department" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addChildDepartment" class="btn btn-primary"  id="addChildDepartmentModal">
                                    {{ __('Add Child Department')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="rolePermissionTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Cost Center')}}</th>
                                    <th class="text-center">{{ __('Department')}}</th>
                                    <th class="text-center">{{ __('Child Department')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="budgetTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-15" placeholder="Search budget" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addBudget" class="btn btn-primary"  id="addBudgetModal">
                                    {{ __('Add Budget')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="budgetTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Hospital')}}</th>
                                    <th class="text-center">{{ __('Title')}}</th>
                                    <th class="text-center">{{ __('Financial Year')}}</th>
                                    <th class="text-center">{{ __('Start Date')}}</th>
                                    <th class="text-center">{{ __('End Date')}}</th>
                                    <th class="text-center">{{ __('Total Amount')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="budgetAllocationTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-15" placeholder="Search budget allocation" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addBudgetAllocation" class="btn btn-primary"  id="addBudgetAllocationModal">
                                    {{ __('Add Budget Allocation')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="budgetAllocationTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Hospital')}}</th>
                                    <th class="text-center">{{ __('Department')}}</th>
                                    <th class="text-center">{{ __('Cost Center')}}</th>
                                    <th class="text-center">{{ __('Budget')}}</th>
                                    <th class="text-center">{{ __('Amount')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="expenseTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-15" placeholder="Search expense" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addExpense" class="btn btn-primary"  id="addExpenseModal">
                                    {{ __('Add Expense')}}
                                </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="expenseTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Hospital')}}</th>
                                    <th class="text-center">{{ __('Department')}}</th>
                                    <th class="text-center">{{ __('Cost Center')}}</th>
                                    <th class="text-center">{{ __('Budget')}}</th>
                                    <th class="text-center">{{ __('Amount')}}</th>
                                    <th class="text-center">{{ __('Reference')}}</th>
                                    <th class="text-center">{{ __('Expense Date')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
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



    <!-- Cost Center start -->
        <div class="modal fade modal-md" id="addCostCenter" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Cost Center')}}</h2>
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
                        <form id="costCenterForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-4 " id="costNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Cost')}}</label>
                                                        <input type="text" name="name" id="costName" class="form-control" maxlength="100" placeholder="Enter cost name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary costCenterBtn" id="costCenterBtnId" onclick="saveCostCenter(event)">{{ __('Create Cost Center')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade modal-md" id="editCostCenter" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Update Cost Center')}}</h2>
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
                                                <div class="col-md-12 mb-4 " id="updateCostCenterNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Cost Center')}}</label>
                                                        <input type="text" name="name" id="updateCostCenterName" class="form-control" maxlength="100" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary costCenterBtn" id="updateCostCenterBtnId" onclick="editCostCenterBtn(event)" >{{ __('Update Cost Center')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Cost Center end -->


    <!-- Department start -->
        <div class="modal fade modal-sm" id="addDepartment" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Department')}}</h2>
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
                                                <div class="col-md-6 mb-4 " id="departmentNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Department')}}</label>
                                                        <input type="text" name="name" id="departmentName" class="form-control" maxlength="100" placeholder="Enter department name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary departmentBtn" id="saveDepartmentBtn" onclick="saveDepartment(event)">{{ __('Create Department')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade modal-sm" id="editDepartment" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editDepartmentTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Update Department')}}</h2>
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
                                                <div class="col-md-6 mb-4 " id="updateDepartmentNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Department')}}</label>
                                                        <input type="text" name="name" id="updateDepartmentName" class="form-control" maxlength="100" placeholder="Enter department name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary departmentBtn" id="updateDepartmentBtn" onclick="updateDepartment(event)">{{ __('Update Department')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Department end -->


    <!-- Child Department start -->
        <div class="modal fade modal-md" id="addChildDepartment" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Child Department')}}</h2>
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
                        <form id="childDepartmentForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="parentIdDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Parent Department')}}</label>
                                                        <select name="parent_id" class="form-select" id="parent_id" data-control="select2" data-placeholder="Select parent department" data-allow-clear="true">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="departmentNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Child Department')}}</label>
                                                        <input type="text" name="name" id="departmentName" class="form-control" maxlength="100" placeholder="Enter child department name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary childDepartmentBtn" id="saveChildDepartmentBtn" onclick="saveChildDepartment(event)">{{ __('Create Child Department')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade modal-md" id="editChildDepartment" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editChildDepartmentTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Update Child Department')}}</h2>
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
                        <form id="updateChildDepartmentForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="hiddenChildDepartmentId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="editParentIdDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Parent Department')}}</label>
                                                        <select name="parent_id" class="form-select" id="edit_parent_id" data-control="select2" data-placeholder="Select parent department" data-allow-clear="true">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="updateChildDepartmentNameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Child Department')}}</label>
                                                        <input type="text" name="name" id="updateChildDepartmentName" class="form-control" maxlength="100" placeholder="Enter child department name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary childDepartmentBtn" id="updateChildDepartmentBtn" onclick="updateChildDepartment(event)">{{ __('Update Child Department')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Department end -->


    <!-- Budget start -->
        <div class="modal fade modal-lg" id="addBudget" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Budget')}}</h2>
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
                        <form id="budgetForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="hospitalIdDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" class="form-select search" id="hospitalId" data-control="select2" data-placeholder="Select hospital">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="firmIdDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Firm')}}</label>
                                                        <select name="firm_id" class="form-select search" id="firmId" data-control="select2" data-placeholder="Select firm">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="titleDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Title')}}</label>
                                                        <input type="text" name="title" id="title" class="form-control" maxlength="100" placeholder="Enter title" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="financial_yearDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Financial Year')}}</label>
                                                        <select name="financial_year" id="financial_year" class="form-select search" data-control="select2" data-placeholder="Select financial year">
                                                            <option selected disabled >Select financial year</option>
                                                            <option value="2020" >2020</option>
                                                            <option value="2021" >2021</option>
                                                            <option value="2022" >2022</option>
                                                            <option value="2023" >2023</option>
                                                            <option value="2024" >2024</option>
                                                            <option value="2025" >2025</option>
                                                            <option value="2026" >2026</option>
                                                            <option value="2027" >2027</option>
                                                            <option value="2028" >2028</option>
                                                            <option value="2029" >2029</option>
                                                            <option value="2030" >2030</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="start_dateDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Start Date')}}</label>
                                                        <input type="text" name="start_date" id="start_date" class="form-control" maxlength="100" placeholder="Enter start date" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="end_dateDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('End Date')}}</label>
                                                        <input type="text" name="end_date" id="end_date" class="form-control" maxlength="100" placeholder="Enter end date" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="total_amountDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Total Amount')}}</label>
                                                        <input type="text" name="total_amount" id="total_amount" class="form-control" maxlength="100" placeholder="Enter total amount" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary budgetBtn" onclick="saveBudget(event)">{{ __('Save Budget')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="editBudget" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Edit Budget')}}</h2>
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
                        <form id="editBudgetForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="editHospitalIdDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" class="form-select" id="editHospitalId" data-control="select2" data-placeholder="Select hospital">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="editFirmIdDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Firm')}}</label>
                                                        <select name="firm_id" class="form-select" id="editFirmId" data-control="select2" data-placeholder="Select firm">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="editTitleDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Title')}}</label>
                                                        <input type="text" name="title" id="editTitle" class="form-control" maxlength="100" placeholder="Enter title" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="editFinancialYearDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Financial Year')}}</label>
                                                        <select name="financial_year" id="editFinancialYear" class="form-select" data-control="select2" data-placeholder="Select financial year">
                                                            <option value="2020" >2020</option>
                                                            <option value="2021" >2021</option>
                                                            <option value="2022" >2022</option>
                                                            <option value="2023" >2023</option>
                                                            <option value="2024" >2024</option>
                                                            <option value="2025" >2025</option>
                                                            <option value="2026" >2026</option>
                                                            <option value="2027" >2027</option>
                                                            <option value="2028" >2028</option>
                                                            <option value="2029" >2029</option>
                                                            <option value="2030" >2030</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="editStartDateDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Start Date')}}</label>
                                                        <input type="text" name="start_date" id="editStartDate" class="form-control" maxlength="100" placeholder="Enter start date" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="editEndDateDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('End Date')}}</label>
                                                        <input type="text" name="end_date" id="editEndDate" class="form-control" maxlength="100" placeholder="Enter end date" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="editTotalAmountDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Total Amount')}}</label>
                                                        <input type="text" name="total_amount" id="editTotalAmount" class="form-control" maxlength="100" placeholder="Enter total amount" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary editBudgetBtn" onclick="updateBudget(event)">{{ __('Save Budget')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Budget end -->


    <!-- Budget allocation start -->
        <div class="modal fade modal-lg" id="addBudgetAllocation" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Budget Allocation')}} </h2>
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
                        <form id="budgetAllocationForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="allocation_hospital_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" class="form-select" id="allocation_hospital_id" data-control="select2" data-placeholder="Select hospital">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="allocation_budget_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Budget')}}</label>
                                                        <select name="budget_id" class="form-select" id="allocation_budget_id" data-control="select2" data-placeholder="Select budget">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="allocation_department_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Department')}}</label>
                                                        <select name="department_id" class="form-select" id="allocation_department_id" data-control="select2" data-placeholder="Select department">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="allocation_cost_center_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Cost Center')}}</label>
                                                        <select name="cost_center_id" class="form-select" id="allocation_cost_center_id" data-control="select2" data-placeholder="Select cost center">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="allocation_allocated_amountDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Allocated Amount')}}</label>
                                                        <input type="text" name="allocated_amount" id="allocation_allocated_amount" class="form-control" maxlength="100" placeholder="Enter allocated amount" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary budgetAllocationBtn" onclick="saveBudgetAllocation(event)">{{ __('Save Budget')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="editBudgetAllocation" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Edit Budget Allocation')}}</h2>
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
                        <form id="editBudgetAllocationForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="edit_allocation_hospital_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" class="form-select" id="edit_allocation_hospital_id" data-control="select2" data-placeholder="Select hospital">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="edit_allocation_budget_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Budget')}}</label>
                                                        <select name="budget_id" class="form-select" id="edit_allocation_budget_id" data-control="select2" data-placeholder="Select budget">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="edit_allocation_department_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Department')}}</label>
                                                        <select name="department_id" class="form-select" id="edit_allocation_department_id" data-control="select2" data-placeholder="Select department">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="edit_allocation_cost_center_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Cost Center')}}</label>
                                                        <select name="cost_center_id" class="form-select" id="edit_allocation_cost_center_id" data-control="select2" data-placeholder="Select cost center">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="edit_allocation_allocated_amountDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Allocated Amount')}}</label>
                                                        <input type="text" name="allocated_amount" id="edit_allocation_allocated_amount" class="form-control" maxlength="100" placeholder="Enter allocated amount" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary editBudgetAllocationBtn" onclick="updateBudgetAllocation(event)">{{ __('Save Budget')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Budget end -->


    <!-- Expenses start -->
        <div class="modal fade modal-lg" id="addExpense" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Expense')}} </h2>
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
                        <form id="expenseForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="expense_hospital_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" class="form-select" id="expense_hospital_id" data-control="select2" data-placeholder="Select hospital">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="expense_budget_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Budget')}}</label>
                                                        <select name="budget_allocation_id" class="form-select" id="expense_budget_id" data-control="select2" data-placeholder="Select budget">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="expense_department_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Department')}}</label>
                                                        <select name="department_id" class="form-select" id="expense_department_id" data-control="select2" data-placeholder="Select department">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="expense_cost_center_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Cost Center')}}</label>
                                                        <select name="cost_center_id" class="form-select" id="expense_cost_center_id" data-control="select2" data-placeholder="Select cost center">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="expense_amountDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Amount')}}</label>
                                                        <input type="text" name="amount" id="expense_amount" class="form-control" maxlength="100" placeholder="Enter amount" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="expense_reference_noDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Reference Number')}}</label>
                                                        <input type="text" name="reference_no" id="expense_reference_no" class="form-control" maxlength="100" placeholder="Enter reference no" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="expense_expense_dateDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Expense Date')}}</label>
                                                        <input type="text" name="expense_date" id="expense_expense_date" class="form-control" maxlength="100" placeholder="Enter expense date" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="expense_descriptionDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Description')}}</label>
                                                        <input type="text" name="description" id="expense_description" class="form-control" maxlength="100" placeholder="Enter description" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary expenseBtn" onclick="saveExpense(event)">{{ __('Save Expense')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="editExpense" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Edit Expense')}}</h2>
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
                        <form id="editExpenseForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="edit_expense_hospital_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Hospital')}}</label>
                                                        <select name="hospital_id" class="form-select" id="edit_expense_hospital_id" data-control="select2" data-placeholder="Select hospital">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="edit_expense_budget_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Budget')}}</label>
                                                        <select name="budget_allocation_id" class="form-select" id="edit_expense_budget_id" data-control="select2" data-placeholder="Select budget">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="edit_expense_department_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Department')}}</label>
                                                        <select name="department_id" class="form-select" id="edit_expense_department_id" data-control="select2" data-placeholder="Select department">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4" id="edit_expense_cost_center_id_Div">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Cost Center')}}</label>
                                                        <select name="cost_center_id" class="form-select" id="edit_expense_cost_center_id" data-control="select2" data-placeholder="Select cost center">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="edit_expense_amountDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Amount')}}</label>
                                                        <input type="text" name="amount" id="edit_expense_amount" class="form-control" maxlength="100" placeholder="Enter amount" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="edit_expense_reference_noDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Reference Number')}}</label>
                                                        <input type="text" name="reference_no" id="edit_expense_reference_no" class="form-control" maxlength="100" placeholder="Enter reference no" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="edit_expense_expense_dateDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Expense Date')}}</label>
                                                        <input type="text" name="expense_date" id="edit_expense_expense_date" class="form-control" maxlength="100" placeholder="Enter expense date" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="edit_expense_descriptionDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Description')}}</label>
                                                        <input type="text" name="description" id="edit_expense_description" class="form-control" maxlength="100" placeholder="Enter description" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary editExpenseBtn" onclick="updateExpense(event)">{{ __('Save Expense')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Budget end -->


@endsection

@section('scripts')
<script src="{{ asset('backend/js/custom/comman.js') }}"></script>
<script src="{{ asset('backend/js/custom/insert.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#addBudget').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });
    });
    $(document).ready(function() {
        $(document).on('shown.bs.modal', '.modal', function () {  // Kisi bhi modal ke open hote hi uske andar ke .search class ko initialize karega
            var $modal = $(this);
            
            $modal.find('.search').each(function () {
                var $select = $(this);
                if ($select.hasClass("select2-hidden-accessible")) {  // Agar Select2 pehle se initialized hai, toh use destroy karke dobara init karenge
                    $select.select2('destroy');
                }

                $select.select2({   // Fresh Select2 Initialization with dropdownParent
                    dropdownParent: $modal,
                    width: '100%' // Responsive styling fix
                });
            });
        });
    });
</script>
@endsection