@extends('frontend.index')
@section('title')
    {{ __('About US') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1600&q=80');">
        <div class="hero-wrapper">
            <h1>Automated Slot Allocation Engine</h1>
            <p>Lock your clinical schedule instantly without human coordination errors.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="content-container" style="max-width:550px;">
            <div class="form-card">
                <h2 style="text-align:center; margin-bottom:2rem;">Reserve Medical Slot</h2>
                <div class="input-box"><label>Patient Legal Name</label><input type="text" placeholder="Enter Full Name"></div>
                <div class="input-box">
                    <label>Target Medical Unit</label>
                    <select><option>Cardiology Specialist Panel</option><option>Neurology Desk Cluster</option><option>General Outpatient OPD Unit</option></select>
                </div>
                <div class="input-box"><label>Preferred Appointment Timeline</label><input type="date"></div>
                <button class="submit-btn">Confirm Automated Slot</button>
            </div>
        </div>
    </section>
@endsection