@extends('backend.layouts.auth')

@section('title') {{ __('Login') }} @endsection

@section('style')
	<style>
		.justify-content {
			right !important;
		}
	</style>
@endsection

@section('content')
	<div class="d-flex justify-content p-5">
		<div class="bg-body d-flex flex-center rounded-4 w-md-400px p-5">
			<div class="w-md-500px">
				<form class="form" novalidate="novalidate" id="kt_sign_in_form" action="{{ url('/auth') }}" method="post">
					<div class="text-center mb-11">
						<div class="">
							<img src="{{ asset('frontend/img/hero1.jpg') }}" class="mb-5" alt="Hero Image" width="100" height="100" style="border-radius: 5rem;">
						</div>
						<div class="fs-1 fw-bolder text-dark mb-3">Welcome to Hospital</div>
					</div>

					<div class="" id="loginDiv">
						<div class="fv-row mb-3">
							<input type="text" placeholder="Login Id" id="Login" name="login" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row mb-3">
							<input type="password" placeholder="Password" id="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
						</div>
					</div>

					<div class="d-grid mb-10">
						<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
							<span class="indicator-label">Sign In</span>
							<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script src="{{ asset('backend/js/custom/authentication/sign-in/general.js') }}"></script>
@endsection
