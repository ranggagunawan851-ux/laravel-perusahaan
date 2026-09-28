<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="author" content="Perusahaan" />
        @stack('meta-seo')
        <title>@yield('title')</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('front/img/favicon.ico') }}" />

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Bootstrap Icons & FontAwesome -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- CSS Navbar & Layout Custom -->
        <style>
            /* Navbar Background & Styling Overrides */
            .bg-navbar-luxury {
                background: linear-gradient(135deg, #0b132b 0%, #1c2541 50%, #0f172a 100%) !important;
                backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            }

            .brand-text {
                font-weight: 800;
                font-size: 1.35rem;
                letter-spacing: 0.5px;
                color: #ffffff !important;
                transition: all 0.3s ease;
            }

            .brand-text-accent {
                background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .brand-hover:hover .logo-img {
                transform: scale(1.08) rotate(-3deg);
                filter: drop-shadow(0 0 8px rgba(6, 182, 212, 0.6));
            }

            .logo-img {
                transition: transform 0.3s ease, filter 0.3s ease;
            }

            .nav-link-luxury {
                color: rgba(241, 245, 249, 0.85) !important;
                font-weight: 500;
                font-size: 0.95rem;
                letter-spacing: 0.3px;
                padding: 8px 16px !important;
                border-radius: 20px;
                position: relative;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .nav-link-luxury:hover {
                color: #ffffff !important;
                background: rgba(255, 255, 255, 0.08) !important;
                text-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
                transform: translateY(-1px);
            }

            .nav-link-luxury.active {
                color: #ffffff !important;
                font-weight: 600;
                background: linear-gradient(135deg, rgba(6, 182, 212, 0.25) 0%, rgba(59, 130, 246, 0.25) 100%) !important;
                border: 1px solid rgba(6, 182, 212, 0.4) !important;
                box-shadow: 0 4px 15px rgba(6, 182, 212, 0.15);
            }

            .nav-link-luxury.active::after {
                content: '';
                position: absolute;
                bottom: 4px;
                left: 50%;
                transform: translateX(-50%);
                width: 16px;
                height: 2px;
                background: #06b6d4;
                border-radius: 2px;
                box-shadow: 0 0 8px #06b6d4;
            }
        </style>

        @stack('css')
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        <!-- Responsive navbar-->
        @include('front.layout.navbar')

        <!-- Main Content Wrapper -->
        <main class="flex-shrink-0">
            @yield('content')
        </main>

        <!-- Footer Luxury -->
<footer class="footer-luxury py-4 mt-auto border-top border-secondary border-opacity-25" style="background: linear-gradient(135deg, #0b132b 0%, #0f172a 100%);">
    <div class="container">
        <div class="row align-items-center gy-3">
            <!-- Copyright -->
            <div class="col-md-6 text-center text-md-start">
                <p class="m-0 text-white-50 small">&copy; {{ date('Y') }} <span class="fw-semibold text-white">Nexus Craft</span>. All Rights Reserved.</p>
            </div>

            <!-- Media Sosial Nexus Craft -->
            <div class="col-md-6 text-center text-md-end">
                <div class="d-inline-flex gap-2 align-items-center">
                    <span class="text-white-50 small me-2 d-none d-sm-inline">Follow Us:</span>

                    <a href="https://instagram.com" target="_blank" class="social-icon-btn" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank" class="social-icon-btn" title="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="social-icon-btn" title="Twitter">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://youtube.com" target="_blank" class="social-icon-btn" title="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://wa.me/6287777777777" target="_blank" class="social-icon-btn" title="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Tambahkan CSS berikut di tag <style> bagian head jika belum ada -->
<style>
    .social-icon-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #f8fafc;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-icon-btn:hover {
        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        color: #0f172a !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
    }
</style>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('front/js/scripts.js')}}"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                once: true,
                duration: 800
            });
        </script>
        @stack('js')
    </body>
</html>
