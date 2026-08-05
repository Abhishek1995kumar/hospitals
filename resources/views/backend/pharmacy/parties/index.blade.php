@extends('backend.layouts.admin')
@section('title') {{ __('Pharmacy Client')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Pharmacy Client')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Pharmacy Client')}}</li>
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
                    <h5 class="alert-heading">{{ __('Total Pharmacy Client')}}</h5>
                    <p class="mb-0" id="completeValue"></p>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header border-0 pt-6">
                <ul class="nav nav-tabs" id="partyTabMenu" role="tablist">
                    @permission('authentication.view')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="partyTabBtn" data-bs-toggle="tab" data-bs-target="#partyTab" type="button" role="tab"> {{ __('Pharmacy Client') }} </button>
                    </li>
                    @endpermission
                </ul>
            </div>

            <div class="card-body pt-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="partyTab" role="tabpanel">
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
                                <button type="button" class="btn btn-primary mx-2" id="addPharmacyCustomer" data-url="{{ route('pharmacy.parties.create') }}">
                                    {{ __('Add Pharmacy Client')}}
                                </button>
                                <button type="button" class="btn btn-secondary " id="export">
                                    {{ __('Export')}}
                                </button>
                                <button type="button" class="btn btn-info mx-2" id="import" style="">
                                    {{ __('Import')}}
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="clientTable">
                                <thead>
                                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">{{ __('Id')}}</th>
                                        <th class="text-center">{{ __('Customer')}}</th>
                                        <th class="text-center">{{ __('Hospital')}}</th>
                                        <th class="text-center">{{ __('Company')}}</th>
                                        <th class="text-center">{{ __('GST NO')}}</th>
                                        <th class="text-center">{{ __('Pan No')}}</th>
                                        <th class="text-center">{{ __('Limit')}}</th>
                                        <th class="text-center">{{ __('Doctor')}}</th>
                                        <th class="text-center">{{ __('Balance')}}</th>
                                        <th class="text-center">{{ __('Type')}}</th>
                                        <th style="width:20rem" class="text-center">{{ __('Action')}}</th>
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
        // Initial load for Medicine
        $(document).ready(function() {
            loadDatabaseRecord(
                '/admin/pharmacy/parties/list?type=client', // Added ?type=madicine
                'client',
                [
                    { data: 'no' },
                    { data: 'customer_name' ?? '-'},
                    { data: 'hospital_name' ?? '-' },
                    { data: 'company_name' },
                    { data: 'client_name' },
                    { data: 'client_gst_no' },
                    { data: 'client_pan_no' },
                    { data: 'credit_limit' },
                    { data: 'doctor_name' },
                    { data: 'opening_balance' },
                    { data: 'balance_type' },
                    { data: 'action' }
                ],
                '#clientTable',
                editRecord,
                deleteRecord,
                showRecord,
                '#editClientModal',
                '#showClientModal'
            );
        });

        loadPage("{{ route('pharmacy.parties') }}");
        $(document).off('click', '#addPharmacyCustomer').on('click', '#addPharmacyCustomer', function(e){
            e.preventDefault();
            loadPage("{{ route('pharmacy.parties.create') }}");
        });


        $(document).off('click', '#export').on('click', '#export', function(e){
            e.preventDefault();
            let type = 'supplier';
            let exportUrl = "{{ route('admin.export') }}/" + type;
            let link = document.createElement('a');
            link.href = exportUrl;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
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