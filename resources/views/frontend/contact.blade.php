@extends('frontend.index')
@section('title')
    {{ __('Contact') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1423662055902-359428714341?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>Connect With Our Support Channels</h1>
            <p>Our desks operate 24/7. Submit requests directly into the priority triage matrix.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container" style="max-width:600px;">
            <div class="form-card">
                <h2 style="margin-bottom:1.5rem; text-align:center;">Drop a Message</h2>
                <div class="input-box"><label>Full Name</label><input type="text" placeholder="Your full identity name"></div>
                <div class="input-box"><label>Email Address</label><input type="email" placeholder="name@domain.com"></div>
                <div class="input-box"><label>Message</label><textarea rows="4" placeholder="How can we assist you today?"></textarea></div>
                <button class="submit-btn">Dispatch Communications</button>
            </div>
        </div>
    </section>
@endsection