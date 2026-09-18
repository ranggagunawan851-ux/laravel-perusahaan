@extends('front.layout.template')

@section('title', 'Beranda - Nexus Craft')

{{-- Menambahkan CDN CSS AOS jika belum ada di template utama --}}
@push('css')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush

@section('content')

{{-- <!-- Section Hero / Header Perusahaan -->
<section class="py-5 bg-primary text-white text-center mb-5 hero-section overflow-hidden">
    <div class="container" data-aos="zoom-in" data-aos-duration="1000">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-down" data-aos-delay="200">Nexus Craft</h1>
        <p class="lead mb-4 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="400">
            Arsitek ruang impian Anda. Menghadirkan harmoni antara estetika, fungsi, dan eksekusi konstruksi berkualitas.
        </p>
        <div data-aos="fade-up" data-aos-delay="600">
            <a href="#service" class="btn btn-outline-light btn-lg px-4 me-md-2">Lihat service</a>
            <a href="#konsultasi" class="btn btn-warning btn-lg px-4 fw-bold">Konsultasi Gratis</a>
        </div>
    </div>
</section> --}}

<!-- Section Hero / Header Perusahaan (Background Foto) -->
<section class="text-white text-center mb-5 hero-section overflow-hidden d-flex align-items-center position-relative"
    style="background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)),
                     url('{{ asset('front/img/nexus.png') }}') no-repeat center center/cover;
                min-height: 90vh; padding: 80px 0;">
    <div class="container py-4" data-aos="zoom-in" data-aos-duration="1000">
        <!-- Judul Lebih Besar & Gagah -->
        <h1 class="display-2 fw-extrabold mb-4 tracking-tight" data-aos="fade-down" data-aos-delay="200"
            style="letter-spacing: -1px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            Nexus Craft
        </h1>

        <!-- Deskripsi dengan Ukuran Pas & Jarak Elegan -->
        <p class="fs-4 fw-normal mb-5 mx-auto opacity-90"
            style="max-width: 850px; line-height: 1.6; text-shadow: 0 1px 5px rgba(0,0,0,0.3);" data-aos="fade-up"
            data-aos-delay="400">
            Architecting your dream space. Bringing harmony to aesthetics, functionality, and high-quality construction.
        </p>

        <!-- Tombol Aksi dengan Jarak & Ukuran Proporsional -->
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap" data-aos="fade-up"
            data-aos-delay="600">
            <a href="#service" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold rounded-3 shadow-sm">
                View Service
            </a>
            <a href="#consultation" class="btn btn-primary btn-lg px-4 py-3 fw-bold text-dark rounded-3 shadow-sm">
                Consultation Free
            </a>
        </div>
    </div>
</section>

<div class="container">
    <!-- Section Service -->
    <section id="service" class="mb-5">
        <div class="text-center mb-4" data-aos="fade-up" data-aos-duration="800">
            <h2 class="fw-bold">Our Service</h2>
            <p class="text-muted">Professional solutions we provide for you</p>
        </div>

        <div class="row g-4">
            @forelse ($services as $index => $item)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}" data-aos-duration="800">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body d-flex flex-column">

                        {{-- 1. Gambar Service (Bisa diklik menuju Detail) --}}
                        <a href="{{ route('front.service.show', $item->slug) }}" class="text-decoration-none">
                            @if ($item->img)
                            <div class="mb-3 mx-auto"
                                style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%;">
                                <img src="{{ asset('storage/service/' . $item->img) }}" alt="{{ $item->nama_service }}"
                                    class="w-100 h-100" style="object-fit: cover;">
                            </div>
                            @else
                            <div class="feature-icon bg-primary bg-gradient text-white mb-3 rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-laptop fs-3"></i>
                            </div>
                            @endif
                        </a>

                        {{-- 2. Judul Service (Bisa diklik menuju Detail) --}}
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('front.service.show', $item->slug) }}"
                                class="text-dark text-decoration-none">
                                {{ $item->nama_service }}
                            </a>
                        </h5>

                        {{-- Format Harga --}}
                        <p class="text-primary fw-bold mb-2">
                            Rp {{ number_format((float) $item->price, 0, ',', '.') }}
                        </p>

                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit(strip_tags($item->desc), 100, '...') }}
                        </p>

                        {{-- 3. Dua Tombol: Detail & Konsultasi --}}
                        <div class="d-flex gap-2 mt-3">
                            {{-- Tombol View Detail (Mengarah ke Halaman Detail) --}}
                            <a href="{{ route('front.service.show', $item->slug) }}"
                                class="btn btn-outline-secondary btn-sm flex-fill">
                                View Detail
                            </a>

                            {{-- Tombol Consultation (Scroll ke Form Konsultasi) --}}
                            <a href="#consultation" onclick="selectService('{{ $item->id }}')"
                                class="btn btn-outline-primary btn-sm flex-fill">
                                Consultation
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @empty

            <div class="col-12 text-center text-muted" data-aos="fade-up">
                <p>No services available yet.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section Portofolio Terbaru (3 Item - Grid Kotak 3 Kolom) -->
    <section id="portofolio" class="mb-5" data-aos="fade-up" data-aos-duration="900">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h3 class="fw-bold m-0">Latest Portofolio</h3>
            <a href="{{ url('/portofolios') }}" class="text-decoration-none">View All →</a>
        </div>

        <div class="row">
            @forelse ($portofolios->take(3) as $item)
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ 150 * $loop->iteration }}">
                <div class="card shadow-sm h-100 border-0">
                    <a href="{{ url('port/'.$item->slug) }}">
                        <img src="{{ asset('storage/portofolio/'.$item->img) }}" alt="{{ $item->title }}"
                            class="card-img-top post-img" style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <div class="small text-muted mb-1">
                            {{ $item->created_at->format('d M Y') }}
                            @if($item->Category)
                            | <a href="{{ url('category/'.$item->Category->slug) }}"
                                class="text-decoration-none">{{ $item->Category->name }}</a>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold">
                            <a href="{{ url('port/'.$item->slug) }}"
                                class="text-dark text-decoration-none">{{ $item->title }}</a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit(strip_tags($item->desc), 100, '...') }}
                        </p>
                        <a href="{{ url('port/'.$item->slug) }}" class="btn btn-sm btn-primary mt-2">View Detail →</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>"No portofolio available yet.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section Main Content (Artikel + Sidebar) -->
    <div class="row">
        <!-- Area Artikel (3 Artikel) -->
        <div class="col-lg-8" data-aos="fade-right" data-aos-duration="900">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h3 class="fw-bold m-0">Latest Article</h3>
                <a href="{{ url('/articles') }}" class="text-decoration-none">View All →</a>
            </div>

            <div class="row">
                {{-- Mengambil maksimal 3 artikel --}}
                @foreach ($articles->take(3) as $key => $item)
                <div class="col-md-12 mb-4" data-aos="fade-up" data-aos-delay="{{ 150 * ($key + 1) }}">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <a href="{{ url('p/'.$item->slug) }}">
                                    <img src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}"
                                        class="img-fluid rounded-start home-article-img">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="small text-muted mb-1">
                                        {{ $item->created_at->format('d M Y') }} |
                                        <a href="{{ url('category/'.$item->Category->slug) }}"
                                            class="text-decoration-none">{{ $item->Category->name }}</a>
                                    </div>
                                    <h5 class="card-title fw-bold">
                                        <a href="{{ url('p/'.$item->slug) }}"
                                            class="text-dark text-decoration-none">{{ $item->title }}</a>
                                    </h5>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit(strip_tags($item->desc), 120, '...') }}
                                    </p>
                                    <a href="{{ url('p/'.$item->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar Widget -->
        @include('front.layout.side-widget')
    </div>

    <!-- Section Form Konsultasi Langsung -->
    <section id="consultation" class="my-5 p-4 bg-light rounded shadow-sm" data-aos="zoom-in-up"
        data-aos-duration="1000">
        <div class="row align-items-center">
            <div class="col-md-5 mb-3 mb-md-0" data-aos="fade-right" data-aos-delay="200">
                <h3 class="fw-bold">Need a Custom Consultation?</h3>
                <p class="text-muted">Fill out the form on the right, and our expert team will contact you to provide the right solution for your project needs.</p>
            </div>
            <div class="col-md-7" data-aos="fade-left" data-aos-delay="400">
                <form action="{{ route('consultation.storePublic') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="email" class="form-control" name="email" placeholder="Alamat Email" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" name="phone" placeholder="Nomor Telepon / WhatsApp"
                                required>
                        </div>

                        <!-- Penambahan Input Tanggal Konsultasi -->
                        {{-- <div class="col-md-6 mb-2">
                            <input type="date" class="form-control" name="consultation_date" min="{{ date('Y-m-d') }}"
                        required>
                    </div> --}}

                    <div class="col-md-6 mb-2">
                        <select class="form-select" name="service_id" id="serviceSelect" required>
                            <option value="" selected disabled>Select Consultation Service</option>
                            @foreach ($services as $item)
                            <option value="{{ $item->slug }}">{{ $item->nama_service }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-2">
                        <textarea class="form-control" name="message" rows="3" placeholder="Jelaskan kebutuhan Anda..."
                            required></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="bi bi-whatsapp me-1"></i> Send Consultation Request
                        </button>
                    </div>
            </div>
            </form>
        </div>
</div>
</section>
</div>

<script>
    function selectService(id) {
        const selectElement = document.getElementById('serviceSelect');
        if (selectElement) {
            selectElement.value = id;
        }
    }

</script>

{{-- Inisialisasi JS AOS --}}
@push('js')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            once: true, // Animasi hanya berjalan 1 kali saat di-scroll
            duration: 800, // Durasi animasi dalam milidetik
            easing: 'ease-in-out', // Efek transisi
        });
    });

</script>
@endpush

@endsection
