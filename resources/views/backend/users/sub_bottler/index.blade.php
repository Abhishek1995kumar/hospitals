@extends('layouts.admin')

@section('title','Sub Botler List')

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
            <a href="{{ route('admin.master.machine.create') }}" class="btn btn-primary">Add Machine</a>
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
    <div class="card-header border-0 pt-6" style="    justify-content: left !important;">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative">
                <a href="{{ route('admin.user.sub-botler.list') }}" class="btn btn-light p-3"><i class="fa fa-fw fa-refresh"></i>Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table">
            <thead>
                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Botler Name.</th>
                    <th class="min-w-125px">Company Name</th>
                    <th class="min-w-125px">Status</th>
                    <th class="min-w-125px">Action</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                <?php $parent = 1; ?>
                <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Mahindra 42.</th>
                    <th class="min-w-125px">Mahindra</th>
                    <th class="min-w-125px">Active</th>
                    <th class="min-w-125px">
                        <select name="action" class="form-select action-select" data-id="$parent" onchange="location = this.value;">
                            <option value="">Operation</option>
                            <option class="" value="{{ url('admin/user/sub-botler/sub-list/' . $parent) }}">View Sub Botler</option>
                            <option class="" value="{{ url('admin/user/sub-botler/user-list/' . $parent) }}">View Sub Botler User</option>
                            <option class="" value="{{ url('admin/user/sub-botler/machine-list/' . $parent) }}">View Sub Botler Machine</option>
                        </select>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>


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
    $(function () {
        $('#dateRange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear',
                applyLabel: 'Apply'
            }
        });

        $('#dateRange').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
            $('#filterForm').submit(); // Auto-submit the form
        });

        $('#dateRange').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            $('#filterForm').submit(); // Auto-clear the filter
        });
    });
</script>
@endsection
