@extends('layouts.app')
@section('content')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        }

        .testimonial-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .review-stars {
            color: #ffd700;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .customer-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .filter-buttons {
            margin-bottom: 40px;
        }

        .filter-btn {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 10px 25px;
            border-radius: 25px;
            margin: 5px;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #667eea;
            color: white;
        }

        .stats-section {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
            display: block;
        }

        .cta-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 80px 0;
        }

        .gallery-section {
            padding: 80px 0;
        }

        .gallery-item {
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        .carattere {
            font-family: 'Times New Roman', serif;
            font-style: italic;
        }

        .location-tag {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            position: absolute;
            bottom: 15px;
            left: 15px;
        }
    </style>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold mb-4">Discover Sri Lanka's Hidden Gems</h1>
                    <p class="lead mb-4">Experience authentic Sri Lanka through my personalized tours and see what travelers
                        are
                        saying about their adventures</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">Tours & Reviews</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <h6>Tour Destinations</h6>
                        <p class="text-muted small">Across all 9 provinces</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">800+</span>
                        <h6>Happy Travelers</h6>
                        <p class="text-muted small">From 35+ countries</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">99%</span>
                        <h6>5-Star Reviews</h6>
                        <p class="text-muted small">Customer satisfaction</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">12+</span>
                        <h6>Years Experience</h6>
                        <p class="text-muted small">Professional guiding</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="carattere h5 mb-0 opacity-75">Hear from my recent guests</p>
                    <h2 class="fw-bold">What Travelers Are Saying</h2>
                </div>
            </div>
            <div class="row" id="testimonial-list">
                @foreach ($testimonials as $index => $testimonial)
                    <div class="col-lg-4 testimonial-item" style="{{ $index >= 9 ? 'display:none;' : '' }}">
                        <div class="testimonial-card">
                            <div class="review-stars">
                                @for ($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <p class="mb-4">"{{ $testimonial->message }}"</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ $testimonial->user_image ? asset($testimonial->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) . '&background=667eea&color=fff&size=60' }}"
                                    alt="{{ $testimonial->name }}" class="customer-img me-3">
                                <div>
                                    <h6 class="mb-0">{{ $testimonial->name }}</h6>
                                    <small class="opacity-75">
                                        @if ($testimonial->country)
                                            <img src="https://flagcdn.com/w20/{{ strtolower(substr($testimonial->country, 0, 2)) }}.png"
                                                class="me-1" width="20">
                                            {{ $testimonial->country }}
                                        @endif
                                        @if ($testimonial->date)
                                            • {{ \Carbon\Carbon::parse($testimonial->date)->format('F Y') }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (count($testimonials) > 6)
                    <div class="col-12 text-center mt-4">
                        <button id="showMoreBtn" class="btn btn-light">Show More</button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="text-muted carattere h5 mb-0">Captured moments from my tours</p>
                    <h2 class="fw-bold">Photo Gallery</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Gallery Image">
                        <div class="gallery-overlay">
                            <h6>Sigiriya at Sunrise</h6>
                            <p class="small mb-0">The best time to climb the rock fortress</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Gallery Image">
                        <div class="gallery-overlay">
                            <h6>Leopard Spotting</h6>
                            <p class="small mb-0">Yala National Park safari</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Gallery Image">
                        <div class="gallery-overlay">
                            <h6>Tea Plantation Walk</h6>
                            <p class="small mb-0">Nuwara Eliya hill country</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Gallery Image">
                        <div class="gallery-overlay">
                            <h6>Temple of the Tooth</h6>
                            <p class="small mb-0">Sacred Kandy temple visit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1580500550469-4d2a93a20095?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Gallery Image">
                        <div class="gallery-overlay">
                            <h6>Whale Watching</h6>
                            <p class="small mb-0">Blue whales in Mirissa</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1582021932503-1154ec2e9fb1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Gallery Image">
                        <div class="gallery-overlay">
                            <h6>Ancient Ruins</h6>
                            <p class="small mb-0">Polonnaruwa archaeological site</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('showMoreBtn');
            if (showMoreBtn) {
                showMoreBtn.addEventListener('click', function() {
                    document.querySelectorAll('.testimonial-item').forEach(function(el) {
                        el.style.display = '';
                    });
                    showMoreBtn.style.display = 'none';
                });
            }
        });
    </script>
@endsection
