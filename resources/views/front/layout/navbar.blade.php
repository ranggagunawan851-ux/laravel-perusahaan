<nav class="navbar navbar-expand-lg navbar-dark bg-navbar-luxury sticky-top shadow-lg">
    <div class="container py-1">
        {{-- Brand Logo --}}
        <a class="navbar-brand d-flex align-items-center gap-2 brand-hover" href="{{ url('/') }}">
            <div class="logo-wrapper">
                <img src="{{ asset('front/img/craft.png') }}" alt="Logo Nexus Craft" height="34" class="d-inline-block align-text-top logo-img">
            </div>
            <span class="brand-text">Nexus<span class="brand-text-accent">Craft</span></span>
        </a>

        {{-- Toggler Button --}}
        <button class="navbar-toggler border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Nav Items --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link nav-link-luxury {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-luxury {{ Request::is('articles*') ? 'active' : '' }}" href="{{ url('/articles') }}">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-luxury {{ Request::is('portofolios*') ? 'active' : '' }}" href="{{ url('/portofolios') }}">Portofolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-luxury {{ Request::is('services*') ? 'active' : '' }}" href="{{ url('/services') }}">Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-luxury {{ Request::is('about*') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-warning btn-sm rounded-pill px-3 ms-2" href="{{ route('front.consultation.track') }}">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Track Status
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('css')
<style>
    /* Gradient Background Mewah + Blur Effect */
    .bg-navbar-luxury {
        background: linear-gradient(135deg, #0b132b 0%, #1c2541 50%, #0f172a 100%) !important;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* Brand Logo Text Styling */
    .brand-text {
        font-weight: 800;
        font-size: 1.35rem;
        letter-spacing: 0.5px;
        color: #ffffff;
        transition: all 0.3s ease;
    }

    .brand-text-accent {
        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .brand-hover:hover .logo-img {
        transform: scale(1.08) rotate(-3deg);
        filter: drop-shadow(0 0 8px rgba(6, 182, 212, 0.6));
    }

    .logo-img {
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    /* Menu Link Text Styling */
    .nav-link-luxury {
        color: rgba(241, 245, 249, 0.82) !important;
        font-weight: 500;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
        padding: 8px 16px !important;
        border-radius: 20px;
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hover Effect Text & Glow */
    .nav-link-luxury:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.06);
        text-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
        transform: translateY(-1px);
    }

    /* Active State (Halaman Aktif Otomatis) */
    .nav-link-luxury.active {
        color: #ffffff !important;
        font-weight: 600;
        background: linear-gradient(135deg, rgba(6, 182, 212, 0.2) 0%, rgba(59, 130, 246, 0.2) 100%);
        border: 1px solid rgba(6, 182, 212, 0.35);
        box-shadow: 0 4px 15px rgba(6, 182, 212, 0.15);
    }

    /* Active Indicator Line di bawah teks */
    .nav-link-luxury.active::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        transform: translateX(-50%);
        width: 16px;
        height: 2px;
        background: #06b6d4;
        border-radius: 2px;
        box-shadow: 0 0 8px #06b6d4;
    }
</style>
@endpush
