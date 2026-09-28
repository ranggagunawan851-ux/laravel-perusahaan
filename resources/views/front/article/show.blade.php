@extends('front.layout.template')

@section('title', $article->title . ' - Perusahaan')

@push('css')
<style>
    /* Typography & Article Title Styling */
    .article-title {
        color: #0f172a;
        font-weight: 800;
        line-height: 1.3;
        letter-spacing: -0.02em;
    }

    /* Vibrant Gradient Accent Border */
    .card-article-detail {
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        background: #ffffff;
        position: relative;
    }

    .card-article-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%);
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    /* Single Image Wrapper & Hover Zoom */
    .single-img-wrapper {
        overflow: hidden;
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .single-img-wrapper img {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .single-img-wrapper:hover img {
        transform: scale(1.03);
    }

    /* Custom Category Pill Badge */
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

    /* Article Body Styling */
    .article-content {
        color: #334155;
        font-size: 1.08rem;
        line-height: 1.8;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }

    .article-content blockquote {
        border-left: 4px solid #06b6d4;
        padding-left: 1.25rem;
        font-style: italic;
        color: #475569;
        background: rgba(6, 182, 212, 0.05);
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    /* Action Buttons */
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

</style>
@endpush

@section('content')

<!-- Page content-->
<div class="container py-4">
    <div class="row">
        {{-- Main Article Section --}}
        <div class="col-lg-8" data-aos="fade-up">
            <div class="card mb-4 shadow-sm border-0 rounded-3 overflow-hidden card-article-detail">

                <div class="card-body p-4 p-md-5">

                    {{-- Metadata Header --}}
                    <div class="d-flex align-items-center flex-wrap gap-2 small text-muted mb-3">
                        <span class="d-flex align-items-center fw-medium">
                            <i class="bi bi-calendar3 me-1 text-primary"></i>
                            {{ \Carbon\Carbon::parse($article->publish_date)->format('d M Y') }}
                        </span>
                        <span>•</span>
                        <a href="{{ url('category/'.$article->Category->slug)}}"
                            class="badge badge-category-cyan text-decoration-none rounded-pill px-3 py-1 fw-semibold">
                            {{ $article->Category->name }}
                        </a>
                        <span>•</span>
                        <span class="d-flex align-items-center fw-medium">
                            <i class="bi bi-eye me-1 text-info"></i> {{ $article->views }}x dilihat
                        </span>
                    </div>

                    {{-- Judul Artikel --}}
                    <h1 class="card-title article-title display-6 mb-4">{{ $article->title }}</h1>

                    {{-- Gambar Utama Artikel --}}
                    <div class="single-img-wrapper mb-4">
                        <a href="{{ url('p/'.$article->slug) }}">
                            <img class="card-img-top single-img" src="{{ asset('storage/back/'.$article->img) }}"
                                alt="{{ $article->title }}" />
                        </a>
                    </div>

                    {{-- Isi Konten Artikel --}}
                    <div class="card-text article-content mt-4">
                        {!! $article->desc !!}
                    </div>

                    <hr class="my-5 style-two" style="border-top: 1px dashed #cbd5e1;">

                    {{-- Bottom Action Bar --}}
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                        <a href="{{ url('articles') }}"
                            class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold align-self-stretch align-self-sm-auto text-center">
                            <i class="bi bi-arrow-left me-1"></i> Back to Articles
                        </a>

                        <div class="d-flex align-items-center gap-2">
                            <span class="small fw-bold text-muted me-1">Send:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="btn btn-sm btn-light border text-primary rounded-circle p-2 d-flex align-items-center justify-content-center"
                                style="width: 38px; height: 38px;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . url()->current()) }}"
                                target="_blank"
                                class="btn btn-sm btn-light border text-success rounded-circle p-2 d-flex align-items-center justify-content-center"
                                style="width: 38px; height: 38px;">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="btn btn-sm btn-light border text-info rounded-circle p-2 d-flex align-items-center justify-content-center"
                                style="width: 38px; height: 38px;">
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
