@extends('layouts.admin')

@section('title') {{ __('Requests')}} @endsection

@section('style')

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ __('Requests')}}</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/admin/dashboard')}}" class="text-muted text-hover-primary">{{ __('Dashboard')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">{{ __('Requests')}}</li>
</ul>
@endsection

@section('content')

@endsection

@section('scripts')

@endsection