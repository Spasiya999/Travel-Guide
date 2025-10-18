<!-- Navigation Bar -->
<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container py-1">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('web.home') }}">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="Logo" style="height: 100px;">
        </a>

        <!-- Mobile Toggle Button (Only visible on mobile) -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
            aria-controls="mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop Navigation (Only visible on desktop) -->
        <div class="collapse navbar-collapse d-none d-lg-flex" id="desktopNav">
            <ul class="navbar-nav mx-auto bg-white rounded-pill px-3 shadow">
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold px-3 py-2" href="{{ route('web.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold px-3 py-2" href="{{ route('web.about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold px-3 py-2"
                        href="{{ route('web.packages') }}">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold px-3 py-2" href="{{ route('web.tour') }}">Tours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-semibold px-3 py-2" href="{{ route('web.contact') }}">Contact
                        Us</a>
                </li>
            </ul>
            <a href="{{ route('web.contact') }}"
                class="btn btn-primary rounded-pill px-4 fw-bold shadow text-decoration-none">
                Book Now
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Offcanvas Menu (Only visible on mobile) -->
<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item mb-2">
                <a class="nav-link text-primary fw-semibold fs-5" href="{{ route('web.home') }}"
                    data-bs-dismiss="offcanvas">
                    <i class="fas fa-home me-2"></i> Home
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-primary fw-semibold fs-5" href="{{ route('web.about') }}"
                    data-bs-dismiss="offcanvas">
                    <i class="fas fa-info-circle me-2"></i> About Us
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-primary fw-semibold fs-5" href="{{ route('web.packages') }}"
                    data-bs-dismiss="offcanvas">
                    <i class="fas fa-box me-2"></i> Packages
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-primary fw-semibold fs-5" href="{{ route('web.tour') }}"
                    data-bs-dismiss="offcanvas">
                    <i class="fas fa-map-marked-alt me-2"></i> Tours
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-primary fw-semibold fs-5" href="{{ route('web.contact') }}"
                    data-bs-dismiss="offcanvas">
                    <i class="fas fa-envelope me-2"></i> Contact Us
                </a>
            </li>
        </ul>
        <hr>
        <a href="{{ route('web.contact') }}"
            class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow text-decoration-none w-100"
            data-bs-dismiss="offcanvas">
            <i class="fas fa-calendar-check me-2"></i> Book Now
        </a>
    </div>
</div>

<style>
    /* Desktop Navbar Styles */
    @media (min-width: 992px) {
        #mainNavbar .navbar-nav {
            background-color: white;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    }

    /* Mobile Offcanvas Styles */
    .offcanvas {
        width: 280px !important;
    }

    .offcanvas-body {
        padding: 1.5rem;
    }

    .offcanvas-body .nav-link {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .offcanvas-body .nav-link:hover {
        background-color: rgba(13, 110, 253, 0.1);
        transform: translateX(5px);
    }

    .offcanvas-header {
        padding: 1.5rem;
    }

    /* Mobile Toggle Button */
    .navbar-toggler {
        border: 2px solid rgba(37, 37, 37, 0.8);
        padding: 8px 12px;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
</style>
