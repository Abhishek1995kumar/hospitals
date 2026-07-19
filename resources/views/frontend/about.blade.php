@extends('frontend.index')
@section('title')
    {{ __('About US') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>About Our Medical Mission</h1>
            <p>Redefining clinical transparency using real-time distributed automation frameworks.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container">
            <h2 style="font-size:2.2rem; color:var(--dark);">Pioneering Digital Healthcare Transformation</h2>
            <p style="margin-top:1.5rem; color:var(--text-main); font-size:1.1rem; max-width:800px;">Our platform streamlines complete end-to-end administration. By managing doctor panels, instant nursery synchronization metrics, and live queue updates, we provide maximum efficiency with zero manual downtime overheads.</p>
        </div>
    </section>
@endsection