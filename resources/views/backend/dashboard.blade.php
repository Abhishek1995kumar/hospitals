@extends('backend.layouts.admin')

@section('title') {{ 'Dashboard' }} @endsection

@section('style')

@endsection

@section('breadcrumb')
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Dashboard')}}</h1>
@endsection

@section('content')
    <div class="row">
        
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection