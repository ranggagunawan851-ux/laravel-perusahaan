@extends('front.layout.template')

@section('title', $portofolio->title . ' - Perusahaan')

@push('css')
<style>
    /* Card Container Utama */
    .article-style-card {
        background: #ffffff;
        border-radius: 1.5rem;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.05) !important;
        overflow: hidden;
    }

    /* Badges & Meta */
    .meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.9rem;
        border-radius: 50rem;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    .chip-category {
        background: rgba(6, 182, 212, 0.12);
        color: #0284c7;
    }
    .chip-category a {
        color: #0284c7;
        text-decoration: none;
    }
    .chip-date {
        background: #f1f5f9;
        color: #64748b;
    }

    /* Judul Utama */
    .article-hero-title {
        color: #0f172a;
        font-weight: 800;
        font-size: 2.1rem;
        line-height: 1.25;
        letter-spacing: -0.02em;
    }

    /* Frame Gambar Utama */
    .hero-image-wrapper {
        position: relative;
        border-radius: 1.25rem;
        overflow: hidden;
        background: #0f172a;
    }
    .hero-image-wrapper img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    .hero-image-wrapper:hover img {
        transform: scale(1.02);
    }

    /* Galeri Grid */
    .gallery-grid-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        padding: 1.25rem;
    }
    .gallery-thumb-item {
        position: relative;
        height: 140px;
        border-radius: 0.875rem;
        overflow: hidden;
        border: 2px solid #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }
    .gallery-thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.35s ease;
    }
    .gallery-thumb-item:hover img {
        transform: scale(1.1);
        filter: brightness(0.9);
    }

    /* Project Summary Box */
    .project-info-card {
        background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.25rem;
    }
    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        font-weight: 700;
        margin-bottom: 0.15rem;
    }
    .info-value {
        font-size: 0.95rem;
        color: #0f172a;
        font-weight: 600;
    }

    /* Content Styling */
    .article-body-content {
        color: #334155;
        font-size: 1.05rem;
        line-height: 1.85;
    }
    .article-body-content p {
        margin-bottom: 1.25rem;
    }

    /* Divider Accent */
    .gradient-divider {
        height: 3px;
        background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 50%, rgba(255,255,255,0) 100%);
        border-radius: 2px;
        margin: 1.75rem 0;
    }
</style>
@endpush

@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8" data-aos="fade-up">
            <div class="card article-style-card mb-4">
                <div class="card-body p-4 p-md-5">

                    <!-- 1. JUDUL UTAMA -->
                    <h1 class="article-hero-title mb-4">{{ $portofolio->title }}</h1>

                    <!-- 2. FOTO UTAMA (HERO IMAGE) -->
                    <div class="hero-image-wrapper mb-4 shadow-sm">
                        <img src="{{ asset('storage/portofolio/' . $portofolio->img) }}"
                             alt="{{ $portofolio->title }}">
                    </div>

                    <!-- 3. PROJECT INFO SUMMARY BOX -->
                    <div class="project-info-card mb-4">
                        <div class="row g-3">
                            <div class="col-6 col-md-4">
                                <div class="info-label"><i class="fa-regular fa-user me-1"></i> Client</div>
                                <div class="info-value">{{ $portofolio->client ?? 'Internal Project' }}</div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="info-label"><i class="fa-regular fa-folder me-1"></i> Category</div>
                                <div class="info-value">{{ $portofolio->Category->name ?? '-' }}</div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="info-label"><i class="fa-regular fa-clock me-1"></i> Publish Date</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($portofolio->publish_date)->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. GALERI TAMBAHAN (GRID) -->
                    @if($portofolio->images && $portofolio->images->count() > 0)
                        <div class="gallery-grid-wrapper mb-4">
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="fa-solid fa-images text-cyan me-2"></i>Documentation & Project Gallery
                            </h6>
                            <div class="row g-2">
                                @foreach($portofolio->images as $item)
                                    <div class="col-6 col-sm-4">
                                        <div class="gallery-thumb-item">
                                            <a href="{{ asset('storage/portofolio/' . $item->image_path) }}" target="_blank">
                                                <img src="{{ asset('storage/portofolio/' . $item->image_path) }}"
                                                     alt="Galeri {{ $portofolio->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="gradient-divider"></div>

                    <!-- 5. DESKRIPSI PORTOFOLIO -->
                    <div class="article-body-content">
                        {!! $portofolio->desc !!}
                    </div>

                    <!-- 6. BOTTOM ACTION BAR -->
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mt-4">
                        <a href="{{ url('portofolios') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold align-self-stretch align-self-sm-auto text-center">
                            <i class="bi bi-arrow-left me-1"></i> Back to Portofolios
                        </a>

                        <div class="d-flex align-items-center gap-2">
                            <span class="small fw-bold text-muted me-1">Send:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-light border text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($portofolio->title . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-light border text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($portofolio->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-light border text-info rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-twitter"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Side widgets-->
        @include('front.layout.side-widget')
    </div>
</div>

@endsection
