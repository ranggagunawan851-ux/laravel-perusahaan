<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
    <div class="container">
        {{-- <a class="navbar-brand" href="{{ url('/') }}">Nexus Craft</a> --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('front/img/craft.png') }}" alt="Logo Nexus Craft" height="30" class="d-inline-block align-text-top">
            <span>Nexus Craft</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/articles') }}">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/portofolios') }}">Portofolio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($category_navbar as $item)
                        <li><a class="dropdown-item" href="{{ url('category/'.$item->slug)}}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                {{-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li> --}}
            </ul>
        </div>
    </div>
</nav>
