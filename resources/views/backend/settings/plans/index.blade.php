@extends('backend.layouts.admin')
@section('title') {{ __('Plans')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Plans')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Plans')}}</li>
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
                <h5 class="alert-heading">{{ __('Total Plan')}}</h5>
                <p class="mb-0" id="completeValue"></p>
            </div>
        </div>
        <div class="col-3">
            <div class="alert alert-success text-center border border-success">
                <h5 class="alert-heading">{{ __('Total Features')}}</h5>
                <p class="mb-0" id="permissionValue"></p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header border-0 pt-6">
            <ul class="nav nav-tabs" id="planTabMenu" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="planTabBtn" data-bs-toggle="tab" data-bs-target="#planTab" type="button" role="tab"> {{ __('Plan Dashboard') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="featureTabBtn" data-bs-toggle="tab" data-bs-target="#featureTab" type="button" role="tab"> {{ __('Feature Dashboard') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="planFeatureTabBtn" data-bs-toggle="tab" data-bs-target="#planFeatureTab" type="button" role="tab"> {{ __('Plan Feature Mapping') }} </button>
                </li>
            </ul>
        </div>

        <div class="card-body pt-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="planTab" role="tabpanel">
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
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addPlan" class="btn btn-primary" id="addModalBtnRole" >
                                {{ __('Add Plan')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="planTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Plan')}}</th>
                                    <th class="text-center">{{ __('Amount')}}</th>
                                    <th class="text-center">{{ __('Duratiion Days')}}</th>
                                    <th class="text-center">{{ __('Max Hospital')}}</th>
                                    <th class="text-center">{{ __('Max Firm')}}</th>
                                    <th class="text-center">{{ __('Max Employees')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="featureTab" role="tabpanel">
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
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addFeature" class="btn btn-primary" id="addFeatureModal" >
                                {{ __('Add Feature')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="featureTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">{{ __('Id')}}</th>
                                    <th class="text-center">{{ __('Module')}}</th>
                                    <th class="text-center">{{ __('Feature')}}</th>
                                    <th class="text-center">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="planFeatureTab" role="tabpanel">
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
                            <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addPlanFeatureMapping" class="btn btn-primary"  id="addPlanFeatureMappingId">
                                {{ __('Add Plan Feature Mapping')}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="featurePlanTable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-125px">{{ __('Id')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Plan')}}</th>
                                    <th class="text-center min-w-125px">{{ __('Feature')}}</th>
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



    <!-- Plan start -->
        <div class="modal fade modal-lg" id="addPlan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Plan')}}</h2>
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
                        <form id="planForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="plan_nameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Plan Name')}}</label>
                                                        <input name="plan_name" id="plan_name" class="form-control" placeholder="Enter plan name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="priceDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Plan Amount')}}</label>
                                                        <input name="price" id="price" type="number" class="form-control" placeholder="Enter price" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="duration_daysDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Duration Days')}}</label>
                                                        <input name="duration_days" id="duration_days" type="number" class="form-control" maxlength="10" placeholder="Enter duration days" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="max_hospitalsDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Max Hospitals')}}</label>
                                                        <input name="max_hospitals" id="max_hospitals" type="number" class="form-control" maxlength="10" placeholder="Enter max hospitals" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="max_firmsDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Max Firms')}}</label>
                                                        <input name="max_firms" id="max_firms" type="number" class="form-control" maxlength="10" placeholder="Enter max firms" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="max_hospitalsDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Max Users')}}</label>
                                                        <input name="max_hospitals" id="max_users" type="number" class="form-control" maxlength="10" placeholder="Enter max users" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary planBtn" id="planBtnId" onclick="savePlan(event)">{{ __('Create Plan')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    <!-- Plan end -->



    <!-- Feature start -->
        <div class="modal fade modal-lg" id="addFeature" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Feature')}}</h2>
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
                        <form id="planForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 " id="feature_nameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Feature Name')}}</label>
                                                        <input name="feature_name" id="feature_name" class="form-control" placeholder="Enter feature name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 " id="module_nameDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Module Name')}}</label>
                                                        <input name="module_name" id="module_name" type="text" class="form-control" placeholder="Enter module name" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-4 " id="descriptionDiv">
                                                    <div class="form-group">
                                                        <label class="fs-6 fw-semibold mb-2">{{ __('Description')}}</label>
                                                        <textarea name="description" id="description" type="text" class="form-control" placeholder="Enter duration days" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer modal-footer">
                                            <button type="submit" class="btn btn-primary featureBtn" id="featureBtnId" onclick="saveFeature(event)">{{ __('Create Feature')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    <!-- Feature end -->



    <!-- Plan feature mapping start -->
        <div class="modal fade modal-lg" id="addPlanFeatureMapping" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <input type="hidden" name="id" value="">
                    <div class="modal-header">
                        <h2 class="fw-bold">{{ __('Create Plan Feature Mapping')}}</h2>
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
                        <form id="planFeatureMappingForm" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" id="plan_idDiv">
                                                    <div class="form-group">
                                                        <label class="required fs-6 fw-semibold mb-2">{{ __('Plans')}}</label>
                                                        <select name="plan_id" class="form-select search" id="plan_id" data-control="select2" data-placeholder="Select plans">
                                                            <option selected disabled> {{ __('Select Plan')}} </option>
                                                            @if(isset($plans) && $plans->isNotEmpty())
                                                                @foreach($plans as $plan)
                                                                    <option value="{{ $plan->id }}"> {{ $plan->plan_name }} </option>
                                                                @endforeach
                                                            @else 
                                                                <option value="">{{ __('Data not available')}}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-4 mt-3" id="ngoCenterDiv">
                                                    <label class="required fs-6 fw-semibold mb-2">{{ __('Select Feature')}}</label>
                                                    <div class="form-group">
                                                        @if(isset($features) && $features->isNotEmpty())
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%"><strong>{{ __('MODULE')}}</strong></th>
                                                                        <th><strong>{{ __('FEATURE')}}</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($features as $module => $feature)
                                                                        <tr>
                                                                            <td><strong>{{ $module }}</strong></td>
                                                                            <td>
                                                                                <div class="d-flex flex-wrap gap-4">
                                                                                    @foreach($feature as $fea)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" value="{{ $fea->id }}" id="feature_{{ $fea->id }}" name="feature_id[]">
                                                                                            <label class="form-check-label" for="feature_{{ $fea->id }}">
                                                                                                {{ $fea->feature_name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
 
                                                        @else 
                                                            <option value="">{{ __('Data not available')}}</option>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary" id="createPlanFeatureMappingBtn" onclick="savePlanFeatureMapping(event)">{{ __('Assign Plan Feature Mapping')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Plan feature mapping end -->


@endsection

@section('scripts')
<script src="{{ asset('backend/js/custom/comman.js') }}"></script>
<script src="{{ asset('backend/js/custom/insert.js') }}"></script>
<script>
    $(document).ready(function() {
        let url = 'admin/plans/list';
        loadData('plan', url);
        $('#planTabBtn').on('show.bs.tab', function (e) {
            loadData('plan', url);
        });
        $('#featureTabBtn').on('show.bs.tab', function (e) {
            loadData('feature', url);
        });
        $('#planFeatureTabBtn').on('show.bs.tab', function (e) {
            loadData('planFeature', url);
        });

        $('#addPlanFeatureMapping').on('shown.bs.modal', function () {
            $(this).find('.search').select2({
                dropdownParent: $(this)
            });
        });

    });
</script>
@endsection