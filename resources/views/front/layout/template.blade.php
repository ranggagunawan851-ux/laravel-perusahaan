{{--
<!DOCTYPE html>
<html lang="<html lang={{ str_replace('_', '-', app()->getLocale()) }}">

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
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        @stack('css')
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('front.layout.navbar')

        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>

        @yield('content')

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('front/js/scripts.js')}}"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        @stack('js')
    </body>
</html> --}}


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

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        @stack('css')
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        <!-- Responsive navbar-->
        @include('front.layout.navbar')

        <!-- Main Content Wrapper -->
        <main class="flex-shrink-0">
            @yield('content')
        </main>

        <!-- Footer-->
        <footer class="py-4 bg-primary mt-auto">
            <div class="container text-center">
                <p class="m-0 text-white small">&copy; {{ date('Y') }} Nexus Craft. All Rights Reserved.</p>
            </div>
        </footer>

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
