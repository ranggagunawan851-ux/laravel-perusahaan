@extends('front.layout.template')

@section('title', 'About Us - Nexus Craft')

@section('content')

<!-- Page content-->
<div class="container py-4">
    <div class="row">
        <!-- Main content (About & Contact) -->
        <div class="col-lg-8" data-aos="fade-up">

            <!-- Card Profil Perusahaan -->
            <div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="position-relative bg-light text-center p-4">
                    <img class="img-fluid py-3" src="{{ asset('front/img/logoprshn.svg') }}" alt="Nexus Craft Logo" style="max-height: 180px;">
                </div>

                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">Official Profile</span>
                        <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> {{ date('d M Y') }}</small>
                    </div>

                    <h2 class="card-title fw-bold text-dark mb-3">About Nexus Craft</h2>
                    <hr class="mb-4 opacity-10">

                    <div class="card-text text-secondary lh-lg mb-4">
                        <p>
                            <strong>Nexus Craft</strong> adalah perusahaan profesional yang bergerak di bidang arsitektur, desain interior, perencanaan tata ruang, dan konstruksi bangunan. Kami berkomitmen untuk menghadirkan hunian serta ruang komersial yang tidak hanya estetik dan modern, tetapi juga fungsional, efisien, dan memiliki nilai investasi jangka panjang.
                        </p>
                        <p>
                            Berbekal pengalaman dan tim ahli yang berdedikasi, kami mengintegrasikan estetika arsitektur terkini dengan pemilihan material berkualitas tinggi. Kami percaya bahwa setiap bangunan memiliki cerita dan karakter unik, sehingga setiap proyek yang kami kerjakan dirancang secara personal sesuai dengan kebutuhan dan impian setiap klien.
                        </p>
                    </div>

                    <!-- Seksi Visi & Misi Ringkas -->
                    <div class="row g-3 my-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-start border-4 border-primary h-100">
                                <h6 class="fw-bold text-dark mb-1"><i class="fa-solid fa-compass me-2 text-primary"></i> Visi Kami</h6>
                                <p class="small text-muted mb-0">Menjadi mitra utama terpercaya dalam mewujudkan ruang hidup & kerja impian yang berkualitas tinggi.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-start border-4 border-primary h-100">
                                <h6 class="fw-bold text-dark mb-1"><i class="fa-solid fa-bullseye me-2 text-primary"></i> Komitmen Kami</h6>
                                <p class="small text-muted mb-0">Memberikan kepuasan maksimal melalui presisi pengerjaan, ketepatan waktu, dan transparansi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak Cepat -->
                    <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fa-solid fa-headset me-2 text-primary"></i> Hubungi Kami</h4>
                    <div class="row g-3 mb-4">
                        <!-- WhatsApp -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3 h-100">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-whatsapp fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">WhatsApp / Telepon</small>
                                    <a href="https://wa.me/6282269174012" target="_blank" class="fw-semibold text-dark text-decoration-none">+62 822-6917-4012</a>
                                </div>
                            </div>
                        </div>

                        <!-- Email Resmi -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3 h-100">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-instagram fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Email Resmi</small>
                                    <a href="mailto:nexuscraft@gmail.com" class="fw-semibold text-dark text-decoration-none">nexuscraft@gmail.com</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Sosial -->
                    <h5 class="fw-bold text-dark mb-3">Ikuti Media Sosial Kami</h5>
                    <div class="d-flex flex-wrap gap-2 mb-5">
                        <a href="https://instagram.com" target="_blank" class="btn btn-outline-danger rounded-pill px-3 py-2 btn-sm fw-semibold">
                            <i class="fa-brands fa-instagram me-1"></i> Instagram
                        </a>
                        <a href="https://facebook.com" target="_blank" class="btn btn-outline-primary rounded-pill px-3 py-2 btn-sm fw-semibold">
                            <i class="fa-brands fa-facebook me-1"></i> Facebook
                        </a>
                        <a href="https://youtube.com" target="_blank" class="btn btn-outline-danger rounded-pill px-3 py-2 btn-sm fw-semibold">
                            <i class="fa-brands fa-youtube me-1"></i> YouTube
                        </a>
                        <a href="https://x.com" target="_blank" class="btn btn-outline-dark rounded-pill px-3 py-2 btn-sm fw-semibold">
                            <i class="fa-brands fa-x-twitter me-1"></i> Twitter / X
                        </a>
                    </div>

                    <!-- Peta Lokasi Kantor (Google Maps) -->
                    <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-location-dot me-2 text-danger"></i> Lokasi Kantor Utama</h5>
                    <p class="text-muted small mb-3">Jl. Sudirman No. 123, Komplek Perkantoran Modern, Jakarta Selatan, Indonesia</p>

                    <div class="rounded-4 overflow-hidden border shadow-sm" style="height: 320px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28336338507!2d106.759478!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e800000001%3A0x1000000000000000!2sJakarta%20South!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>
            </div>

        </div>

        <!-- Side widgets-->
        @include('front.layout.side-widget')
    </div>
</div>

@endsection
