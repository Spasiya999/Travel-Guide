<!-- Navigation Bar -->
<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container py-3">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('web.home') }}">
            <span class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#0d6efd"
                    class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                </svg>
                <span class="ms-2 text-white fw-bold">TravelDestination</span>
            </span>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto bg-white rounded rounded-lg-pill px-3 shadow mb-lg-0 mb-3">
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
            <button class="book-now-btn shadow">Book Now</button>
        </div>
    </div>
</nav>
