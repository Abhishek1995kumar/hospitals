<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller {
    public function index() {
        return view('frontend.home');
    }

    public function doctors() {
        return view('frontend.doctor');
    }

    public function bookAppointment() {
        return view('frontend.appointment');
    }

    public function services() {
        return view('frontend.services');
    }

    public function testimonials() {
        return view('frontend.testimonials');
    }

    public function termsConditions() {
        return view('frontend.terms-conditions');
    }

    public function privacyPolicy() {
        return view('frontend.privacy-policy');
    }

    public function about() {
        return view('frontend.about');
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function blog() {
        return view('frontend.blog');
    }

    public function womenAndChildCare() {
        return view('frontend.women-child');
    }

    public function diagnostic() {
        return view('frontend.diagnostic');
    }

    public function surgery() {
        return view('frontend.surgery');
    }

    public function wellness() {
        return view('frontend.wellness');
    }

    public function homeCare() {
        return view('frontend.home_care');
    }


}
