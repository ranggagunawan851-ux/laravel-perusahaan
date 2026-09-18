@extends('front.layout.template')

@section('title', $service->nama_service . ' - Nexus Craft')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb Navigasi -->
    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/#service') }}" class="text-decoration-none">Our Services</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $service->nama_service }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Kolom Gambar & Deskripsi Utama -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="card border-0 shadow-sm overflow-hidden mb-4 rounded-3">
                @if ($service->img)
                    <img src="{{ asset('storage/service/' . $service->img) }}" alt="{{ $service->nama_service }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                @else
                    <div class="bg-secondary text-white text-center py-5">
                        <i class="bi bi-laptop display-1"></i>
                    </div>
                @endif
                <div class="card-body p-4">
                    <h2 class="fw-bold mb-3">{{ $service->nama_service }}</h2>
                    <h4 class="text-primary fw-bold mb-4">
                        Rp {{ number_format((float) $service->price, 0, ',', '.') }}
                    </h4>
                    <hr>
                    <div class="lh-lg text-secondary mt-4">
                        {!! $service->desc !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Widget Konsultasi -->
        <div class="col-lg-4" data-aos="fade-left">
            <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 100px; z-index: 10;">
                <h4 class="fw-bold mb-3">Interested in this Service?</h4>
                <p class="text-muted small mb-4">Get direct consultation with our experts for your project needs.</p>

                <a href="{{ url('/#consultation') }}" class="btn btn-primary btn-lg w-100 fw-bold text-dark rounded-3 shadow-sm mb-3">
                    <i class="bi bi-chat-dots me-1"></i> Consult Now
                </a>

                <a href="{{ url('/#service') }}" class="btn btn-outline-secondary w-100">
                    ← Back to Services
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
