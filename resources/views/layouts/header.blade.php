<!-- Navigation Bar -->
<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container py-1">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('web.home') }}">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="Logo" style="height: 70px;">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto bg-white rounded-pill px-3 shadow mb-lg-0 mb-3">
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold" href="{{ route('web.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold" href="{{ route('web.about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold" href="{{ route('web.packages') }}">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold" href="{{ route('web.tour') }}">Tours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold" href="{{ route('web.contact') }}">Contact Us</a>
                </li>
            </ul>
            <a href="{{ route('web.contact') }}"
                class="btn btn-primary rounded-pill px-4 fw-bold shadow text-decoration-none">Book Now</a>
        </div>
    </div>
</nav>
