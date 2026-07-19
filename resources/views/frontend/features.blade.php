@extends('frontend.index')
@section('title')
    {{ __('Our Features') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1504817342151-c668c157467d?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>Next-Gen Core Platform Architecture</h1>
            <p>Explore what makes our cloud orchestration layer faster and more robust.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container grid-2">
            <div style="background:white; padding:2.5rem; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
                <h3 style="color:var(--primary); font-size:1.4rem;">✓ Free Automated Consulting</h3>
                <p style="margin-top:0.5rem; color:var(--text-muted);">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.</p>
            </div>
            <div style="background:white; padding:2.5rem; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
                <h3 style="color:var(--primary); font-size:1.4rem;">✓ Live Vital Alert Sync</h3>
                <p style="margin-top:0.5rem; color:var(--text-muted);">Predictive workflows automatically trigger vital telemetry analytics to the closest nursing hubs immediately.</p>
            </div>
        </div>
    </section>
@endsection