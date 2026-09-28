@extends('front.layout.template')

@section('title', 'Home - Nexus Craft')

{{-- Menambahkan CDN CSS AOS jika belum ada di template utama --}}
@push('css')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

{{-- STYLE TAMBAHAN WARNA MODERN TANPA MERUBAH STRUKTUR/TATA LETAK --}}
<style>
    /* Mencegah Halaman Bisa Digeser ke Samping (Fix Horizontal Scrollbar) */
    html,
    body {
        max-width: 100% !important;
        overflow-x: hidden !important;
    }

    /* Wrapper utama untuk memastikan animasi AOS tidak membuat halaman bocor ke kanan */
    .page-wrapper {
        width: 100%;
        overflow-x: hidden;
    }

    /* Gradient Color Palette & Utility */
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

    /* Vibrant Buttons */
    .btn-gradient-primary {
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        color: #fff !important;
        border: none;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        transition: all 0.3s ease;
    }

    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(124, 58, 237, 0.6);
    }

    .btn-gradient-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #fff !important;
        border: none;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        transition: all 0.3s ease;
    }

    .btn-gradient-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(217, 119, 6, 0.6);
    }

    /* Feature Icon Gradient */
    .feature-icon-colored {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%) !important;
        box-shadow: 0 5px 15px rgba(6, 182, 212, 0.4);
    }

    /* Colorful Hover Effects for Cards */
    .card-colorful {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(229, 231, 235, 0.8) !important;
    }

    .card-colorful:hover {
        transform: translateY(-6px);
        border-color: #3b82f6 !important;
        box-shadow: 0 15px 30px rgba(37, 99, 235, 0.15) !important;
    }

    /* Portfolio Image Hover Scale */
    .post-img-container {
        overflow: hidden;
    }

    .post-img-container img {
        transition: transform 0.5s ease;
    }

    .post-img-container:hover img {
        transform: scale(1.08);
    }

    /* Consultation Card Colorful Background */
    .consultation-box {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
        color: #ffffff !important;
        border: 1px solid rgba(56, 189, 248, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
    }

    .consultation-box input,
    .consultation-box select,
    .consultation-box textarea {
        background-color: rgba(255, 255, 255, 0.07) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #fff !important;
    }

    .consultation-box input::placeholder,
    .consultation-box textarea::placeholder {
        color: #94a3b8 !important;
    }

    .consultation-box input:focus,
    .consultation-box select:focus,
    .consultation-box select option {
        background-color: #1e293b !important;
        color: #ffffff !important;
    }

</style>
@endpush

@section('content')

<!-- Section Hero / Header Perusahaan (Background Foto + Sentuhan Warna) -->
<section class="text-white text-center mb-5 hero-section overflow-hidden d-flex align-items-center position-relative"
    style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 27, 75, 0.8) 100%),
                 url('{{ asset('front/img/nexus.png') }}') no-repeat center center / cover;
           min-height: 92dvh;
           height: 92dvh;
           padding: 80px 0;">
    <div class="container py-4" data-aos="zoom-in" data-aos-duration="1000">
        <!-- Judul Lebih Besar & Berwarna -->
        <h1 class="display-2 fw-extrabold mb-4 tracking-tight text-gradient-cyan" data-aos="fade-down"
            data-aos-delay="200" style="letter-spacing: -1px; text-shadow: 0 4px 20px rgba(6, 182, 212, 0.3);">
            Nexus Craft
        </h1>

        <!-- Deskripsi dengan Ukuran Pas & Jarak Elegan -->
        <p class="fs-4 fw-normal mb-5 mx-auto opacity-90"
            style="max-width: 850px; line-height: 1.6; text-shadow: 0 1px 5px rgba(0,0,0,0.3);" data-aos="fade-up"
            data-aos-delay="400">
            Architecting your dream space. Bringing harmony to aesthetics, functionality, and high-quality construction.
        </p>

        <!-- Tombol Aksi Berwarna -->
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap" data-aos="fade-up"
            data-aos-delay="600">
            <a href="#service" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold rounded-3 shadow-sm">
                View Services
            </a>
            <a href="#consultation" class="btn btn-gradient-warning btn-lg px-4 py-3 fw-bold rounded-3 shadow-sm">
                Consultation Free
            </a>
        </div>
    </div>
</section>

<div class="container">
    <!-- Section Service -->
    <section id="service" class="mb-5">
        <div class="text-center mb-4" data-aos="fade-up" data-aos-duration="800">
            <h2 class="fw-bold text-gradient-cyan">Our Services</h2>
            <p class="text-muted">Professional solutions we provide for you</p>
        </div>

        <div class="row g-0">
            @forelse ($services as $index => $item)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}" data-aos-duration="800">
                <div class="card h-100 shadow-sm border-0 text-center p-3 card-colorful">
                    <div class="card-body d-flex flex-column">

                        {{-- 1. Gambar Service --}}
                        <a href="{{ route('front.service.show', $item->slug) }}" class="text-decoration-none">
                            @if ($item->img)
                            <div class="mb-3 mx-auto shadow-sm"
                                style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%; border: 3px solid #06b6d4;">
                                <img src="{{ asset('storage/service/' . $item->img) }}" alt="{{ $item->nama_service }}"
                                    class="w-100 h-100" style="object-fit: cover;">
                            </div>
                            @else
                            <div class="feature-icon feature-icon-colored text-white mb-3 rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-laptop fs-3"></i>
                            </div>
                            @endif
                        </a>

                        {{-- 2. Judul Service --}}
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('front.service.show', $item->slug) }}"
                                class="text-dark text-decoration-none">
                                {{ $item->nama_service }}
                            </a>
                        </h5>

                        {{-- Format Harga --}}
                        <p class="text-gradient-gold fw-bold mb-2 fs-5">
                            Rp {{ number_format((float) $item->price, 0, ',', '.') }}
                        </p>

                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit(strip_tags($item->desc), 100, '...') }}
                        </p>

                        {{-- 3. Dua Tombol: Detail & Konsultasi --}}
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('front.service.show', $item->slug) }}"
                                class="btn btn-outline-primary btn-sm flex-fill rounded-2">
                                View Detail
                            </a>

                            <a href="#consultation" onclick="selectService('{{ $item->slug }}')"
                                class="btn btn-gradient-primary btn-sm flex-fill rounded-2">
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

    <!-- Section Portofolio Terbaru -->
    <section id="portofolio" class="mb-5" data-aos="fade-up" data-aos-duration="900">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h3 class="fw-bold m-0 text-gradient-cyan">Portofolios</h3>
            <a href="{{ url('/portofolios') }}" class="text-decoration-none fw-semibold text-primary">View All →</a>
        </div>

        <div class="row">
            @forelse ($portofolios->take(3) as $item)
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ 150 * $loop->iteration }}">
                <div class="card shadow-sm h-100 border-0 card-colorful">
                    <a href="{{ url('port/'.$item->slug) }}" class="post-img-container rounded-top">
                        <img src="{{ asset('storage/portofolio/'.$item->img) }}" alt="{{ $item->title }}"
                            class="card-img-top post-img" style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <div class="small text-muted mb-1">
                            <i
                                class="bi bi-calendar3 me-1 text-primary"></i>{{ \Carbon\Carbon::parse($item->publish_date)->format('d M Y') }}
                            @if($item->Category)
                            | <a href="{{ url('category/'.$item->Category->slug) }}"
                                class="text-decoration-none badge bg-primary bg-opacity-10 text-primary">{{ $item->Category->name }}</a>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold">
                            <a href="{{ url('port/'.$item->slug) }}"
                                class="text-dark text-decoration-none">{{ $item->title }}</a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit(strip_tags($item->desc), 100, '...') }}
                        </p>
                        <a href="{{ url('port/'.$item->slug) }}" class="btn btn-sm btn-gradient-primary mt-2">View
                            Detail →</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>No portofolio available yet.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section Main Content (Artikel + Sidebar) -->
    <div class="row">
        <!-- Area Artikel (3 Artikel) -->
        <div class="col-lg-8" data-aos="fade-right" data-aos-duration="900">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h3 class="fw-bold m-0 text-gradient-cyan">Articles</h3>
                <a href="{{ url('/articles') }}" class="text-decoration-none fw-semibold text-primary">View All →</a>
            </div>

            <div class="row">
                @foreach ($articles->take(3) as $key => $item)
                <div class="col-md-12 mb-4" data-aos="fade-up" data-aos-delay="{{ 150 * ($key + 1) }}">
                    <div class="card shadow-sm h-100 border-0 card-colorful">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4 post-img-container">
                                <a href="{{ url('p/'.$item->slug) }}">
                                    <img src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}"
                                        class="img-fluid rounded-start home-article-img"
                                        style="height: 200px; width: 100%; object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="small text-muted mb-1">
                                        <i
                                            class="bi bi-calendar3 me-1 text-primary"></i>{{ \Carbon\Carbon::parse($item->publish_date)->format('d M Y') }}
                                        |
                                        <a href="{{ url('category/'.$item->Category->slug) }}"
                                            class="text-decoration-none badge bg-info bg-opacity-10 text-info">{{ $item->Category->name }}</a>
                                    </div>
                                    <h5 class="card-title fw-bold">
                                        <a href="{{ url('p/'.$item->slug) }}"
                                            class="text-dark text-decoration-none">{{ $item->title }}</a>
                                    </h5>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit(strip_tags($item->desc), 120, '...') }}
                                    </p>
                                    <a href="{{ url('p/'.$item->slug) }}"
                                        class="btn btn-sm btn-outline-primary rounded-2">Read More</a>
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

    <section id="consultation" class="my-5 p-4 rounded shadow-sm consultation-box" data-aos="zoom-in-up"
        data-aos-duration="1000">
        <div class="row align-items-center">
            <div class="col-md-5 mb-3 mb-md-0" data-aos="fade-right" data-aos-delay="200">
                <h3 class="fw-bold text-gradient-cyan">Need a Custom Consultation?</h3>
                <p class="text-light opacity-75">Fill out the form on the right, and our expert team will contact you to
                    provide the right solution for your project needs.</p>
            </div>
            <div class="col-md-7" data-aos="fade-left" data-aos-delay="400">
                <form action="{{ route('consultation.storePublic') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" name="phone" placeholder="Number WhatsApp" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <select class="form-select" name="service_id" id="serviceSelect" required>
                                <option value="" selected disabled hidden>Select Consultation Service</option>
                                @foreach ($services as $item)
                                <option value="{{ $item->slug }}">{{ $item->nama_service }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <textarea class="form-control" name="message" rows="3"
                                placeholder="Describe your needs..." required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-gradient-warning w-100 fw-bold py-2">
                                <i class="bi bi-whatsapp me-1"></i> Send Consultation Request
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- MODAL POP-UP WHATSAPP (Tema Modern Sewarna Website) -->
    @if (session('consultation_success'))
    @php
    $data = session('consultation_success');
    $adminPhone = '6282269174012';

    $waMessage = "Halo Admin Nexus Craft,\n\nI would like to confirm my consultation request:\n" .
    "• *Unique Code:* " . $data->code . "\n" .
    "• *Name:* " . $data->name . "\n" .
    "• *Service:* " . ($data->service->nama_service ?? '-') . "\n" .
    "• *Note:* " . $data->message . "\n\n" .
    "Please check and follow up. Thank you!";

    $waUrl = "https://wa.me/" . $adminPhone . "?text=" . urlencode($waMessage);
    @endphp

    <div class="modal fade" id="waSuccessModal" tabindex="-1" aria-labelledby="waSuccessModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content consultation-box border-0 overflow-hidden text-white shadow-lg rounded-4">
                <!-- Header Modal -->
                <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 pt-4 pb-3">
                    <h5 class="modal-title fw-bold text-gradient-cyan d-flex align-items-center"
                        id="waSuccessModalLabel">
                        <i class="bi bi-check-circle-fill me-2 fs-4 text-info"></i> Consultation Request Sent!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body text-center p-4">
                    <p class="mb-3 text-light opacity-90 fs-6">
                        Thank You, <strong class="text-white">{{ $data->name }}</strong>. Your request has been successfully saved in our system.
                    </p>

                    <!-- Box Kode Unik -->
                    <div class="rounded-3 p-3 my-3"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px dashed rgba(6, 182, 212, 0.5);">
                        <small class="text-uppercase fw-bold tracking-wider d-block mb-1 text-light opacity-75"
                            style="letter-spacing: 1px;">Your Unique Consultation Code:</small>
                        <span class="fs-2 fw-bold text-gradient-cyan font-monospace d-block">{{ $data->code }}</span>
                    </div>

                    <p class="small text-light opacity-75 mb-0">
                        Click the button below to connect directly with our WhatsApp Admin.
                    </p>
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer border-top border-secondary border-opacity-25 justify-content-center p-3">
                    <a href="{{ $waUrl }}" target="_blank"
                        class="btn btn-gradient-warning fw-bold px-4 py-2 w-100 rounded-3 shadow">
                        <i class="bi bi-whatsapp me-2"></i> Send To WhatsApp Admin
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Otomatis Membuka Modal saat Redirect -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById('waSuccessModal'));
            myModal.show();
        });

    </script>
    @endif
</div>

<script>
    function selectService(slug) {
        // 1. Set nilai pada select dropdown berdasarkan slug yang diklik
        const selectElement = document.getElementById('serviceSelect');
        if (selectElement) {
            selectElement.value = slug;
        }

        // 2. Efek scroll halus mengarah ke section konsultasi
        const consultationSection = document.getElementById('consultation');
        if (consultationSection) {
            consultationSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

</script>

{{-- Inisialisasi JS AOS --}}
@push('js')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-in-out',
        });

        // 2. Baca Query Parameter dari URL (Akan berjalan saat datang dari halaman show)
        const urlParams = new URLSearchParams(window.location.search);
        const serviceSlug = urlParams.get('service_slug');

        if (serviceSlug) {
            selectService(serviceSlug);
        }
    });

</script>
@endpush
@endsection
