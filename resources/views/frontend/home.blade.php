@extends('frontend.index')
@section('title')
    {{ __('Home') }}
@endsection

@section('style')
    <style>
        /* Select2 Design Fix */
        .select2-container {
            width: 40% !important;
        }

        .select2-container--default .select2-selection--single {
            height: 45px !important;
            border: 1px solid #ddd !important;
            border-radius: 10px !important;
            padding: 10px 15px !important;
            display: flex !important;
            align-items: center !important;
            background: #1a2f6e !important;
        }

        .select2-container--default .select2-selection__rendered {
            line-height: normal !important;
            color: #333 !important;
            padding-left: 0 !important;
        }

        .select2-container--default .select2-selection__arrow {
            height: 48px !important;
            right: 12px !important;
        }

        .select2-dropdown {
            border-radius: 10px !important;
            border: 1px solid #ddd !important;
        }

        .select2-results__option {
            padding: 10px 15px !important;
        }

        .select2-search__field{
            width: 50rem;
        }

        @media(max-width:900px) {
            .select2-container {
                width: 100% !important;
            }
            .select2-container--default .select2-selection--single {
                height: 45px !important;
                border: 1px solid #ddd !important;
                border-radius: 10px !important;
                padding: 10px 15px !important;
                display: flex !important;
                align-items: center !important;
                background: #1a2f6e !important;
            }
        }
    </style>
@endsection

@section('content')
    <div id="page-home" class="page active">
        <section class="hero">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="{{ asset('frontend/videos/hero.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-left">
                <div class="hero-badge">
                    <span></span> TRUSTED HEALTHCARE PROVIDER
                </div>

                <h1>Find Local <span class="accent">Specialists</span> &amp; <span class="accent2">Best Services</span></h1>

                <p>Hamara medical clinic poori family ko quality care deta hai ek friendly aur personal atmosphere mein. Aapki health, humari pehli priority.</p>
                
                <div class="hero-btns">
                    <a class="btn-primary" href="{{ route('appointment') }}">Book Appointment</a>
                    <a class="btn-outline" href="#services">Our Services →</a>
                </div>
            </div>

            <div class="hero-right">
                <div>
                    <img class="hero-img" src="{{ asset('frontend/img/hero1.jpg') }}" alt="Hero Image" width="600" height="500" style="border-radius: 3rem;">
                </div>
            </div>
        </section>

        <section class="doctors-available">
            <div class="doctors-bottom">
                <div class="doctors-left">
                    <div class="section-title">{{ __('Our Doctors') }}</div>
                    <div class="doctors-available-grid">
                        <div class="slider-wrapper"> 
                            <div class="doctors-available-grid-track" id="doctorTrack">
                                <div class="step-card">
                                    <div class="step-icon">👨‍⚕️</div>
                                    <h3>Dr. Abhishek Mishra</h3>
                                    <p>Specialist ka profile dekhen, qualifications aur experience jaanein.</p>
                                    <button class="btn-book">Doctor Details</button>
                                </div>
                                <div class="step-card">
                                    <div class="step-icon">📋</div>
                                    <h3>Dr. Tehshin Bano</h3>
                                    <p>Appointment request karein aur preferred date aur time select karein.</p>
                                    <button class="btn-book">Doctor Details</button>
                                </div>
                                <div class="step-card">
                                    <div class="step-icon">📋</div>
                                    <h3>Dr. Sadaf Fatima</h3>
                                    <p>Appointment request karein aur preferred date aur time select karein.</p>
                                    <button class="btn-book">Doctor Details</button>
                                </div>
                                <div class="step-card">
                                    <div class="step-icon">📋</div>
                                    <h3>Dr. Neha Sharma</h3>
                                    <p>Appointment request karein aur preferred date aur time select karein.</p>
                                    <button class="btn-book">Doctor Details</button>
                                </div>
                                <div class="step-card">
                                    <div class="step-icon">📋</div>
                                    <h3>Dr. Zoya Ahmed</h3>
                                    <p>Appointment request karein aur preferred date aur time select karein.</p>
                                    <button class="btn-book">Doctor Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="doctors-right">
                    <div class="doctors-card">
                        <div class="doctors-card-title">
                            <div class="dot"></div>
                            Available Doctors — Today
                        </div>

                        <div class="doc-item">
                            <div class="avatar av-teal">AK</div>
                            <div class="doc-info">
                                <div class="doc-name">Dr. Abhishek Kumar</div>
                                <div class="doc-spec">MBBS · Cardiology</div>
                            </div>
                            <span class="status-badge status-online">Online</span>
                        </div>

                        <div class="doc-item">
                            <div class="avatar av-blue">TB</div>
                            <div class="doc-info">
                                <div class="doc-name">Dr. Tehshin Bano</div>
                                <div class="doc-spec">MS · Orthopedics</div>
                            </div>
                            <span class="status-badge status-online">Online</span>
                        </div>

                        <div class="doc-item">
                            <div class="avatar av-coral" style="background:#f5c4b3;color:#711b13;">SF</div>
                            <div class="doc-info">
                                <div class="doc-name">Dr. Sadaf Fatima</div>
                                <div class="doc-spec">BDS · Dental Care</div>
                            </div>
                            <span class="status-badge status-busy">Busy</span>
                        </div>

                        <div class="doc-item">
                            <div class="avatar av-green" style="background:#c0dd97;color:#27500a;">NS</div>
                            <div class="doc-info">
                                <div class="doc-name">Dr. Neha Sharma</div>
                                <div class="doc-spec">MD · Pulmonology</div>
                            </div>
                            <span class="status-badge status-online">Online</span>
                        </div>

                        <div class="mini-stats">
                            <div class="mini-stat">
                                <div class="num">21</div>
                                <div class="lbl">Doctors &amp; Nurses</div>
                            </div>

                            <div class="mini-stat">
                                <div class="num orange">1200+</div>
                                <div class="lbl">Patients Served</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="service-section">
            <div class="service-inner">
                <div class="section-tag">{{ __('Our Services') }}</div>
                <h2 class="section-title">{{ __('Available Services') }}</h2>
                <div class="srv-slider-outer" id="srvSliderOuter">
                    <div class="srv-slider-track" id="srvTrack">
                        <!-- Card 1: General Consultation -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E1F5EE;">
                                <img src="https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=600&h=360&fit=crop&auto=format" alt="{{ __('General Consultation') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E1F5EE;color:#1D9E75;">👨‍⚕️</div>
                                <span class="srv-badge">{{ __('General Consultation') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E1F5EE;color:#1D9E75;">🩺</div>
                                <h3 class="srv-card-title">{{ __('General Consultation') }}</h3>
                                <p class="srv-card-desc">Apne specialist ka profile dekhen, unki qualifications aur experience jaanein.</p>
                            </div>
                        </div>

                        <!-- Card 2: Pharmacy -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E6F1FB;">
                                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600&h=360&fit=crop&auto=format" alt="{{ __('Pharmacy') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E6F1FB;color:#185FA5;">💊</div>
                                <span class="srv-badge" style="color:#185FA5;">{{ __('Pharmacy') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E6F1FB;color:#185FA5;">💊</div>
                                <h3 class="srv-card-title">{{ __('Pharmacy') }}</h3>
                                <p class="srv-card-desc">Medicines aur prescriptions ki poori suvidha ek jagah par milti hai.</p>
                            </div>
                        </div>

                        <!-- Card 3: Laboratory -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#EEEDFE;">
                                <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?w=600&h=360&fit=crop&auto=format" alt="{{ __('Laboratory') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#EEEDFE;color:#534AB7;">🔬</div>
                                <span class="srv-badge" style="color:#534AB7;">{{ __('Laboratory') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#EEEDFE;color:#534AB7;">🔬</div>
                                <h3 class="srv-card-title">{{ __('Laboratory') }}</h3>
                                <p class="srv-card-desc">Advanced tests aur reports ki fast aur accurate service paayein.</p>
                            </div>
                        </div>

                        <!-- Card 4: Emergency Care -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#FCEBEB;">
                                <img src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=600&h=360&fit=crop&auto=format" alt="{{ __('Emergency Care') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#FCEBEB;color:#A32D2D;">🚨</div>
                                <span class="srv-badge" style="color:#A32D2D;">{{ __('Emergency Care') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#FCEBEB;color:#A32D2D;">🚑</div>
                                <h3 class="srv-card-title">{{ __('Emergency Care') }}</h3>
                                <p class="srv-card-desc">24/7 emergency treatment ke liye turant medical support milega.</p>
                            </div>
                        </div>

                        <!-- Card 5: Privacy Policy Packages -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#EAF3DE;">
                                <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=600&h=360&fit=crop&auto=format" alt="{{ __('Privacy Policy Packages') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#EAF3DE;color:#3B6D11;">🏥</div>
                                <span class="srv-badge" style="color:#3B6D11;">{{ __('Privacy Policy') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#EAF3DE;color:#3B6D11;">📋</div>
                                <h3 class="srv-card-title">{{ __('Privacy Policy Packages') }}</h3>
                                <p class="srv-card-desc">Complete body checkup packages affordable prices par uplabdh hain.</p>
                            </div>
                        </div>

                        <!-- Card 6: Ambulance Service -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#FAEEDA;">
                                <img src="https://images.unsplash.com/photo-1599045118108-bf9954418b76?w=600&h=360&fit=crop&auto=format" alt="{{ __('Ambulance Service') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#FAEEDA;color:#854F0B;">🚒</div>
                                <span class="srv-badge" style="color:#854F0B;">{{ __('Ambulance') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#FAEEDA;color:#854F0B;">🚐</div>
                                <h3 class="srv-card-title">{{ __('Ambulance Service') }}</h3>
                                <p class="srv-card-desc">GPS-tracked ambulance, har emergency mein turant response milega.</p>
                            </div>
                        </div>

                        <!-- Card 7: Vaccination -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#FBEAF0;">
                                <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=600&h=360&fit=crop&auto=format" alt="{{ __('Vaccination') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#FBEAF0;color:#993556;">💉</div>
                                <span class="srv-badge" style="color:#993556;">{{ __('Vaccination') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#FBEAF0;color:#993556;">💉</div>
                                <h3 class="srv-card-title">{{ __('Vaccination') }}</h3>
                                <p class="srv-card-desc">Sab umar ke liye vaccines, safe aur scheduled tarike se milti hain.</p>
                            </div>
                        </div>

                        <!-- Card 8: Telemedicine -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E1F5EE;">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=360&fit=crop&auto=format" alt="{{ __('Telemedicine') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E1F5EE;color:#0F6E56;">💻</div>
                                <span class="srv-badge" style="color:#0F6E56;">{{ __('Telemedicine') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E1F5EE;color:#0F6E56;">🖥️</div>
                                <h3 class="srv-card-title">{{ __('Telemedicine') }}</h3>
                                <p class="srv-card-desc">Ghar baithe doctor se consult karein video call ke zariye aasani se.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="srv-controls">
                    <button class="srv-btn" id="srvPrev" aria-label="Previous" disabled>&#8592;</button>
                    <div class="srv-dots" id="srvDots"></div>
                    <button class="srv-btn" id="srvNext" aria-label="Next">&#8594;</button>
                </div>

            </div>
        </section>

        <section class="feature-section">
            <div class="service-inner">
                <div class="section-tag">{{ __('Our Features') }}</div>
                <div class="srv-slider-outer" id="srvSliderOuter1">
                    <div class="srv-slider-track" id="srvTrack1">
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E1F5EE;">
                                <img src="https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=600&h=360&fit=crop&auto=format" alt="{{ __('General Consultation') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E1F5EE;color:#1D9E75;">👨‍⚕️</div>
                                <span class="srv-badge">{{ __('Appointment') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E1F5EE;color:#1D9E75;">🩺</div>
                                <h3 class="srv-card-title">{{ __('General Consultation') }}</h3>
                                <p class="srv-card-desc">Apne specialist ka profile dekhen, unki qualifications aur experience jaanein.</p>
                            </div>
                        </div>

                        <!-- Card 2:  Working Hours  -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E6F1FB;">
                                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600&h=360&fit=crop&auto=format" alt="{{ __('Working Hours') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E6F1FB;color:#185FA5;">💊</div>
                                <span class="srv-badge" style="color:#185FA5;">{{ __('Working Hours') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E6F1FB;color:#185FA5;">💊</div>
                                <h3 class="srv-card-title">{{ __('Working Hours') }}</h3>
                                <p class="srv-card-desc">Medicines aur prescriptions ki poori suvidha ek jagah par milti hai.</p>
                            </div>
                        </div>

                        <!-- Card 3: Testimonials -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#EEEDFE;">
                                <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?w=600&h=360&fit=crop&auto=format" alt="{{ __('Testimonials') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#EEEDFE;color:#534AB7;">🔬</div>
                                <span class="srv-badge" style="color:#534AB7;">{{ __('Testimonials') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#EEEDFE;color:#534AB7;">🔬</div>
                                <h3 class="srv-card-title">{{ __('Testimonials') }}</h3>
                                <p class="srv-card-desc">Advanced tests aur reports ki fast aur accurate service paayein.</p>
                            </div>
                        </div>

                        <!-- Card 4: Term & Conditions -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#FCEBEB;">
                                <img src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=600&h=360&fit=crop&auto=format" alt="{{ __('Term & Conditions') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#FCEBEB;color:#A32D2D;">🚨</div>
                                <span class="srv-badge" style="color:#A32D2D;">{{ __('Term & Conditions') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#FCEBEB;color:#A32D2D;">🚑</div>
                                <h3 class="srv-card-title">{{ __('Term & Conditions') }}</h3>
                                <p class="srv-card-desc">24/7 emergency treatment ke liye turant medical support milega.</p>
                            </div>
                        </div>

                        <!-- Card 5: Privacy Policy -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#EAF3DE;">
                                <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=600&h=360&fit=crop&auto=format" alt="{{ __('Privacy Policy') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#EAF3DE;color:#3B6D11;">🏥</div>
                                <span class="srv-badge" style="color:#3B6D11;">{{ __('Privacy Policy') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#EAF3DE;color:#3B6D11;">📋</div>
                                <h3 class="srv-card-title">{{ __('Privacy Policy') }}</h3>
                                <p class="srv-card-desc">Complete body checkup packages affordable prices par uplabdh hain.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="srv-controls">
                    <button class="srv-btn" id="srvPrev1" aria-label="Previous" disabled>&#8592;</button>
                    <div class="srv-dots" id="srvDots1"></div>
                    <button class="srv-btn" id="srvNext1" aria-label="Next">&#8594;</button>
                </div>
            </div>
        </section>
        <br><br>

        <section class="book-banner">
            <div class="banner-title">
                <h3>Book an Appointment</h3>
                <p>Abhi apna slot book karein</p>
            </div>
            <div class="banner-form">
                <select class="banner-select select2-init" data-placeholder="Select Doctor">
                    <option value=""></option>
                    <option>Dr. Abhishek Kumar — Cardiology</option>
                    <option>Dr. Tehshin Bano — Orthopedics</option>
                    <option>Dr. Sadaf Fatima — Dental Care</option>
                </select>
                <input type="text" class="banner-input flatpickr-init" data-format="h:i K d F Y" data-time="true" data-24hr="false" data-minute="5" placeholder="Select Date & Time">
                <button class="btn-booknow"> {{ __('Book Now →')}} </button>

            </div>
        </section>
        <br><br>

        <section class="feature-section">
            <div class="service-inner">
                <div class="flex justify-content-between">
                    <div class="section-tag">{{ __('Our Customers') }}</div>
                    <div class="section-title">{{ __('Trusted by Industry Leaders') }}</div>
                </div>
                <div class="srv-slider-outer" id="srvSliderOuter1">
                    <div class="srv-slider-track" id="srvTrack1">
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E1F5EE;">
                                <img src="https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=600&h=360&fit=crop&auto=format" alt="{{ __('General Consultation') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E1F5EE;color:#1D9E75;">👨‍⚕️</div>
                                <span class="srv-badge">{{ __('Appointment') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E1F5EE;color:#1D9E75;">🩺</div>
                                <h3 class="srv-card-title">{{ __('General Consultation') }}</h3>
                                <p class="srv-card-desc">Apne specialist ka profile dekhen, unki qualifications aur experience jaanein.</p>
                            </div>
                        </div>

                        <!-- Card 2:  Working Hours  -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#E6F1FB;">
                                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600&h=360&fit=crop&auto=format" alt="{{ __('Working Hours') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#E6F1FB;color:#185FA5;">💊</div>
                                <span class="srv-badge" style="color:#185FA5;">{{ __('Working Hours') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#E6F1FB;color:#185FA5;">💊</div>
                                <h3 class="srv-card-title">{{ __('Working Hours') }}</h3>
                                <p class="srv-card-desc">Medicines aur prescriptions ki poori suvidha ek jagah par milti hai.</p>
                            </div>
                        </div>

                        <!-- Card 3: Testimonials -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#EEEDFE;">
                                <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?w=600&h=360&fit=crop&auto=format" alt="{{ __('Testimonials') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#EEEDFE;color:#534AB7;">🔬</div>
                                <span class="srv-badge" style="color:#534AB7;">{{ __('Testimonials') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#EEEDFE;color:#534AB7;">🔬</div>
                                <h3 class="srv-card-title">{{ __('Testimonials') }}</h3>
                                <p class="srv-card-desc">Advanced tests aur reports ki fast aur accurate service paayein.</p>
                            </div>
                        </div>

                        <!-- Card 4: Term & Conditions -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#FCEBEB;">
                                <img src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=600&h=360&fit=crop&auto=format" alt="{{ __('Term & Conditions') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#FCEBEB;color:#A32D2D;">🚨</div>
                                <span class="srv-badge" style="color:#A32D2D;">{{ __('Term & Conditions') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#FCEBEB;color:#A32D2D;">🚑</div>
                                <h3 class="srv-card-title">{{ __('Term & Conditions') }}</h3>
                                <p class="srv-card-desc">24/7 emergency treatment ke liye turant medical support milega.</p>
                            </div>
                        </div>

                        <!-- Card 5: Privacy Policy -->
                        <div class="srv-card">
                            <div class="srv-card-img" style="background:#EAF3DE;">
                                <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=600&h=360&fit=crop&auto=format" alt="{{ __('Privacy Policy') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="icon-fallback" style="background:#EAF3DE;color:#3B6D11;">🏥</div>
                                <span class="srv-badge" style="color:#3B6D11;">{{ __('Privacy Policy') }}</span>
                            </div>
                            <div class="srv-card-body">
                                <div class="srv-card-icon" style="background:#EAF3DE;color:#3B6D11;">📋</div>
                                <h3 class="srv-card-title">{{ __('Privacy Policy') }}</h3>
                                <p class="srv-card-desc">Complete body checkup packages affordable prices par uplabdh hain.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="srv-controls">
                    <button class="srv-btn" id="srvPrev1" aria-label="Previous" disabled>&#8592;</button>
                    <div class="srv-dots" id="srvDots1"></div>
                    <button class="srv-btn" id="srvNext1" aria-label="Next">&#8594;</button>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            doctorSlider();
            serviceSlider();
            featureSlider();
        });

        function doctorSlider() {
            var track = document.getElementById('doctorTrack');
            if (!track) { return; }

            var cards = track.querySelectorAll('.step-card');
            var currentIndex = 0;
            track.style.display = 'flex';
            track.style.transition = 'transform 0.8s ease';

            function goToCard(index) {
                var cardWidth = cards[0].offsetWidth;
                var gap = 8; // CSS gap
                var move = (cardWidth + gap) * index;
                track.style.transform = 'translateX(-' + move + 'px)';
                currentIndex = index;
            }

            setInterval(function () {
                currentIndex++;
                if (currentIndex >= cards.length - 1) {
                    currentIndex = 0;
                }
                goToCard(currentIndex);
            }, 4000);

            var startX = 0;

            track.parentElement.addEventListener('touchstart', function (e) {
                startX = e.touches[0].clientX;
            });

            track.parentElement.addEventListener('touchend', function (e) {
                var diff = startX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) {
                        currentIndex = (currentIndex + 1) % cards.length;
                    } else {
                        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
                    }
                    goToCard(currentIndex);
                }
            });
        }

        function serviceSlider() {
            var track = document.getElementById('srvTrack');
            var outer = document.getElementById('srvSliderOuter');
            var prevBtn = document.getElementById('srvPrev');
            var nextBtn = document.getElementById('srvNext');
            var dotsWrap = document.getElementById('srvDots');
            var cards = track.getElementsByClassName('srv-card');

            var current = 0;
            var autoTimer;

            function getVisibleCards() {
                if (window.innerWidth <= 560) {
                    return 1;
                }

                if (window.innerWidth <= 900) {
                    return 2;
                }
                return 3;
            }

            function createDots() {
                dotsWrap.innerHTML = "";
                var pages = cards.length - getVisibleCards() + 1;
                for (var i = 0; i < pages; i++) {
                    var btn = document.createElement('button');
                    btn.className = "srv-dot";
                    if (i == 0) {
                        btn.classList.add('active');
                    }

                    btn.setAttribute('data-index', i);
                    btn.onclick = function () {
                        goTo(parseInt(this.getAttribute('data-index')));
                    };
                    dotsWrap.appendChild(btn);
                }
            }

            function updateDots() {
                var dots = dotsWrap.getElementsByClassName('srv-dot');
                for (var i = 0; i < dots.length; i++) {
                    if (i == current) {
                        dots[i].classList.add('active');
                    } else {
                        dots[i].classList.remove('active');
                    }
                }
            }

            function goTo(index) {
                var pages = cards.length - getVisibleCards() + 1;
                if (index < 0) {
                    index = 0;
                }
                if (index > pages - 1) {
                    index = pages - 1;
                }
                current = index;
                var cardWidth = cards[0].offsetWidth + 18;
                track.style.transform = 'translateX(-' + (current * cardWidth) + 'px)';
                updateDots();
            }

            prevBtn.onclick = function () {
                goTo(current - 1);
                resetAuto();
            };

            nextBtn.onclick = function () {
                goTo(current + 1);
                resetAuto();
            };

            function startAuto() {
                autoTimer = setInterval(function () {
                    var pages = cards.length - getVisibleCards() + 1;
                    if (current >= pages - 1) {
                        goTo(0);
                    } else {
                        goTo(current + 1);
                    }
                }, 3500);
            }

            function resetAuto() {
                clearInterval(autoTimer);
                startAuto();
            }

            var startX = 0;

            outer.addEventListener('touchstart', function (e) {
                startX = e.touches[0].clientX;

            });

            outer.addEventListener('touchend', function (e) {
                var endX = e.changedTouches[0].clientX;
                var diff = startX - endX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) {
                        goTo(current + 1);
                    } else {
                        goTo(current - 1);
                    }
                    resetAuto();
                }
            });

            createDots();
            goTo(0);
            startAuto();

            window.addEventListener('resize', function () {
                createDots();
                goTo(0);
            });
        }

        function featureSlider() {
            var track = document.getElementById('srvTrack1');
            var outer = document.getElementById('srvSliderOuter1');
            var prevBtn = document.getElementById('srvPrev1');
            var nextBtn = document.getElementById('srvNext1');
            var dotsWrap = document.getElementById('srvDots1');
            var cards = track.getElementsByClassName('srv-card');

            var current = 0;
            var autoTimer;

            function getVisibleCards() {
                if (window.innerWidth <= 560) {
                    return 1;
                }

                if (window.innerWidth <= 900) {
                    return 2;
                }
                return 3;
            }

            function createDots() {
                dotsWrap.innerHTML = "";
                var pages = cards.length - getVisibleCards() + 1;
                for (var i = 0; i < pages; i++) {
                    var btn = document.createElement('button');
                    btn.className = "srv-dot";
                    if (i == 0) {
                        btn.classList.add('active');
                    }

                    btn.setAttribute('data-index', i);
                    btn.onclick = function () {
                        goTo(parseInt(this.getAttribute('data-index')));
                    };
                    dotsWrap.appendChild(btn);
                }
            }

            function updateDots() {
                var dots = dotsWrap.getElementsByClassName('srv-dot');
                for (var i = 0; i < dots.length; i++) {
                    if (i == current) {
                        dots[i].classList.add('active');
                    } else {
                        dots[i].classList.remove('active');
                    }
                }
            }

            function goTo(index) {
                var pages = cards.length - getVisibleCards() + 1;
                if (index < 0) {
                    index = 0;
                }
                if (index > pages - 1) {
                    index = pages - 1;
                }
                current = index;
                var cardWidth = cards[0].offsetWidth + 18;
                track.style.transform = 'translateX(-' + (current * cardWidth) + 'px)';
                updateDots();
            }

            prevBtn.onclick = function () {
                goTo(current - 1);
                resetAuto();
            };

            nextBtn.onclick = function () {
                goTo(current + 1);
                resetAuto();
            };

            function startAuto() {
                autoTimer = setInterval(function () {
                    var pages = cards.length - getVisibleCards() + 1;
                    if (current >= pages - 1) {
                        goTo(0);
                    } else {
                        goTo(current + 1);
                    }
                }, 3500);
            }

            function resetAuto() {
                clearInterval(autoTimer);
                startAuto();
            }

            var startX = 0;

            outer.addEventListener('touchstart', function (e) {
                startX = e.touches[0].clientX;

            });

            outer.addEventListener('touchend', function (e) {
                var endX = e.changedTouches[0].clientX;
                var diff = startX - endX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) {
                        goTo(current + 1);
                    } else {
                        goTo(current - 1);
                    }
                    resetAuto();
                }
            });

            createDots();
            goTo(0);
            startAuto();

            window.addEventListener('resize', function () {
                createDots();
                goTo(0);
            });
        }
    </script>
@endsection



