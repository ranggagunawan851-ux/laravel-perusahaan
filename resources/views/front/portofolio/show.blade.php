@extends('front.layout.template')

@section('title', $portofolio->title . ' - Perusahaan')

@section('content')

<!-- Page content-->
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8" data-aos="fade-up">
            <div class="card mb-4 shadow-sm border-0">

                <!-- GALERI FOTO KATALOG / GRID -->
                <div class="p-3 bg-light rounded">

                    <!-- 1. Foto Utama (Besar) -->
                    <div class="mb-3 text-center">
                        <img src="{{ asset('storage/portofolio/' . $portofolio->img) }}"
                             class="img-fluid rounded shadow-sm w-100"
                             style="max-height: 480px; object-fit: cover;"
                             alt="{{ $portofolio->title }}">
                    </div>

                    <!-- 2. Foto-Foto Tambahan (Grid Galeri 3 Kolom) -->
                    @if($portofolio->images && $portofolio->images->count() > 0)
                        <div class="row g-2">
                            @foreach($portofolio->images as $item)
                                <div class="col-6 col-md-4">
                                    <div class="overflow-hidden rounded shadow-sm" style="height: 180px;">
                                        <a href="{{ asset('storage/portofolio/' . $item->image_path) }}" target="_blank">
                                            <img src="{{ asset('storage/portofolio/' . $item->image_path) }}"
                                                 class="w-100 h-100 img-hover-zoom"
                                                 style="object-fit: cover; transition: transform 0.3s ease;"
                                                 alt="Galeri {{ $portofolio->title }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

                <!-- Detail Deskripsi Portofolio -->
                <div class="card-body">
                    <div class="small text-muted mb-2">
                        <span><i class="far fa-calendar-alt"></i> {{ $portofolio->created_at->format('d-m-Y') }} |</span>
                        @if($portofolio->Category)
                            <span class="ms-1">
                                <a href="{{ url('category/'.$portofolio->Category->slug) }}" class="text-decoration-none">{{ $portofolio->Category->name }}</a> |
                            </span>
                        @endif
                        @if(isset($portofolio->client))
                            <span class="ms-1"><i class="far fa-user"></i> {{ $portofolio->client }}</span>
                        @endif
                    </div>

                    <h2 class="card-title fw-bold text-dark">{{ $portofolio->title }}</h2>
                    <hr>
                    <div class="card-text mt-3">
                        {!! $portofolio->desc !!}
                    </div>
                </div>

            </div>
        </div>

        <!-- Side widgets-->
        @include('front.layout.side-widget')
    </div>
</div>

<!-- Efek CSS Hover Zoom untuk Galeri -->
<style>
    .img-hover-zoom:hover {
        transform: scale(1.05);
    }
</style>

@endsection
