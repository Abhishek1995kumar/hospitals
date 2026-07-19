@extends('frontend.index')
@section('title')
    {{ __('Blog') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1488998427799-e3362ece93ce?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>Clinical Insights & Health Innovations</h1>
            <p>Stay informed with articles curated directly by medical practitioners.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container grid-2">
            <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="padding:2rem;">
                    <span style="color:var(--accent); font-weight:600; font-size:0.85rem;">TECHNOLOGY</span>
                    <h3 style="margin:0.5rem 0; font-size:1.5rem;">Understanding AI Diagnostic Frameworks</h3>
                    <p style="color:var(--text-muted);">How machine orchestration engines elevate early critical care identification with precision analytics modules.</p>
                </div>
            </div>
            <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="padding:2rem;">
                    <span style="color:var(--accent); font-weight:600; font-size:0.85rem;">PATIENT CARE</span>
                    <h3 style="margin:0.5rem 0; font-size:1.5rem;">The Future of Paperless Cloud Check-ins</h3>
                    <p style="color:var(--text-muted);">Moving away from traditional clinical clipboards towards real-time encrypted QR system architectures.</p>
                </div>
            </div>
        </div>
    </section>
@endsection