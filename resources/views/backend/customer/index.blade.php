@extends('backend.layouts.admin')
@section('title') {{ __('Customers')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Customers')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Customer')}}</li>
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

    <div id="pageContent">
        <div class="row">
            <div class="col-3">
                <div class="alert alert-success text-center border border-success">
                    <h5 class="alert-heading">{{ __('Total Customers')}}</h5>
                    <p class="mb-0" id="completeValue"></p>
                </div>
            </div>
            
        </div>

        <div class="card mt-4">
            <div class="card-header border-0 pt-6">
                <ul class="nav nav-tabs" id="customerTabMenu" role="tablist">
                    @permission('customer.view')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="customerTabBtn" data-bs-toggle="tab" data-bs-target="#customerTab" type="button" role="tab">
                            <i class="bi bi-speedometer2 me-1"></i> {{ __('Customer Dashboard') }}
                        </button>
                    </li>
                    @endpermission
                    {{-- New Section: Associated Hospitals --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="hospitalTabBtn" data-bs-toggle="tab" data-bs-target="#hospitalTab" type="button" role="tab">
                            <i class="bi bi-building me-1"></i> {{ __('Hospitals') }}
                        </button>
                    </li>
                    {{-- New Section: Associated Employees --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="userTabBtn" data-bs-toggle="tab" data-bs-target="#userTab" type="button" role="tab">
                            <i class="bi bi-employee me-1"></i> {{ __('Employees') }}
                        </button>
                    </li>
                    {{-- New Section: Plan & Subscription Details --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="subscriptionTabBtn" data-bs-toggle="tab" data-bs-target="#subscriptionTab" type="button" role="tab">
                            <i class="bi bi-card-checklist me-1"></i> {{ __('Plan & Subscription') }}
                        </button>
                    </li>
                    {{-- New Section: Billing & Invoices History --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="billingTabBtn" data-bs-toggle="tab" data-bs-target="#billingTab" type="button" role="tab">
                            <i class="bi bi-receipt me-1"></i> {{ __('Billing & Invoices') }}
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body pt-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="customerTab" role="tabpanel">
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
                                <div class="card-toolbar">
                                    <a href="javascript:void(0)" class="btn btn-primary mx-3" id="addCustomer" data-url="{{ route('customer.create') }}">
                                        {{ __('Add Customer') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 kt_table" id="customerTable">
                                <thead>
                                    @if(empty(authUser()->customer_id))
                                        <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center">{{ __('Sr No.')}}</th>
                                            <th class="text-center">{{ __('Name')}}</th>
                                            <th class="text-center">{{ __('Plan')}}</th>
                                            <th class="text-center">{{ __('Features')}}</th>
                                            <th class="text-center">{{ __('Start Date')}}</th>
                                            <th class="text-center">{{ __('End Date')}}</th>
                                            <th class="text-center">{{ __('Price')}}</th>
                                            <th class="text-center">{{ __('Payment Status')}}</th>
                                            <th class="text-center">{{ __('Action')}}</th>
                                        </tr>
                                    @else 
                                        <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center">{{ __('Sr No.')}}</th>
                                            <th class="text-center">{{ __('Name')}}</th>
                                            <th class="text-center">{{ __('Plan')}}</th>
                                            <th class="text-center">{{ __('Features')}}</th>
                                            <th class="text-center">{{ __('Start Date')}}</th>
                                            <th class="text-center">{{ __('End Date')}}</th>
                                            <th class="text-center">{{ __('Contact')}}</th>
                                            <th class="text-center">{{ __('Action')}}</th>
                                        </tr> 
                                    @endif
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @if(empty(authUser()->customer_id))
                                        <script>
                                            // $(document).ready(function() {
                                                loadDatabaseRecord(
                                                    '/admin/customer/list?type=customer',
                                                    'customer',
                                                    [
                                                        { data:'no' },
                                                        { data:'customer_name' },
                                                        { data:'plan_name' },
                                                        { data:'plan_features' },
                                                        { data:'subscription_start_date' },
                                                        { data:'subscription_end_date' },
                                                        { data:'plan_price' },
                                                        { data:'payment_status' },
                                                        { data:'action' }
                                                    ],
                                                    '#customerTable',
                                                    editRecord,
                                                    deleteRecord,
                                                    showRecord,
                                                    '#editCustomerModal',
                                                    '#showCustomerModal'
                                                );
                                            // })
                                        </script>
                                    @else
                                        <script>
                                            // $(document).ready(function() {
                                                loadDatabaseRecord(
                                                    '/admin/customer/list?type=customer',
                                                    'customer',
                                                    [
                                                        { data:'no' },
                                                        { data:'customer_name' },
                                                        { data:'plan_name' },
                                                        { data:'plan_features' },
                                                        { data:'subscription_start_date' },
                                                        { data:'subscription_end_date' },
                                                        { data:'mobile_no' },
                                                        { data:'action' }
                                                    ],
                                                    '#customerTable',
                                                    editRecord,
                                                    deleteRecord,
                                                    showRecord,
                                                    '#editCustomerModal',
                                                    '#showCustomerModal'
                                                );
                                            // })
                                        </script>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="subscriptionTab" role="tabpanel">
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
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 kt_table" id="subscriptionTable">
                                <thead>
                                    @if(empty(authUser()->customer_id))
                                        <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center">{{ __('Sr No.')}}</th>
                                            <th class="text-center">{{ __('Name')}}</th>
                                            <th class="text-center">{{ __('Plan')}}</th>
                                            <th class="text-center">{{ __('Subscription End Date')}}</th>
                                            <th class="text-center">{{ __('Days Left Subscription')}}</th>
                                            <th class="text-center">{{ __('Action')}}</th>
                                        </tr>
                                    @else
                                        <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center">{{ __('Sr No.')}}</th>
                                            <th class="text-center">{{ __('Plan')}}</th>
                                            <!-- <th class="text-center">{{ __('Invoice')}}</th>
                                            <th class="text-center">{{ __('Transaction')}}</th> -->
                                            <th class="text-center">{{ __('Amount')}}</th>
                                            <th class="text-center">{{ __('Start Date')}}</th>
                                            <th class="text-center">{{ __('End Date')}}</th>
                                            <th class="text-center">{{ __('Payment By')}}</th>
                                            <th class="text-center">{{ __('Status')}}</th>
                                            <th class="text-center">{{ __('Action')}}</th>
                                        </tr>
                                    @endif
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @if(empty(authUser()->customer_id))
                                        <script>
                                            $(document).on('show.bs.tab', '#subscriptionTabBtn', function (e) {
                                                loadDatabaseRecord(
                                                    '/admin/customer/list?type=subscription',
                                                    'subscription',
                                                    [         
                                                        { data:'no' },
                                                        { data:'customer_name' },
                                                        { data:'plan_name' },
                                                        { data:'subscription_end_date' },
                                                        { data:'days_left' },
                                                        { data:'action' }
                                                    ],
                                                    '#subscriptionTable',
                                                    editRecord,
                                                    deleteRecord,
                                                    showRecord,
                                                    '#editSubscriptionModal',
                                                    '#showSubscriptionModal'
                                                );
                                            })
                                        </script>
                                    @else
                                        <script>
                                            $(document).on('show.bs.tab', '#subscriptionTabBtn', function (e) {
                                                loadDatabaseRecord(
                                                    '/admin/customer/list?type=subscription',
                                                    'subscription',
                                                    [
                                                        { data:'no' },
                                                        { data:'plan_name' },
                                                        // { data:'invoice_no' },
                                                        // { data:'transaction_id' },
                                                        { data:'amount' },
                                                        { data:'start_date' },
                                                        { data:'end_date' },
                                                        { data:'gateway_name' },
                                                        { data:'status_text' },
                                                        { data:'action' }
                                                    ],
                                                    '#subscriptionTable',
                                                    editRecord,
                                                    deleteRecord,
                                                    showRecord,
                                                    '#editSubscriptionModal',
                                                    '#showSubscriptionModal'
                                                );
                                            })
                                        </script>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="userTab" role="tabpanel">
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
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 kt_table" id="userTable">
                                <thead>
                                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">{{ __('Sr No.')}}</th>
                                        <th class="text-center">{{ __('Name')}}</th>
                                        <th class="text-center">{{ __('Contact')}}</th>
                                        <th class="text-center">{{ __('Email')}}</th>
                                        <th class="text-center">{{ __('Firm')}}</th>
                                        <th class="text-center">{{ __('Employees')}}</th>
                                        <th class="text-center">{{ __('Hospital')}}</th>
                                        <th class="text-center">{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">

                                </tbody>
                            </table>
                        </div>
                    </div> 

                    <div class="tab-pane fade" id="hospitalTab" role="tabpanel">
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
                                <div class="card-toolbar">
                                    <a href="javascript:void(0)" class="btn btn-primary mx-3" id="addHospitals" data-url="{{ route('customer.create') }}">
                                        {{ __('Add Hospital') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 kt_table" id="hospitalTable">
                                <thead>
                                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">{{ __('Sr No.')}}</th>
                                        <th class="text-center">{{ __('Name')}}</th>
                                        <th class="text-center">{{ __('Contact')}}</th>
                                        <th class="text-center">{{ __('Email')}}</th>
                                        <th class="text-center">{{ __('Firm')}}</th>
                                        <th class="text-center">{{ __('Employees')}}</th>
                                        <th class="text-center">{{ __('Hospital')}}</th>
                                        <th class="text-center">{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="billingTab" role="tabpanel">
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
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 kt_table" id="billingTable">
                                <thead>
                                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">{{ __('Sr No.')}}</th>
                                        <th class="text-center">{{ __('Name')}}</th>
                                        <th class="text-center">{{ __('Contact')}}</th>
                                        <th class="text-center">{{ __('Email')}}</th>
                                        <th class="text-center">{{ __('Firm')}}</th>
                                        <th class="text-center">{{ __('Employees')}}</th>
                                        <th class="text-center">{{ __('Hospital')}}</th>
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
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('backend/js/custom/comman.js') }}"></script>
    <script>
        // Tab Switch for Batch Medicine
        $(document).on('show.bs.tab', '#hospitalTabBtn', function (e) {
            loadDatabaseRecord(
                '/admin/customer/list?type=hospital',
                'hospital',
                [
                    { data: 'no' },
                    { data: 'supplier_name' },
                    { data: 'generic_name' },
                    { data: 'batch_number' },
                    { data: 'mfg_date' },
                    { data: 'expiry_date' },
                    { data: 'action' }
                ],
                '#hospitalTable',
                editRecord,
                deleteRecord,
                showRecord,
                '#editHospitalModal',
                '#showHospitalModal'
            );
        });

        // Tab Switch for Batch Medicine
        $(document).on('show.bs.tab', '#billingTabBtn', function (e) {
            loadDatabaseRecord(
                '/admin/customer/list?type=billing',
                'billing',
                [
                    { data: 'no' },
                    { data: 'supplier_name' },
                    { data: 'generic_name' },
                    { data: 'batch_number' },
                    { data: 'mfg_date' },
                    { data: 'expiry_date' },
                    { data: 'action' }
                ],
                '#billingTable',
                editRecord,
                deleteRecord,
                showRecord,
                '#editBillingModal',
                '#showBillingModal'
            );
        });

        // Tab Switch for Employee
        $(document).on('show.bs.tab', '#userTabBtn', function (e) {
            loadDatabaseRecord(
                '/admin/customer/list?type=user',
                'user',
                [
                    { data: 'no' },
                    { data: 'supplier_name' },
                    { data: 'generic_name' },
                    { data: 'batch_number' },
                    { data: 'mfg_date' },
                    { data: 'expiry_date' },
                    { data: 'action' }
                ],
                '#userTable',
                editRecord,
                deleteRecord,
                showRecord,
                '#editUserModal',
                '#showUserModal'
            );
        });




        loadPage("{{ route('customer.index') }}");
        $(document).off('click', '#addCustomer').on('click', '#addCustomer', function(e){
            e.preventDefault();
            loadPage("{{ route('customer.create') }}");
        });




        let KTAppEcommerceCategories = function() {
            var n = () => {

            };
            return {
                init: function() {
                    (t = document.querySelector(".kt_table")) && ((e = $(t).DataTable({
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
@endsection