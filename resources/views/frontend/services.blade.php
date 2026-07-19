@extends('frontend.index')
@section('title')
    {{ __('About US') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>We Offer Different Services To Improve Your Health</h1>
            <p>Explore world-class automated screening medical paradigms driven by precision medical devices.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container">
            <div class="grid-4">
                <div class="service-card"><span class="service-icon">❤️</span><h3>Cardiology</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">🦴</span><h3>Orthopedics</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">🫁</span><h3>Pulmonology</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">🦷</span><h3>Dental Care</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">💊</span><h3>Medicine</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">🚑</span><h3>Ambulance</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">👁️</span><h3>Ophthalmology</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
                <div class="service-card"><span class="service-icon">🧠</span><h3>Neurology</h3><p style="color:var(--text-muted); margin-top:0.8rem;">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem.</p></div>
            </div>
        </div>
    </section>
@endsection