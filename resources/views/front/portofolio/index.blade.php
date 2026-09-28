@extends('front.layout.template')

@section('title', 'Portofolio - Nexus Craft')

@push('css')
<style>
    /* Typography & Palette Gradient */
    .text-gradient-cyan {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Vibrant Buttons */
    .btn-gradient-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        color: #fff !important;
        border: none;
        box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
        transition: all 0.3s ease;
    }
    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    }

    /* Search Bar Styling */
    .search-input-group input {
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    .search-input-group input:focus {
        border-color: #06b6d4 !important;
        box-shadow: 0 0 12px rgba(6, 182, 212, 0.25) !important;
    }

    /* Portfolio Card Styling */
    .card-portfolio-modern {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        background: #ffffff;
    }
    .card-portfolio-modern:hover {
        transform: translateY(-8px);
        border-color: #06b6d4 !important;
        box-shadow: 0 20px 35px rgba(6, 182, 212, 0.15) !important;
    }

    /* Image Wrapper & Zoom Effect */
    .portfolio-img-wrapper {
        overflow: hidden;
        position: relative;
    }
    .portfolio-img-wrapper img {
        transition: transform 0.5s ease;
        height: 240px;
        object-fit: cover;
        width: 100%;
    }
    .card-portfolio-modern:hover .portfolio-img-wrapper img {
        transform: scale(1.08);
    }

    /* Badges & Text Styling */
    .badge-category-cyan {
        background: rgba(6, 182, 212, 0.12);
        color: #0284c7;
        border: 1px solid rgba(6, 182, 212, 0.3);
        transition: all 0.2s ease;
    }
    .badge-category-cyan:hover {
        background: #06b6d4;
        color: #ffffff !important;
    }
    .badge-glass-dark {
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Modal Glass Overlay */
    .modal-content-glass {
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>
@endpush

@section('content')
<div class="container py-5">

    <!-- Header Section -->
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold display-5 text-gradient-cyan mb-2">Our Works & Portfolios</h1>
        <p class="text-muted fs-5">A collection of our finest project deliverables</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-4 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('src') }}" method="POST">
            @csrf
            <div class="input-group search-input-group shadow-sm rounded-3 overflow-hidden">
                <input class="form-control py-3 px-4 border-0" type="text" name="keyword" placeholder="Search portfolios..." value="{{ $keyword ?? '' }}" />
                <button class="btn btn-gradient-primary px-4 fw-semibold" id="button-search" type="submit">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                </button>
            </div>
        </form>
    </div>

    <!-- Notifikasi Keyword Search -->
    @if (!empty($keyword))
    <div class="d-flex align-items-center justify-content-between p-3 mb-4 rounded-3 shadow-sm mx-auto" style="max-width: 700px; background: rgba(6, 182, 212, 0.08); border-left: 4px solid #06b6d4;" data-aos="fade-in">
        <p class="m-0 text-dark">Showing portfolios with keyword: <b class="text-primary">{{ $keyword }}</b></p>
        <a href="{{ url('portofolios') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="fa-solid fa-xmark me-1"></i> Reset
        </a>
    </div>
    @endif

    <!-- Grid Portfolio -->
    <div class="row g-4">
        @forelse ($portofolios as $portofolio)
            <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index % 3) }}">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-portfolio-modern">

                    <!-- Cover Image / Gambar Utama -->
                    <div class="portfolio-img-wrapper position-relative">
                        @if($portofolio->images && $portofolio->images->count() > 0)
                            <img src="{{ asset('storage/portofolio/' . $portofolio->images->first()->image_path) }}"
                                 alt="{{ $portofolio->title }}"
                                 class="card-img-top">
                        @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center flex-column" style="height: 240px;">
                                <i class="fa-regular fa-image display-4 mb-2 opacity-50"></i>
                                <span>No Image Available</span>
                            </div>
                        @endif

                        <!-- Indikator Jumlah Foto -->
                        <span class="position-absolute top-0 end-0 badge badge-glass-dark text-white m-3 px-3 py-2 rounded-pill shadow-sm">
                            <i class="fa-solid fa-camera me-1 text-cyan"></i> {{ $portofolio->images ? $portofolio->images->count() : 0 }} Photos
                        </span>
                    </div>

                    <!-- Body Card -->
                    <div class="card-body p-4 d-flex flex-column">

                        <!-- Kategori (Kiri) & Tanggal (Kanan) -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ url('category/' . $portofolio->category->slug) }}" class="badge badge-category-cyan text-decoration-none rounded-pill px-3 py-1 fw-semibold">
                                {{ $portofolio->category->name }}
                            </a>
                            <small class="text-muted" style="font-size: 0.8rem;">
                                <i class="bi bi-calendar3 me-1 text-primary"></i>
                                {{ \Carbon\Carbon::parse($portofolio->publish_date)->format('d M Y') }}
                            </small>
                        </div>

                        <!-- Title & Client -->
                        <h5 class="card-title fw-bold text-dark mb-2">{{ $portofolio->title }}</h5>
                        <p class="text-muted small mb-3">
                            <i class="fa-regular fa-user me-1 text-info"></i> Client: <strong class="text-dark">{{ $portofolio->client ?? 'N/A' }}</strong>
                        </p>

                        <!-- Ringkasan Deskripsi -->
                        <div class="card-text text-secondary small mb-4 flex-grow-1 lh-base">
                            {!! Str::limit(strip_tags($portofolio->desc), 110) !!}
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ url('port/' . $portofolio->slug) }}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold">
                                View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                            <button type="button" class="btn btn-light border rounded-circle p-2 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modalPortofolio{{ $portofolio->id }}" title="Quick Gallery View" style="width: 42px; height: 42px;">
                                <i class="fa-solid fa-expand text-muted"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Pop-up Galeri & Detail -->
            <div class="modal fade" id="modalPortofolio{{ $portofolio->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content modal-content-glass rounded-4 border-0">
                        <div class="modal-header border-0 pb-0 p-4">
                            <div>
                                <h5 class="modal-title fw-bold text-dark">{{ $portofolio->title }}</h5>
                                <small class="text-muted"><i class="fa-regular fa-user me-1"></i> Client: {{ $portofolio->client ?? 'N/A' }}</small>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Slider Foto (Carousel) -->
                            @if($portofolio->images && $portofolio->images->count() > 0)
                                <div id="carouselPortofolio{{ $portofolio->id }}" class="carousel slide mb-4 shadow-sm rounded-3 overflow-hidden" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($portofolio->images as $key => $img)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/portofolio/' . $img->image_path) }}"
                                                     class="d-block w-100"
                                                     style="height: 420px; object-fit: cover;"
                                                     alt="Gallery Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($portofolio->images->count() > 1)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPortofolio{{ $portofolio->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon p-3 bg-dark bg-opacity-50 rounded-circle" aria-hidden="true"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPortofolio{{ $portofolio->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon p-3 bg-dark bg-opacity-50 rounded-circle" aria-hidden="true"></span>
                                        </button>
                                    @endif
                                </div>
                            @endif

                            <hr class="my-4" style="border-top: 1px dashed #cbd5e1;">

                            <!-- Konten Lengkap -->
                            <div class="portfolio-description text-secondary lh-lg">
                                {!! $portofolio->desc !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="p-5 rounded-4 shadow-sm mx-auto" style="max-width: 600px; background: #f8fafc; border: 2px dashed #cbd5e1;">
                    <i class="bi bi-folder-x display-3 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold text-secondary">Portofolio Not Found</h4>
                    <p class="text-muted">Sorry, no portofolio matched your search.</p>
                    <a href="{{ url('portofolios') }}" class="btn btn-gradient-primary rounded-pill px-4 mt-2">Views All Portofolio</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $portofolios->links() }}
    </div>
</div>
@endsection
