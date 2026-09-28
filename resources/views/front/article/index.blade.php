@extends('front.layout.template')

@section('title', 'Our Services - Nexus Craft')

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

    /* Card Service Colorful Styling */
    .card-service-colorful {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        background: #ffffff;
    }
    .card-service-colorful:hover {
        transform: translateY(-6px);
        border-color: #06b6d4 !important;
        box-shadow: 0 15px 30px rgba(6, 182, 212, 0.15) !important;
    }

    /* Image Container Zoom Effect */
    .img-zoom-wrapper {
        overflow: hidden;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }
    .img-zoom-wrapper img {
        transition: transform 0.5s ease;
        height: 220px;
        object-fit: cover;
        width: 100%;
    }
    .card-service-colorful:hover .img-zoom-wrapper img {
        transform: scale(1.08);
    }

    /* Hover Cyan Link */
    .hover-cyan {
        transition: color 0.2s ease;
    }
    .hover-cyan:hover {
        color: #06b6d4 !important;
    }
</style>
@endpush

@section('content')

<!-- Page content-->
<div class="container py-5">

    <!-- Header Section -->
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold display-5 text-gradient-cyan mb-2">Our Professional Services</h1>
        <p class="text-muted fs-5">Tailored solutions and high-quality services crafted for your needs</p>
    </div>

    <!-- Form Pencarian Service -->
    <div class="mb-4 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('service.search') }}" method="POST">
            @csrf
            <div class="input-group search-input-group shadow-sm rounded-3 overflow-hidden">
                <input class="form-control py-3 px-4 border-0" type="text" name="keyword" placeholder="Search Service..." value="{{ $keyword ?? '' }}" />
                <button class="btn btn-gradient-primary px-4 fw-semibold" id="button-search" type="submit">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                </button>
            </div>
        </form>
    </div>

    <!-- Notifikasi Keyword Search -->
    @if (!empty($keyword))
    <div class="d-flex align-items-center justify-content-between p-3 mb-4 rounded-3 shadow-sm mx-auto" style="max-width: 700px; background: rgba(6, 182, 212, 0.08); border-left: 4px solid #06b6d4;" data-aos="fade-in">
        <p class="m-0 text-dark">Search results for: <b class="text-primary">{{ $keyword }}</b></p>
        <a href="{{ url('services') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-x-circle me-1"></i> Reset
        </a>
    </div>
    @endif

    <!-- Grid List Service -->
    <div class="row">
        @forelse ($services as $item)
        <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index % 3) }}">
            <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden card-service-colorful">

                {{-- Gambar Service --}}
                <a href="{{ url('service/'.$item->slug) }}" class="img-zoom-wrapper d-block">
                    <img class="card-img-top post-img img-fixed" src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}" />
                </a>

                {{-- Body Service --}}
                <div class="card-body d-flex flex-column p-4">

                    {{-- Judul Service --}}
                    <h2 class="card-title h5 fw-bold mb-3">
                        <a href="{{ url('service/'.$item->slug) }}" class="text-dark text-decoration-none hover-cyan">
                            {{ $item->title }}
                        </a>
                    </h2>

                    {{-- Deskripsi Ringkas Service --}}
                    <p class="card-text text-secondary small lh-base mb-4">
                        {{ Str::limit(strip_tags($item->desc), 160, '...') }}
                    </p>

                    {{-- Tombol Action / Detail --}}
                    <div class="mt-auto d-flex align-items-center justify-content-between pt-2 border-top">
                        <a class="btn btn-outline-primary btn-sm rounded-pill px-3 py-2 fw-semibold" href="{{ url('service/'.$item->slug) }}">
                            Learn More <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        @if(isset($item->price))
                        <span class="fw-bold text-gradient-cyan fs-6">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5" data-aos="fade-up">
            <div class="p-5 rounded-4 shadow-sm mx-auto" style="max-width: 600px; background: #f8fafc; border: 2px dashed #cbd5e1;">
                <i class="bi bi-gear-wide-connected display-3 text-muted mb-3 d-block"></i>
                <h3 class="fw-bold text-secondary">Service Not Found</h3>
                <p class="text-muted">Sorry, no service matched your criteria.</p>
                <a href="{{ url('services') }}" class="btn btn-gradient-primary rounded-pill px-4 mt-2">View All Services</a>
            </div>
        </div>
        @endforelse

        <!-- Pagination -->
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $services->links() }}
        </div>
    </div>

</div>
@endsection
