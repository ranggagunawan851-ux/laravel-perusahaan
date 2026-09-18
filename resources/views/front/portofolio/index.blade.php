@extends('front.layout.template')

@section('title', 'Portofolio - Nexus Craft')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Our Works & Portofolio</h1>
        <p class="text-muted fs-5">Kumpulan hasil pengerjaan proyek terbaik kami</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('src') }}" method="POST">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" name="keyword" placeholder="Search portofolios..." value="{{ $keyword ?? '' }}" />
                <button class="btn btn-primary" id="button-search" type="submit">Submit</button>
            </div>
        </form>
    </div>

    @if (!empty($keyword))
    <div class="mb-3">
        <p class="d-inline-block me-2">Showing portofolios with keyword : <b>{{ $keyword }}</b></p>
        <a href="{{ url('portofolios') }}" class="btn btn-secondary btn-sm">Reset</a>
    </div>
    @endif

    <!-- Grid Portofolio -->
    <div class="row g-4">
        @forelse ($portofolios as $portofolio)
            <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-down">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                    <!-- Cover Image / Gambar Utama -->
                    <div class="position-relative">
                        @if($portofolio->images && $portofolio->images->count() > 0)
                            <img src="{{ asset('storage/portofolio/' . $portofolio->images->first()->image_path) }}"
                                 alt="{{ $portofolio->title }}"
                                 class="card-img-top"
                                 style="height: 240px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 240px;">
                                No Image
                            </div>
                        @endif

                        <!-- Indikator Jumlah Foto -->
                        <span class="position-absolute top-0 end-0 bg-dark bg-opacity-75 text-white badge m-3 px-3 py-2 rounded-pill">
                            <i class="fa-solid fa-camera me-1"></i> {{ $portofolio->images ? $portofolio->images->count() : 0 }} Photos
                        </span>
                    </div>

                    <!-- Body Card -->
                    <div class="card-body p-4 d-flex flex-column">
                        <!-- Kategori (Kiri) & Tanggal (Kanan) -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="{{ url('category/' . $portofolio->category->slug) }}" class="text-primary text-decoration-none fw-semibold small">
                                {{ $portofolio->category->name }}
                            </a>
                            <small class="text-muted" style="font-size: 0.8rem;">
                                <i class="fa-regular fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($portofolio->publish_date)->format('d M Y') }}
                            </small>
                        </div>

                        <h5 class="card-title fw-bold text-dark mb-2">{{ $portofolio->title }}</h5>
                        <p class="text-muted small mb-3">
                            <i class="fa-regular fa-user me-1"></i> Client: <strong>{{ $portofolio->client ?? 'N/A' }}</strong>
                        </p>

                        <!-- Ringkasan Deskripsi -->
                        <div class="card-text text-secondary small mb-4 flex-grow-1">
                            {!! Str::limit(strip_tags($portofolio->desc), 100) !!}
                        </div>

                        <!-- Tombol Detail -->
                        <a href="{{ url('port/' . $portofolio->slug) }}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold mt-auto">
                            View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal Pop-up Galeri & Detail -->
            <div class="modal fade" id="modalPortofolio{{ $portofolio->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">{{ $portofolio->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Slider Foto (Carousel) -->
                            @if($portofolio->images && $portofolio->images->count() > 0)
                                <div id="carouselPortofolio{{ $portofolio->id }}" class="carousel slide mb-4" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-3">
                                        @foreach($portofolio->images as $key => $img)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/portofolio/' . $img->image_path) }}"
                                                     class="d-block w-100"
                                                     style="height: 400px; object-fit: cover;"
                                                     alt="Gallery Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($portofolio->images->count() > 1)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPortofolio{{ $portofolio->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPortofolio{{ $portofolio->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    @endif
                                </div>
                            @endif

                            <hr>

                            <!-- Konten Lengkap -->
                            <div class="portfolio-description">
                                {!! $portofolio->desc !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">Not found</h4>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $portofolios->links() }}
    </div>
</div>
@endsection
