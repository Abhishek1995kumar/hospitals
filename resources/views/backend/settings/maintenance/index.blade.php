@extends('backend.layouts.admin')
@section('title') {{ __('Maintenance')}} @endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/comman.css') }}">
@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Maintenance')}}</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Maintenance')}}</li>
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
    <div class="card mt-4">
        <div class="card-header border-0 pt-6">
            <ul class="nav nav-tabs" id="roleTabMenu" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="roleTabBtn" data-bs-toggle="tab" data-bs-target="#roleTab" type="button" role="tab"> {{ __('Route Clear') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="permissionTabBtn" data-bs-toggle="tab" data-bs-target="#permissionTab" type="button" role="tab"> {{ __('Cashe Clear') }} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rolePermissionTabBtn" data-bs-toggle="tab" data-bs-target="#rolePermissionTab" type="button" role="tab"> {{ __('Optimize Clear') }} </button>
                </li>
            </ul>
        </div>

        <div class="card-body pt-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="roleTab" role="tabpanel">
                    <div class="card-header border-0 pt-6">
                        <div class="card-toolbar">
                            <form method="POST" >
                                <button type="button" onclick="maintenanceClear(this)" class="btn btn-primary mx-3" data-type="route" class="btn btn-primary" >
                                    {{ __('Route Clear')}}
                                </button>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <form method="POST" >
                                <button type="button" onclick="maintenanceClear(this)" class="btn btn-primary mx-3" data-type="cache" class="btn btn-primary" >
                                    {{ __('Config Cache')}}
                                </button>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <form method="POST" >
                                <button type="button" onclick="maintenanceClear(this)" class="btn btn-primary mx-3" data-type="config" class="btn btn-primary" >
                                    {{ __('Config Clear')}}
                                </button>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <form method="POST" >
                                <button type="button" onclick="maintenanceClear(this)" class="btn btn-primary mx-3" data-type="optimize" class="btn btn-primary" >
                                    {{ __('Optimize Clear')}}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="roleTable">
                            
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
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="permissionTable">
                            
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
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="rolePermissionTable">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="{{ asset('backend/js/custom/roles/role.js') }}"></script>
<script src="{{ asset('backend/js/custom/comman.js') }}"></script>
<script>
    $(document).ready(function() {
        loadData('role');
        $('#roleTabBtn').on('show.bs.tab', function (e) {
            loadData('role');
        });
        $('#permissionTabBtn').on('show.bs.tab', function (e) {
            loadData('permission');
        });
        $('#rolePermissionTabBtn').on('show.bs.tab', function (e) {
            loadData('rolePermission');
        });
    });


    function loadData(type) {
        $.ajax({
            url: '/admin/roles/list/',
            data: {
                type: type
            },
            success:function(response){
                let data = typeof response.data === 'string' ? JSON.parse(response.data) : response.data;
                let html = '';
                if(type == 'role'){
                    data.forEach(function(role) {
                        html += `<tr>
                                <td class="text-center"> + ${role.id} + </td>
                                <td class="text-center"> + ${role.name} + </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" onclick="editRole(' + ${role.id} + ')">Edit</button>
                                    <button class="btn btn-sm btn-primary" onclick="deleteRole(' + ${role.id} + ')">Delete</button>
                                </td>
                            </tr>`;
                    });
                    $('#roleTable tbody').html(html);
                }

                if(type == 'permissions'){
                    response.forEach(function(permission) {
                        html += '<tr>';
                        html += '<td class="text-center">' + permission.id + '</td>';
                        html += '<td class="text-center">' + permission.name + '</td>';
                        html += '</tr>';
                    });
                    $('#permissionTable tbody').html(html);
                }

                if(type == 'rolePermission'){
                    response.forEach(function(rolePermission) {
                        html += '<tr>';
                        html += '<td class="text-center">' + rolePermission.role.id + '</td>';
                        html += '<td class="text-center">' + rolePermission.role.name + '</td>';
                        html += '<td class="text-center">' + rolePermission.permission.id + '</td>';
                        html += '<td class="text-center">' + rolePermission.permission.name + '</td>';
                        html += '</tr>';
                    });
                    $('#rolePermissionTable tbody').html(html);
                }
            }
        });
    }


    function maintenanceClear(button) {
        let url = ''
        let data = $(button).data('type');
        switch (data) {
            case 'route':
                url = '/admin/maintenances/route';
                break;

            case 'cache':
                url = '/admin/maintenances/cache';
                break;

            case 'config':
                url = '/admin/maintenances/config';
                break;

            case 'optimize':
                url = '/admin/maintenances/optimize';
                break;
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(resp){
                if(resp.code == 200 && resp.success == true){
                    validationAlert('Success', resp.message, 'success', 2000, 'OK');
                }
            }
        });
    }
</script>
@endsection