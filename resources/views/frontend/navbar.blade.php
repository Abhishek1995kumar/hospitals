<nav class="navbar">
    <a class="logo" href="#">
        <div class="logo-icon">{{ __('H')}}</div>
        <div class="logo-text">
        <div class="name">{{ __('HMS Medical') }}</div>
        <div class="sub">{{ __('10 YEARS EXPERIENCE') }}</div>
        </div>
    </a>
    <nav class="nav-links" id="navLinks">
        <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">{{ __('Home')}}</a>
        <a class="{{ request()->is('doctors') ? 'active' : '' }}" href="{{ url('doctors') }}">{{ __('Doctors')}}</a>
        <div class="dropdown">
            <a class="dropdown-btn">{{ __('Services') }} ▾</a>
            <ul class="dropdown-menu">
                <li > <a class="{{ request()->is('consultation') ? 'active' : '' }}" href="{{ url('consultation') }}"> {{ __('Consultation')}} </a> </li>
                <li > <a class="{{ request()->is('pharmacy') ? 'active' : '' }}" href="{{ url('pharmacy') }}"> {{ __('Pharmacy')}} </a> </li>
                <li > <a class="{{ request()->is('laboratory') ? 'active' : '' }}" href="{{ url('laboratory') }}"> {{ __('Laboratory')}} </a> </li>
                <li > <a class="{{ request()->is('emergency') ? 'active' : '' }}" href="{{ url('emergency') }}"> {{ __('Emergency Care')}} </a> </li>
                <li > <a class="{{ request()->is('health-checkup') ? 'active' : '' }}" href="{{ url('health-checkup') }}"> {{ __('Health Checkup Packages')}} </a> </li>
                <li > <a class="{{ request()->is('ambulance') ? 'active' : '' }}" href="{{ url('ambulance') }}"> {{ __('Ambulance Service')}} </a> </li>
                <li > <a class="{{ request()->is('surgery') ? 'active' : '' }}" href="{{ url('surgery') }}"> {{ __('Surgery')}} </a> </li>
                <li > <a class="{{ request()->is('women_child_care') ? 'active' : '' }}" href="{{ url('women_child_care') }}"> {{ __('Women & Child Care')}} </a> </li>
                <li > <a class="{{ request()->is('diagnostic') ? 'active' : '' }}" href="{{ url('diagnostic') }}"> {{ __('Diagnostics')}} </a> </li>
                <li > <a class="{{ request()->is('wellness') ? 'active' : '' }}" href="{{ url('wellness') }}"> {{ __('Wellness')}} </a> </li>
                <li > <a class="{{ request()->is('home_care') ? 'active' : '' }}" href="{{ url('home_care') }}"> {{ __('Home Care')}} </a> </li>
                <li > <a class="{{ request()->is('telemedicine') ? 'active' : '' }}" href="{{ url('telemedicine') }}"> {{ __('Support')}} </a> </li>
            </ul>
        </div>

        <div class="dropdown">
            <a class="dropdown-btn">{{ __('Feature') }} ▾</a>
            <ul class="dropdown-menu">
                <li > <a class="{{ request()->is('appointments') ? 'active' : '' }}" href="{{ url('appointments') }}"> {{ __('Appointments')}} </a> </li>
                <li > <a class="{{ request()->is('working-hours') ? 'active' : '' }}" href="{{ url('working-hours') }}"> {{ __('Working Hours')}} </a> </li>
                <li > <a class="{{ request()->is('testimonials') ? 'active' : '' }}" href="{{ url('testimonials') }}"> {{ __('Testimonials')}} </a> </li>
                <li > <a class="{{ request()->is('terms-conditions') ? 'active' : '' }}" href="{{ url('terms-conditions') }}"> {{ __('Term & Conditions')}} </a> </li>
                <li > <a class="{{ request()->is('privacy-policy') ? 'active' : '' }}" href="{{ url('privacy-policy') }}"> {{ __('Privacy Policy')}} </a> </li>
            </ul>
        </div>
        <a class="{{ request()->is('about') ? 'active' : '' }}" href="{{ url('about') }}">{{ __('About')}}</a>
        <a class="{{ request()->is('contact') ? 'active' : '' }}" href="{{ url('contact') }}">{{ __('Contact')}}</a>
        <a class="{{ request()->is('blog') ? 'active' : '' }}" href="{{ url('blog') }}">{{ __('Blog')}}</a>
    </nav>
    <div class="nav-btns">
        <a class="btn-login" href="{{ route('login') }}">{{ __('Login')}}</a>
        <a class="btn-book" href="{{ route('appointment') }}">{{ __('Book Appointment')}}</a>
    </div>
    <button class="hamburger" id="hamburger" aria-label="Menu"> <span></span> <span></span> <span></span> </button>
</nav>


<script>
    // Toast function
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.className = `toast show ${type}`;
        setTimeout(() => { toast.className = toast.className.replace('show', ''); }, 3000);
    }
</script>

<script>
    const hamburger = document.getElementById('hamburger');
    const navLinks  = document.getElementById('navLinks');

    // Hamburger toggle
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        navLinks.classList.toggle('open');
    });

    // Dropdown toggle (mobile ke liye)
    document.querySelectorAll('.dropdown-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const dropdown = btn.closest('.dropdown');

            // Dusre dropdowns band karo
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('open');
                }
            });

            dropdown.classList.toggle('open');
        });
    });

    // Normal links pe menu band ho
    navLinks.querySelectorAll('a:not(.dropdown-btn)').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
            document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('open'));
        });
    });

    // Outside click pe sab band
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.navbar')) {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
            document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('open'));
        }
    });
</script>
