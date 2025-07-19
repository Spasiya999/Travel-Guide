@extends('layouts.app')
@include('layouts.meta')
@section('content')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        }

        .package-card {
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .package-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .package-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .duration-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .package-category {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .category-filter {
            margin-bottom: 50px;
        }

        .filter-btn {
            background: white;
            border: 2px solid #e9ecef;
            color: #6c757d;
            padding: 10px 25px;
            margin: 5px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .highlight-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .custom-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 80px 0;
        }

        .itinerary-item {
            background: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .package-includes {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .testimonial-mini {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .package-card {
            min-height: 100px;
        }
    </style>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold mb-4">Discover Sri Lanka</h1>
                    <h3 class="mb-4">Curated Tour Packages by Kasun</h3>
                    <p class="lead mb-4">From ancient kingdoms to pristine beaches, from misty mountains to exciting safaris
                        - choose your perfect Sri Lankan adventure. Each package is personally crafted based on my 12+ years
                        of guiding experience.</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">Tour Packages</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Package Categories Filter -->
    <section class="package-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center category-filter">
                    <p class="text-muted mb-4 carattere font-28 mb-0">Filter packages by your interests</p>
                    <h2 class="fw-bold mb-4">Choose Your Adventure</h2>
                    <div class="filter-buttons">
                        <a href="{{ route('web.packages') }}"
                            class="btn filter-btn {{ !request('category') ? 'active' : '' }}">All Packages</a>
                        @foreach ($categories as $category)
                            <a href="{{ route('web.packages', ['category' => $category->id]) }}"
                                class="btn filter-btn {{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Featured Packages -->
            <div class="row">
                @forelse($packages as $package)
                    <div class="col-lg-4 col-md-6 h-100">
                        <div class="card package-card h-100">
                            <div class="package-badge">
                                {{ $package->category->name ?? 'Popular' }}
                            </div>
                            <div class="duration-badge">
                                <i class="fas fa-clock me-1"></i>{{ $package->duration }}
                            </div>
                            <img src="{{ $package->image ? asset($package->image) : asset('frontend/img/packges (1).png') }}"
                                class="package-img" alt="{{ $package->name }}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $package->name }}</h5>
                                <p class="card-text text-muted">{{ $package->short_description }}</p>
                                <div class="package-includes mb-3">
                                    {!! $package->description !!}
                                    {{-- <h6><i class="fas fa-check-circle text-success me-2"></i>Package Includes:</h6>
                                    <ul class="list-unstyled small">
                                        <li><i class="fas fa-car me-2 text-primary"></i>Private air-conditioned vehicle</li>
                                        <li><i class="fas fa-user-tie me-2 text-primary"></i>Personal guide</li>
                                        <li><i class="fas fa-bed me-2 text-primary"></i>Comfortable accommodations</li>
                                        <li><i class="fas fa-utensils me-2 text-primary"></i>Traditional meals</li>
                                        <li><i class="fas fa-ticket-alt me-2 text-primary"></i>All entrance fees included
                                        </li>
                                    </ul> --}}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        <small class="text-muted ms-1">
                                            ({{ $package->testimonials->where('status', 1)->where('is_approved', 1)->count() }}
                                            reviews)
                                        </small>
                                    </div>
                                    <a href="#" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No packages found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Why Choose My Packages -->
    <section class="highlight-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="carattere font-28 mb-0">What makes touring with Kasun different from other guides</p>
                    <h2 class="fw-bold">Why My Packages Are Special</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h5>Personal Attention</h5>
                    <p>Small groups only (max 8 people) for personalized experiences and genuine connections.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h5>Local Connections</h5>
                    <p>Access to local families, authentic restaurants, and hidden spots tourists never find.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h5>Flexible Itineraries</h5>
                    <p>Every package can be customized to your interests, pace, and travel style.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p>I'm available round the clock during your trip for any assistance you need.</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <div class="testimonial-mini text-center">
                        <p class="mb-3">"Kasun doesn't just show you Sri Lanka, he makes you feel like part of his
                            family. His packages include experiences you simply can't get with other tour operators."</p>
                        <h6>- Sarah Mitchell, UK</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Package Section -->
    <section class="custom-section">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold mb-4">Don't See Your Perfect Package?</h2>
                    <p class="mb-4">No worries! I specialize in creating custom itineraries tailored to your specific
                        interests, budget, and time frame. Whether you're interested in spiritual journeys, adventure
                        sports, culinary experiences, or family-friendly activities - I'll design the perfect Sri Lankan
                        adventure just for you.</p>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-comments fa-2x mb-2"></i>
                            <h6>Free Consultation</h6>
                            <p class="small">Tell me your interests and I'll suggest the perfect itinerary</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-edit fa-2x mb-2"></i>
                            <h6>Custom Design</h6>
                            <p class="small">Personalized itinerary created just for you</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-handshake fa-2x mb-2"></i>
                            <h6>Fair Pricing</h6>
                            <p class="small">Transparent, honest pricing with no hidden costs</p>
                        </div>
                    </div>
                    <a href="{{ route('web.contact') }}" class="btn btn-light btn-lg me-lg-3 mb-3 mb-lg-0">Plan My Custom
                        Tour</a>
                    <a href="https://wa.me/+94718202169" class="btn btn-outline-light btn-lg">WhatsApp Me</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold text-center mb-5">Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne">
                                    How do I get pricing for these packages?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pricing depends on your group size, accommodation preferences, travel dates, and
                                    specific requirements. Contact me directly for a personalized quote. I believe in
                                    transparent, fair pricing with no hidden costs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo">
                                    Can I modify these packages?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely! These are template packages. I customize every tour based on your interests,
                                    budget, and time available. Want to spend more time at beaches? Love wildlife?
                                    Interested in photography? Just let me know!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree">
                                    What's included in the package prices?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Everything is included! From accommodations to transportation, everything is taken care
                                    of. Just relax and enjoy the adventure!
                                </div>
                            </div>
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
            const includesDivs = document.querySelectorAll('.package-includes');
            let maxHeight = 0;

            // Find the maximum height
            includesDivs.forEach(function(div) {
                div.style.height = 'auto'; // Reset height to get natural height
                if (div.offsetHeight > maxHeight) {
                    maxHeight = div.offsetHeight;
                }
            });

            // Apply the maximum height to all
            includesDivs.forEach(function(div) {
                div.style.height = maxHeight + 'px';
            });
        });
    </script>
@endsection
