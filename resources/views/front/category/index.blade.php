@extends('front.layout.template')

@section('title', 'Category: ' . $category->name . ' - Nexus Craft')

@push('css')
<style>
    /* Styling Header Kategori */
    .category-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border: 1px solid rgba(6, 182, 212, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .text-gradient-cyan {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-gradient-gold {
        background: linear-gradient(135deg, #f59e0b 0%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Card Styling & Hover Animation */
    .card-colorful {
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .card-colorful:hover {
        transform: translateY(-5px);
        border-color: #06b6d4 !important;
        box-shadow: 0 15px 30px rgba(6, 182, 212, 0.12) !important;
    }

    /* Container Gambar & Effect Scale */
    .post-img-container {
        overflow: hidden;
        border-radius: 1rem 0 0 1rem;
        position: relative;
    }

    @media (max-width: 767.98px) {
        .post-img-container {
            border-radius: 1rem 1rem 0 0;
        }
    }

    .post-img-container img {
        transition: transform 0.5s ease;
    }

    .card-colorful:hover .post-img-container img {
        transform: scale(1.08);
    }

    /* Custom Buttons */
    .btn-gradient-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        color: #ffffff !important;
        border: none;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        transition: all 0.3s ease;
    }

    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(59, 130, 246, 0.5);
    }

    .badge-category {
        background: linear-gradient(135deg, rgba(6, 182, 212, 0.15) 0%, rgba(59, 130, 246, 0.15) 100%);
        color: #0284c7;
        border: 1px solid rgba(6, 182, 212, 0.3);
        font-weight: 600;
        letter-spacing: 0.5px;
    }
</style>
@endpush

@section('content')
<div class="container py-5">

    <!-- Header Kategori -->
    <div class="row mb-5">
        <div class="col-12" data-aos="fade-down">
            <div class="category-hero p-4 p-md-5 rounded-4 text-center position-relative overflow-hidden">
                <div class="position-relative z-1">
                    <span class="badge badge-category px-3 py-2 rounded-pill text-uppercase mb-3">
                        <i class="bi bi-folder2-open me-1"></i> Category Focus
                    </span>
                    <h1 class="display-5 fw-bold text-gradient-cyan mb-2">{{ $category->name }}</h1>
                    <p class="text-light opacity-75 fs-5 mb-0 mx-auto" style="max-width: 600px;">
                        Discover all curated articles, insights, and updates related to <strong>{{ $category->name }}</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="row g-4">
        <!-- Daftar Artikel Kategori -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="row g-4">
                @forelse ($articles as $item)
                <div class="col-12">
                    <div class="card shadow-sm border-0 card-colorful">
                        <div class="row g-0 align-items-stretch">
                            <!-- Image Section -->
                            <div class="col-md-5 post-img-container">
                                <a href="{{ url('p/'.$item->slug) }}" class="d-block h-100">
                                    <img src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}"
                                        class="w-100 h-100" style="object-fit: cover; min-height: 200px;">
                                </a>
                            </div>

                            <!-- Content Section -->
                            <div class="col-md-7">
                                <div class="card-body p-4 d-flex flex-column h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge badge-category rounded-pill px-2.5 py-1 small">
                                            {{ $category->name }}
                                        </span>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($item->publish_date ?? $item->created_at)->format('d M Y') }}
                                        </small>
                                    </div>

                                    <h4 class="card-title fw-bold mb-2">
                                        <a href="{{ url('p/'.$item->slug) }}" class="text-dark text-decoration-none lh-sm">
                                            {{ $item->title }}
                                        </a>
                                    </h4>

                                    <p class="card-text text-muted small flex-grow-1 mb-3">
                                        {{ Str::limit(strip_tags($item->desc), 110, '...') }}
                                    </p>

                                    <div>
                                        <a href="{{ url('p/'.$item->slug) }}" class="btn btn-gradient-primary btn-sm px-3 rounded-3 fw-semibold">
                                            Read Full Article <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 rounded-4 bg-light border border-dashed">
                        <i class="bi bi-journal-x display-3 text-muted d-block mb-3"></i>
                        <h4 class="fw-bold text-secondary">No Articles Found</h4>
                        <p class="text-muted">There are no published articles under this category yet.</p>
                        <a href="{{ url('/') }}" class="btn btn-gradient-primary rounded-pill px-4 mt-2">
                            <i class="bi bi-house me-1"></i> Back to Home
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Custom Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- Sidebar Widget -->
        @include('front.layout.side-widget')
    </div>
</div>
@endsection
