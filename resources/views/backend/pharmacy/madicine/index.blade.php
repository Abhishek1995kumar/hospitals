@extends('backend.layouts.admin')
@section('title') {{ __('Pharmacy Madicine')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Pharmacy Madicine')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Pharmacy Madicine')}}</li>
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
                    <h5 class="alert-heading">{{ __('Total Madicine')}}</h5>
                    <p class="mb-0" id="completeValue"></p>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header border-0 pt-6">
                <ul class="nav nav-tabs" id="partyTabMenu" role="tablist">
                    @permission('authentication.view')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="madicineTabBtn" data-bs-toggle="tab" data-bs-target="#madicineTab" type="button" role="tab"> {{ __('Madicine Dashboard') }} </button>
                    </li>
                    @endpermission
                    @permission('authentication.view')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="batchMadicineTabBtn" data-bs-toggle="tab" data-bs-target="#batchMadicineTab" type="button" role="tab"> {{ __('Batch Madicine Dashboard') }} </button>
                    </li>
                    @endpermission
                </ul>
            </div>

            <div class="card-body pt-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="madicineTab" role="tabpanel">
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
                                <button type="button" class="btn btn-primary mx-2" id="addMadicine" data-url="{{ route('pharmacy.madicine.create') }}">
                                    {{ __('Add Madicine')}}
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="partyTable">
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

                    <div class="tab-pane fade " id="batchMadicineTab" role="tabpanel">
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
                                <button type="button" class="btn btn-primary mx-2" id="addBatchMadicine" data-url="{{ route('pharmacy.madicine.batch.create') }}">
                                    {{ __('Add Batch Madicine')}}
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="partyTable">
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
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('backend/js/custom/comman.js') }}"></script>
    <script>
        // let url = '/admin/pharmacy/madicine';
        // loadData('madicine', url);
        // $('#madicineTabBtn').on('show.bs.tab', function (e) {
        //     loadData('madicine', url);
        // });
        // $('#batchMadicineTabBtn').on('show.bs.tab', function (e) {
        //     loadData('batchMadicine', url);
        // });

        loadPage("{{ route('pharmacy.madicine') }}");
        $(document).off('click', '#addMadicine').on('click', '#addMadicine', function(e){
            e.preventDefault();
            loadPage("{{ route('pharmacy.madicine.create') }}");
        });

        $(document).off('click', '#addBatchMadicine').on('click', '#addBatchMadicine', function(e){
            e.preventDefault();
            loadPage("{{ route('pharmacy.madicine.batch.create') }}");
        });


        $(document).off('click', '#export').on('click', '#export', function(e){
            e.preventDefault();
            let type = 'madicine';
            let exportUrl = "{{ route('admin.export') }}/" + type;
            // Temporary invisible link trigger karke local download karwana
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