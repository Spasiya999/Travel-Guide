@extends('layouts.app')
@include('layouts.meta')
@section('content')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .stats-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        .stat-item {
            text-align: center;
            margin-bottom: 40px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: #ffd700;
        }

        .experience-card {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
        }

        .experience-card:hover {
            transform: translateY(-10px);
        }

        .services-section {
            background: #f8f9fa;
            padding: 80px 0;
        }

        .service-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 20px;
        }

        .testimonial-section {
            padding: 80px 0;
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        .quote-icon {
            font-size: 3rem;
            color: #667eea;
            opacity: 0.3;
        }

        .cta-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 80px 0;
        }

        .personal-touch {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            padding: 60px 0;
        }

        .flag-icon {
            width: 30px;
            height: 20px;
            margin-right: 10px;
        }

        .review-text {
            min-height: 100px
        }

        .team-section {
            background: #f8f9fa;
            padding: 80px 0;
        }

        .founder-highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
        }

        .agency-stats {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 80px 0;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Pearl Island Tours & Travels</h1>
                    <h3 class="mb-4 carattere">Premier Sri Lanka Travel Agency</h3>
                    <p class="lead mb-4">Founded by passionate local experts, we are Sri Lanka's leading travel agency
                        specializing in authentic, personalized experiences across the pearl of the Indian Ocean.
                        Discover the real Sri Lanka with our team of certified local guides.</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Pearl Island Tours Team" class="profile-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Agency Story Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Our Story</h2>
                    <p class="text-muted carattere font-28">From humble beginnings to Sri Lanka's trusted travel partner</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="text-muted mb-4">Pearl Island Tours & Travels was born from a simple dream - to share the
                        authentic beauty of Sri Lanka with travelers from around the world. What started as one passionate
                        guide's mission has grown into a full-service travel agency with a team of expert local guides.</p>
                    <p class="text-muted mb-4">Founded in 2012, we've built our reputation on delivering personalized,
                        authentic Sri Lankan experiences. Our deep local knowledge, combined with professional service
                        standards, has made us the preferred choice for discerning travelers seeking genuine cultural
                        immersion.</p>
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-primary fw-bold">12+</h4>
                            <p class="small text-muted">Years in Business</p>
                        </div>
                        <div class="col-6">
                            <h4 class="text-primary fw-bold">15+</h4>
                            <p class="small text-muted">Expert Guides</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Sri Lanka Temple" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Founder Highlight Section -->
    <section class="founder-highlight">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-center">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Kasun Perera - Founder & Head Guide" class="profile-img mb-4">
                </div>
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Meet Our Founder & Head Guide</h2>
                    <h4 class="mb-3">Kasun Perera</h4>
                    <p class="mb-4">Born and raised in Kandy, Kasun founded Pearl Island Tours with a vision to showcase
                        Sri Lanka's authentic beauty. With over 12 years of guiding experience and a degree in Tourism
                        Management from the University of Sri Jayewardenepura, he leads our team of expert guides.</p>
                    <p class="mb-4">As our Head Guide, Kasun personally trains each team member, ensuring every client
                        receives the same passionate, knowledgeable service that built our reputation. He continues to
                        lead many of our premium tours, sharing his deep love for Sri Lankan culture and heritage.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="text-warning">800+ Travelers Guided</h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-warning">5 Languages</h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-warning">Licensed & Certified</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agency Stats Section -->
    <section class="agency-stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">2000+</div>
                        <h5>Happy Travelers</h5>
                        <p>From 45+ countries who experienced authentic Sri Lanka</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <h5>Tour Packages</h5>
                        <p>Carefully crafted itineraries covering all 9 provinces</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <h5>Expert Guides</h5>
                        <p>Licensed professionals with specialized knowledge</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <h5>5-Star Reviews</h5>
                        <p>Customer satisfaction rate across all platforms</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What Makes Us Different -->
    <section class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="text-muted carattere font-28 mb-0">More than just tours - we're your Sri Lankan family</p>
                    <h2 class="fw-bold">Why Choose Pearl Island Tours?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Expert Local Team</h4>
                    <p class="text-muted">Our guides are all born and raised in Sri Lanka, with deep knowledge of local
                        culture, hidden gems, and authentic experiences you won't find elsewhere.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4>Licensed & Insured</h4>
                    <p class="text-muted">Fully licensed by Sri Lanka Tourism Board with comprehensive insurance coverage.
                        Your safety and peace of mind are our top priorities.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Personalized Service</h4>
                    <p class="text-muted">Every tour is customized to your interests and preferences. We don't do
                        one-size-fits-all - each journey is uniquely yours.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h4>Multilingual Guides</h4>
                    <p class="text-muted">Our team speaks multiple languages including English, German, French, Japanese,
                        plus local Sinhala and Tamil for authentic cultural connections.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p class="text-muted">Round-the-clock support before, during, and after your trip. We're always
                        here when you need us, ensuring a worry-free experience.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Award-Winning Service</h4>
                    <p class="text-muted">Recognized by TripAdvisor and local tourism boards for excellence in service
                        and authentic cultural experiences.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Why Us Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Why Choose Us?</h2>
                    <p class="text-muted carattere font-28">Local Expertise, Global Standards</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-map-marked-alt text-primary me-2"></i>Local Expertise, Global Standards
                            </h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• Deep-rooted knowledge of Sri Lanka, from hidden gems to popular landmarks
                                </li>
                                <li class="mb-2">• Our team comprises passionate locals who live and breathe Sri Lanka</li>
                                <li class="mb-2">• Adherence to international service quality and safety standards</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-user-cog text-primary me-2"></i>Tailored Experiences, Just For You</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• No cookie-cutter itineraries; every journey is crafted to your unique
                                    interests</li>
                                <li class="mb-2">• Perfect trips for ancient ruins, beaches, wildlife safaris, or cultural
                                    immersion</li>
                                <li class="mb-2">• Flexible planning and easy modifications to ensure your itinerary evolves
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-heart text-primary me-2"></i>Authenticity & Immersion</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• Beyond typical tourist trails, connecting you with genuine Sri Lankan
                                    culture</li>
                                <li class="mb-2">• Authentic culinary experiences, homestays, and local community
                                    interactions</li>
                                <li class="mb-2">• Responsible tourism practices benefiting local communities</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-headset text-primary me-2"></i>Unwavering Support, Every Step</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• 24/7 dedicated local support throughout your trip</li>
                                <li class="mb-2">• Fluent English-speaking guides who are knowledgeable companions</li>
                                <li class="mb-2">• Seamless logistics: transfers, transportation, and accommodation</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-dollar-sign text-primary me-2"></i>Value for Money, Transparent Pricing
                            </h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• Competitive pricing without compromising quality or experience</li>
                                <li class="mb-2">• Clear, upfront costs with no hidden fees</li>
                                <li class="mb-2">• Exclusive partnerships for the best rates with local providers</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-shield-alt text-primary me-2"></i>Safety & Peace of Mind</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• Strict safety protocols for all activities and transportation</li>
                                <li class="mb-2">• Comprehensive travel advice and local insights</li>
                                <li class="mb-2">• Trusted service provider with proven track record</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-leaf text-success me-2"></i>Sustainable & Responsible Tourism</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• Minimizing environmental footprint and supporting local communities</li>
                                <li class="mb-2">• Promoting ethical wildlife encounters and conservation efforts</li>
                                <li class="mb-2">• Encouraging responsible travel practices among clients</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5><i class="fas fa-heart text-danger me-2"></i>Passionate About Sri Lanka</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2">• We don't just sell tours; we share our love for our beautiful island</li>
                                <li class="mb-2">• Our enthusiasm for Sri Lanka's landscapes, history, and people is
                                    infectious</li>
                                <li class="mb-2">• Creating lifelong memories, not just vacations</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Categories We Cover -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Tour Categories We Cover</h2>
                    <p class="text-muted carattere font-28">Comprehensive travel experiences across Sri Lanka</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Classic Tours">
                        <div class="card-body">
                            <h5 class="card-title">Classic/Highlights Tours</h5>
                            <p class="card-text">"Island Essentials" covering iconic destinations like Sigiriya, Kandy,
                                Galle, and beautiful beach stays.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Wildlife Tours">
                        <div class="card-body">
                            <h5 class="card-title">Nature & Wildlife Tours</h5>
                            <p class="card-text">Specialized safari experiences with certified wildlife guides and exclusive
                                access to premier locations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Cultural Tours">
                        <div class="card-body">
                            <h5 class="card-title">Cultural & Heritage Tours</h5>
                            <p class="card-text">Deep cultural immersion experiences exploring ancient temples, traditional
                                ceremonies, and local customs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Adventure Tours">
                        <div class="card-body">
                            <h5 class="card-title">Adventure & Activity Tours</h5>
                            <p class="card-text">Thrilling adventures including hiking, water sports, rock climbing, and
                                outdoor exploration activities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Wellness Tours">
                        <div class="card-body">
                            <h5 class="card-title">Relaxation & Wellness Tours</h5>
                            <p class="card-text">Rejuvenating wellness experiences including Ayurvedic treatments, spa
                                retreats, and meditation programs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Special Interest">
                        <div class="card-body">
                            <h5 class="card-title">Special Interest Tours</h5>
                            <p class="card-text">Tea Country journeys, culinary tours, photography expeditions, and
                                specialized experiences tailored to your interests.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Tour Categories -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Specialized Tour Categories</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-city fa-3x text-primary mb-3"></i>
                        <h5>City & Urban Experiences</h5>
                        <p class="text-muted">Explore Colombo, Kandy, and Galle with local insights and hidden urban gems.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-palette fa-3x text-primary mb-3"></i>
                        <h5>Custom / Bespoke Tours</h5>
                        <p class="text-muted">Completely personalized itineraries designed around your specific interests
                            and preferences.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-home fa-3x text-primary mb-3"></i>
                        <h5>Village Experiences</h5>
                        <p class="text-muted">Community immersion experiences with authentic village life and local
                            traditions.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-seedling fa-3x text-primary mb-3"></i>
                        <h5>Agri-Tourism & Rural Life</h5>
                        <p class="text-muted">Farm visits, agricultural experiences, and insights into rural Sri Lankan
                            livelihoods.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-family fa-3x text-success mb-3"></i>
                        <h5>Family-Friendly Tours</h5>
                        <p class="text-muted">Activities and accommodations perfectly suited for travelers with children.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                        <h5>Honeymoon & Romantic</h5>
                        <p class="text-muted">Exclusive romantic experiences and intimate getaways for couples.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-user fa-3x text-info mb-3"></i>
                        <h5>Solo Traveler Adventures</h5>
                        <p class="text-muted">Designed specifically for independent explorers seeking authentic experiences.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-wheelchair fa-3x text-warning mb-3"></i>
                        <h5>Accessible Travel</h5>
                        <p class="text-muted">Tours designed for individuals with specific mobility needs and requirements.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Testimonials -->
    <section class="testimonial-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="text-muted carattere font-28 mb-0">Real reviews from our valued clients</p>
                    <h2 class="fw-bold">What Our Clients Say</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="quote-icon text-center">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="mb-4 review-text">"Pearl Island Tours exceeded all expectations! Kasun and his team
                            showed us the real Sri Lanka - from hidden temples to family-run restaurants. Incredible
                            attention to detail."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80"
                                alt="Customer" class="rounded-circle me-3"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Emma Johnson</h6>
                                <small class="text-muted">Australia</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="quote-icon text-center">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="mb-4 review-text">"Professional service with a personal touch. The agency arranged
                            everything perfectly, and our guide made us feel like family. Best travel decision we made!"</p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80"
                                alt="Customer" class="rounded-circle me-3"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Hans Mueller</h6>
                                <small class="text-muted">Germany</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="quote-icon text-center">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="mb-4 review-text">"Outstanding agency! From booking to farewell, everything was
                            seamless. The local insights and authentic experiences made our Sri Lanka trip unforgettable."
                        </p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80"
                                alt="Customer" class="rounded-circle me-3"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Yuki Tanaka</h6>
                                <small class="text-muted">Japan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-2">
                    <a href="#" class="btn btn-primary">View All Reviews</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Commitment -->
    <section class="personal-touch">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold mb-4">Our Commitment to You</h2>
                    <p class="mb-4">At Pearl Island Tours & Travels, we don't just organize trips - we create
                        life-changing experiences. Our commitment goes beyond showing you Sri Lanka's attractions;
                        we introduce you to its soul. Every member of our team shares the same passion for authentic
                        hospitality that defines Sri Lankan culture - "Ayubowan" (may you live long) isn't just our
                        greeting, it's our blessing and promise to you.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3">
                            <i class="fas fa-certificate fa-2x text-primary mb-2"></i>
                            <p><strong>Licensed & Certified</strong><br>Sri Lanka Tourism Board</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                            <p><strong>Fully Insured</strong><br>Comprehensive Coverage</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                            <p><strong>Expert Team</strong><br>15+ Professional Guides</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                            <p><strong>24/7 Support</strong><br>Always Here for You</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold mb-4">Ready to Discover Sri Lanka with Us?</h2>
                    <p class="mb-4">Let Pearl Island Tours & Travels create your perfect Sri Lankan adventure.
                        From ancient temples to pristine beaches, from mountain tea estates to thrilling safaris -
                        we'll show you the authentic Sri Lanka that will stay in your heart forever.</p>
                    <a href="#" class="btn btn-light btn-lg me-3">Start Planning</a>
                    <a href="https://wa.me/+94718202169" class="btn btn-outline-light btn-lg">WhatsApp Us</a>
                </div>
            </div>
        </div>
    </section>
@endsection
