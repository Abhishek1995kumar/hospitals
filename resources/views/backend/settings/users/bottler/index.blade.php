@extends('layouts.admin')

@section('title','Botler List')

@section('header')

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Botler</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/admin/dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Bottler Details</li>
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
            <h5 class="alert-heading">Total Botler</h5>
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
    <div class="card-header border-0 pt-6" style="justify-content: left !important;">
        <div class="card-title">
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBotler" class="btn btn-primary" >
                    Add Botler
                </button>
            </div>
        </div>
        <!-- <div class="card-title">
            <div class="d-flex align-items-center position-relative">
                <button class="btn btn-success p-3"><i class="fa fa-file-excel"></i>Export</button>
            </div>
        </div> -->
        <div class="card-title">
            <div class="d-flex align-items-center position-relative">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMachineFilter"><i class="fa fa-fw fa-filter"></i>Filter</button>
            </div>
        </div>
        
        <div class="card-title">
            <div class="d-flex align-items-center position-relative">
                <a href="{{ route('admin.user.botler.list') }}" class="btn btn-light p-3"><i class="fa fa-fw fa-refresh"></i>Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table">
            <thead>
                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    @foreach($botlerHeader as $header)
                        <th class="min-w-125px">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach($botlerList as $botler)
                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">
                            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 70px; overflow: hidden; border-radius: 10px; ">
                                @php
                                    $filePath = $botler->company_logo ?? '';
                                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                @endphp
                                @if (!empty($filePath))
                                    <a href="{{ asset($filePath) }}" target="_blank" rel="noopener noreferrer">
                                        <div class="d-flex flex-column align-items-center">
                                            @if (strtolower($extension) === 'pdf')
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" 
                                                    alt="PDF File" 
                                                    width="70" 
                                                    height="70"     q
                                                    class="img-fluid"
                                                    style="max-width: 30%; max-height: 30%; object-fit: contain;">
                                            @else
                                                <img src="{{ asset($filePath) }}" onerror="this.onerror=null; this.src='/assets/media/blank.png';"
                                                    alt="Grievance File" 
                                                    width="70" 
                                                    height="70"
                                                    class="img-fluid" 
                                                    style="max-width: 30%; max-height: 30%; object-fit: contain;">
                                            @endif
                                        </div>
                                    </a>
                                @else
                                    <img src="{{ asset('assets/media/blank.png') }}"
                                        alt="No File Available"
                                        width="30"
                                        height="30"
                                        class="img-fluid"
                                        style="max-width: 30%; max-height: 30%; object-fit: contain;">
                                @endif
                            </div>
                        </th>
                        <th class="min-w-125px">
                            <a href="{{ url('admin/user/botler/detail', $botler->id) }}">{{ $botler->bottler_name }}</a>
                        </th>
                        <th class="min-w-125px">{{ $botler->company_name }}</th>
                        <th class="min-w-125px">{{ $botler->company_url }}</th>
                        <th class="min-w-125px">{{ $botler->color_code }}</th>
                        <th class="min-w-125px">{{ \Carbon\Carbon::parse($botler->created_at)->format('M d Y') }}</th>
                        <th class="min-w-125px">{{ ($botler->status === 1) ? 'Enable' : 'Disable' }}</th>
                        <th class="min-w-125px">
                            <div class="d-flex flex-row">
                                <button  class="btn btn-sm  btn-warning action-select" data-id="{{ $botler->id }}" data-name="{{ $botler->bottler_name }}" data-company="{{ $botler->company_name }}" data-url="{{ $botler->company_url }}" data-status="{{ $botler->status }}" data-color="{{ $botler->color_code }}" data-company_logo="{{ $botler->company_logo }}" data-machine="{{ $botler->machine_logo }}" data-bottle="{{ $botler->bottle_logo }}"><i class="fa fa-pencil"></i></button>
                                <button class="btn  btn-sm btn-danger action-select" data-id="{{ $botler->id }}" data-name="{{ $botler->bottler_name }}" data-company="{{ $botler->company_name }}" data-url="{{ $botler->company_url }}" data-status="{{ $botler->status }}" data-color="{{ $botler->color_code }}" data-company_logo="{{ $botler->company_logo }}" data-machine="{{ $botler->machine_logo }}" data-bottle="{{ $botler->bottle_logo }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </th>
                    </tr>
                @endforeach
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
                    <h2 class="fw-bold">Create Botler</h2>
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
                    <form id="leaderNameForm" action="{{ route('admin.user.botler.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-4 " id="bottler_name_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Bottler Name</label>
                                                    <input type="text" name="bottler_name" id="bottler_name_edit" class="form-control" placeholder="Enter Bottler Name" maxlength="30" >
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="company_name_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Company Name</label>
                                                    <input type="text" name="company_name" id="company_name_edit" class="form-control" placeholder="Enter Company Name" maxlength="200" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="company_url_edit">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Company Url</label>
                                                    <input type="text" name="company_url" id="company_url_edit" class="form-control" placeholder="Enter Company Url" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="status_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Status </label>
                                                    <select type="text" name="status" id="status_edit" class="form-select" placeholder="Select Status">
                                                        <option value="1" {{ $botler->status == 1 ? 'selected' : '' }}>Enable</option>
                                                        <option value="0" {{ $botler->status == 0 ? 'selected' : '' }}>Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="color_code_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Choose Color</label>
                                                    <input type="color" name="color_code" id="color_code_edit" class="form-control" style="height: 3.3rem !important;" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="">
                                            </div>
                                            <div class="col-md-4 mb-4 " id="company_logo_edit">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Company Logo (.png)</label>
                                                    <input type="file" name="company_logo" id="company_logo_edit" class="form-control" accept=".png, .jpg, .jpeg, .pdf" >
                                                    <span class="text-muted">Support only png/jpg/jpeg/pdf file and file size less than 2 mb</span>
                                                    <div class="previewContainer" id="company_logo_edit_preview"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="machine_logo_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Machine Logo (.png)</label>
                                                    <input type="file" name="machine_logo" id="machine_logo_edit" class="form-control" accept=".png, .jpg, .jpeg, .pdf" >
                                                    <span class="text-muted">Support only png/jpg/jpeg/pdf file and file size less than 2 mb</span>
                                                    <div class="previewContainer" id="machine_logo_edit_preview"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="bottle_logo_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Bottle Logo (.png)</label>
                                                    <input type="file" name="bottle_logo" id="bottle_logo_edit" class="form-control" accept=".png, .jpg, .jpeg, .pdf" >
                                                    <div class="previewContainer" id="bottle_logo_edit_preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer modal-footer">
                                        <button type="submit" class="btn btn-primary" id="editBotlerSubmit">Edit Botler</button>
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
    <div class="modal fade modal-lg" id="editBotler" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editBotlerTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h2 class="fw-bold">Edit Botler</h2>
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
                    <form id="editBotlerForm" action="{{ route('admin.user.botler.update') }}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="editBotlerId" value="{{ $botler->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" name="application_category_id" value="8">
                                        <div class="row">
                                            <div class="col-md-4 mb-4 " id="bottler_name_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Bottler Name</label>
                                                    <input type="text" name="bottler_name" id="bottler_name_edit" class="form-control" placeholder="Enter Bottler Name" maxlength="30" value="{{ $botler->bottler_name }}" >
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="company_name_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Company Name</label>
                                                    <input type="text" name="company_name" id="company_name_edit" class="form-control" placeholder="Enter Company Name" maxlength="200" value="{{ $botler->company_name }}" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="company_url_edit">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Company Url</label>
                                                    <input type="text" name="company_url" id="company_url_edit" class="form-control" placeholder="Enter Company Url" value="{{ $botler->company_url }}" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="status_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Status </label>
                                                    <select type="text" name="status" id="status_edit" class="form-select" placeholder="Select Status">
                                                        <option value="1" {{ $botler->status == 1 ? 'selected' : '' }}>Enable</option>
                                                        <option value="0" {{ $botler->status == 0 ? 'selected' : '' }}>Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="color_code_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Choose Color</label>
                                                    <input type="color" name="color_code" id="color_code_edit" class="form-control" style="height: 3.3rem !important;" value="{{ $botler->color_code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="">
                                            </div>
                                            <div class="col-md-4 mb-4 " id="company_logo_edit">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Company Logo (.png)</label>
                                                    <input type="file" name="company_logo" id="company_logo_edit" class="form-control" accept=".png, .jpg, .jpeg, .pdf" value="{{ $botler->company_logo }}">
                                                    <span class="text-muted">Support only png/jpg/jpeg/pdf file and file size less than 2 mb</span>
                                                    <div class="previewContainer" id="company_logo_edit_preview"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="machine_logo_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Machine Logo (.png)</label>
                                                    <input type="file" name="machine_logo" id="machine_logo_edit" class="form-control" accept=".png, .jpg, .jpeg, .pdf" value="{{ $botler->machine_logo }}" >
                                                    <span class="text-muted">Support only png/jpg/jpeg/pdf file and file size less than 2 mb</span>
                                                    <div class="previewContainer" id="machine_logo_edit_preview"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 " id="bottle_logo_edit_div">
                                                <div class="form-group">
                                                    <label class="required fs-6 fw-semibold mb-2">Bottle Logo (.png)</label>
                                                    <input type="file" name="bottle_logo" id="bottle_logo_edit" class="form-control" value="{{ $botler->bottle_logo }}" accept=".png, .jpg, .jpeg, .pdf" >
                                                    <div class="previewContainer" id="bottle_logo_edit_preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer modal-footer">
                                        <button type="submit" class="btn btn-primary" id="editBotlerSubmit">Edit Botler</button>
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
    <div class="modal fade modal-md" id="createMachineFilter" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="createMissionTitle" aria-hidden="true">
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
                                            <div class="col-md-12 mb-4" id="ngoCenterDiv">
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
        var el = $(this);
        var id = el.data('id');

        if (action === 'edit') {
            // Populate text fields
            $('#editBotler input[name="id"]').val(id);
            $('#bottler_name_edit').val(el.data('name') || '');
            $('#company_name_edit').val(el.data('company') || '');
            $('#company_url_edit').val(el.data('url') || '');
            $('#status_edit').val(el.data('status'));
            $('#color_code_edit').val(el.data('color') || '');

            // Show existing uploaded file names as text or preview
            // You can update UI like below each file input:
            $('#company_logo_edit').closest('.form-group').find('.file-preview').remove();
            $('#company_logo_edit').after(`<div class="file-preview mt-2">Current: ${el.data('company_logo')}</div>`);

            $('#machine_logo_edit').closest('.form-group').find('.file-preview').remove();
            $('#machine_logo_edit').after(`<div class="file-preview mt-2">Current: ${el.data('machine')}</div>`);

            $('#bottle_logo_edit').closest('.form-group').find('.file-preview').remove();
            $('#bottle_logo_edit').after(`<div class="file-preview mt-2">Current: ${el.data('bottle')}</div>`);

            // Update form action
            $('#editBotlerForm').attr('action', '/admin/user/botler/update/' + id);

            // Show modal
            $('#editBotler').modal('show');
        } else if (action === 'delete') {
            $('#deleteConfirmationModal').modal('show');
            $('#confirmDelete').data('id', id);
        }
        // Reset dropdown after action
        $(this).val('');
    });

    $("#company_logo_edit").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#company_logo_edit_preview").attr("src", "").hide();
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
                    $("#company_logo_edit_preview").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("#machine_logo_edit").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#machine_logo_edit_preview").attr("src", "").hide();
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
                    $("#machine_logo_edit_preview").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("#bottle_logo_edit").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#bottle_logo_edit_preview").attr("src", "").hide();
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
                    $("#bottle_logo_edit_preview").attr("src", e.target.result).show();
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
    previewFiles("company_logo", "company_logo_preview");
    previewFiles("machine_logo", "machine_logo_preview");
    previewFiles("bottle_logo", "bottle_logo_preview");

    document.getElementById('company_name_edit').addEventListener('input', function() {
        document.getElementById('company_url_edit').value = (this.value).toLowerCase().replace(/\s+/g, '-');
    });
</script>

<script>
    let selectedBotlerId = null;
    // Open Edit Modal
    $(document).on('click', '.btn-warning.action-select', function () {
        const data = $(this).data();
        $('#editBotlerId').val(data.id);
        $('#bottler_name_edit').val(data.name);
        $('#company_name_edit').val(data.company);
        $('#company_url_edit').val(data.url);
        $('#status_edit').val(data.status);
        $('#color_code_edit').val(data.color);
        // Optionally show logo preview if needed

        $('#editBotler').modal('show');
    });

    // Open Delete Modal
    $(document).on('click', '.btn-danger.action-select', function () {
        selectedBotlerId = $(this).data('id');
        $('#deleteConfirmationModal').modal('show');
    });

    // Confirm Delete
    $('#confirmDelete').on('click', function () {
        $.ajax({
            url: "{{ route('admin.user.botler.delete') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: selectedBotlerId
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert('Failed to delete');
                }
            },
            error: function () {
                alert('Error deleting botler');
            }
        });
    });
</script>


<script>
    $("#company_logo_edit").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#company_logo_edit_preview").attr("src", "").hide();
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
                    $("#company_logo_edit_preview").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("#machine_logo_edit").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#machine_logo_edit_preview").attr("src", "").hide();
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
                    $("#machine_logo_edit_preview").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("#bottle_logo_edit").on("change", function () {
        let allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        let maxSizeInBytes = 1 * 1024 * 1024; // 2MB
        let file = this.files[0];
        // Reset preview initially
        $("#bottle_logo_edit_preview").attr("src", "").hide();
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
                    $("#bottle_logo_edit_preview").attr("src", e.target.result).show();
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
    previewFiles("company_logo_edit", "company_logo_edit_preview");
    previewFiles("machine_logo_edit", "machine_logo_edit_preview");
    previewFiles("bottle_logo_edit", "bottle_logo_edit_preview");

    document.getElementById('company_name_edit').addEventListener('input', function() {
        document.getElementById('company_url_edit').value = (this.value).toLowerCase().replace(/\s+/g, '-');
    });
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



@endsection
