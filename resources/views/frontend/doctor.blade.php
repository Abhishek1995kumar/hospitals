@extends('frontend.index')
@section('title')
    {{ __('Doctors') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>Meet Our Experienced Specialists</h1>
            <p>Our automated systems dynamically map check-ins with top clinical researchers.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container grid-4">
            <div style="background:white; border-radius:12px; padding:2rem; text-align:center; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="width:90px; height:90px; background:#ff6b6b; border-radius:50%; margin:0 auto 1rem auto; display:flex; align-items:center; justify-content:center; color:white; font-size:1.8rem; font-weight:700;">KK</div>
                <h3>Dr. Abhishek Mishra</h3><p style="color:var(--text-muted)">MBBS Surgeries </p>
            </div>
            <div style="background:white; border-radius:12px; padding:2rem; text-align:center; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="width:90px; height:90px; background:#4dabf7; border-radius:50%; margin:0 auto 1rem auto; display:flex; align-items:center; justify-content:center; color:white; font-size:1.8rem; font-weight:700;">RK</div>
                <h3>Dr. Rohit Kambli</h3><p style="color:var(--text-muted)">MD Cardiology</p>
            </div>
            <div style="background:white; border-radius:12px; padding:2rem; text-align:center; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="width:90px; height:90px; background:#37b24d; border-radius:50%; margin:0 auto 1rem auto; display:flex; align-items:center; justify-content:center; color:white; font-size:1.8rem; font-weight:700;">AK</div>
                <h3>Dr. Akash Kshirsagar</h3><p style="color:var(--text-muted)">Bsc IT, Clinical Lead</p>
            </div>
        </div>
    </section>
@endsection

