@extends('front.layout.template')

@section('title', 'Article Blog - Perusahaan')


@section('content')

<!-- Page content-->
<div class="container py-5">

    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Artikel & Wawasan</h1>
        <p class="text-muted fs-5">Kumpulan pemikiran, panduan, dan kabar terbaru dari industri kami</p>
    </div>

    <div class="mb-3">
        <form action="{{ route('search')}}" method="POST">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" name="keyword" placeholder="Search articles..." />
                <button class="btn btn-primary" id="button-search" type="submit">Submit</button>
            </div>
        </form>
    </div>

    @if ($keyword)
    <p>Showing articles with keyword : <b>{{ $keyword }}</b></p>
    <a href="{{ url('articles') }}" class="btn btn-secondary btn-sm mb-3">Reset</a>
    @endif

    <div class="row">
        @forelse ($articles as $item)
        <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="flip-down">
            <!-- Tambahkan class h-100 di card -->
            <div class="card h-100 shadow-sm">
                <a href="{{ url('p/'.$item->slug) }}">
                    <!-- Tambahkan class img-fixed agar tinggi gambar seragam -->
                    <img class="card-img-top post-img img-fixed" src="{{ asset('storage/back/'.$item->img) }}"
                        alt="..." />
                </a>
                <!-- Tambahkan d-flex flex-column di card-body -->
                <div class="card-body d-flex flex-column">
                    <div class="small text-muted">
                                <span class="ml-2">{{ $item->created_at->format('d-m-Y')}} | </span>
                                <span class="ml-2">
                                    <a href="{{ url('category/'.$item->Category->slug)}}">{{ $item->Category->name}}</a> |
                                </span>
                                <span class="ml-2">{{ $item->views}}x</span>
                            </div>
                    {{-- <div class="small text-muted">
                        {{ $item->created_at->format('d-m-Y')}}
                        <a href="{{ url('category/'.$item->Category->slug)}}">{{ $item->Category->name }}</a>
                    </div> --}}
                    <h2 class="card-title h4">{{ $item->title }}</h2>
                    <p class="card-text">
                        {{ Str::limit(strip_tags($item->desc), 200, '...') }}
                    </p>
                    <!-- Tambahkan mt-auto agar tombol terdorong ke paling bawah -->
                    <a class="btn btn-primary mt-auto align-self-start" href="{{ url('p/'.$item->slug) }}">Read more
                        →</a>
                </div>
            </div>
        </div>

        @empty
        <h3>Not found</h3>
        @endforelse

        {{ $articles->links() }}
    </div>

    @endsection
