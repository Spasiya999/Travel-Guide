@extends('layouts.app')
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
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Hello, I'm Kasun Perera</h1>
                    <h3 class="mb-4 carattere">Your Personal Sri Lanka Travel Guide</h3>
                    <p class="lead mb-4">Born and raised in the pearl of the Indian Ocean, I've dedicated my life to
                        sharing the hidden gems and authentic beauty of Sri Lanka with travelers from around the world.
                    </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">About Me</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Kasun Perera - Sri Lanka Guide" class="profile-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Personal Story Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">My Story</h2>
                    <p class="text-muted mb-4">Growing up in Kandy, surrounded by ancient temples and misty mountains, I
                        developed a deep love for Sri Lanka's rich culture and breathtaking landscapes. After completing
                        my studies in Tourism Management at the University of Sri Jayewardenepura, I realized my calling
                        was to share my homeland's treasures with the world.</p>
                    <p class="text-muted mb-4">For the past 12 years, I've been guiding travelers through Sri Lanka's
                        wonders - from the ancient ruins of Polonnaruwa to the pristine beaches of Mirissa, from the tea
                        plantations of Nuwara Eliya to the wildlife safaris in Yala National Park.</p>
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-primary fw-bold">12+</h4>
                            <p class="small text-muted">Years as Guide</p>
                        </div>
                        <div class="col-6">
                            <h4 class="text-primary fw-bold">5</h4>
                            <p class="small text-muted">Languages Spoken</p>
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

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">800+</div>
                        <h5>Happy Travelers</h5>
                        <p>From 35+ countries who experienced authentic Sri Lanka</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <h5>Tour Routes</h5>
                        <p>Carefully crafted itineraries covering all 9 provinces</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">25+</div>
                        <h5>UNESCO Sites</h5>
                        <p>World Heritage Sites I can guide you through</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">99%</div>
                        <h5>5-Star Reviews</h5>
                        <p>Customer satisfaction rate on TripAdvisor</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What Makes Me Different -->
    <section class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="text-muted carattere font-28 mb-0">More than just a tour guide - I'm your local friend in Sri
                        Lanka</p>
                    <h2 class="fw-bold">Why Choose Me as Your Guide?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h4>Born & Raised Local</h4>
                    <p class="text-muted">I know every corner of Sri Lanka like the back of my hand. From hidden
                        waterfalls to local family restaurants that tourists never find.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h4>Multilingual Guide</h4>
                    <p class="text-muted">Fluent in Sinhala, Tamil, English, German, and Japanese. I can connect with
                        locals and translate authentic experiences for you.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Personal Touch</h4>
                    <p class="text-muted">Every tour is customized to your interests. Whether you love history, nature,
                        food, or adventure - I craft the perfect Sri Lankan experience.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h4>Photography Spots</h4>
                    <p class="text-muted">I'll take you to Instagram-worthy locations that only locals know, and help
                        capture your perfect Sri Lanka memories.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h4>Authentic Food Experiences</h4>
                    <p class="text-muted">Taste real Sri Lankan cuisine at local homes and family-run restaurants. I'll
                        introduce you to dishes you won't find in tourist menus.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Safe & Reliable</h4>
                    <p class="text-muted">Licensed tour guide with comprehensive insurance. Your safety and comfort are
                        my top priorities throughout your journey.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Highlights -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="text-muted carattere font-28 mb-0">Specialized knowledge gained through years of guiding</p>
                    <h2 class="fw-bold">My Expertise</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Cultural Heritage">
                        <div class="card-body">
                            <h5 class="card-title">Cultural Heritage Expert</h5>
                            <p class="card-text">Deep knowledge of Buddhist temples, ancient kingdoms, and traditional
                                ceremonies. I can arrange private temple visits and cultural experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Wildlife Safari">
                        <div class="card-body">
                            <h5 class="card-title">Wildlife Safari Specialist</h5>
                            <p class="card-text">Certified wildlife guide with connections to the best safari drivers.
                                I know the best times and locations for leopard and elephant sightings.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card experience-card">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="Tea Plantations">
                        <div class="card-body">
                            <h5 class="card-title">Tea Country Guide</h5>
                            <p class="card-text">Born in hill country, I have personal connections with tea estate
                                owners. Experience authentic tea plucking and private tastings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonial-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <p class="text-muted carattere font-28 mb-0">Real reviews from my recent guests</p>
                    <h2 class="fw-bold">What Travelers Say</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="quote-icon text-center">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="mb-4 review-text">"Kasun made our Sri Lanka trip absolutely magical! His knowledge of
                            local
                            culture and hidden gems was incredible. We visited places no other tourists knew about."</p>
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
                        <p class="mb-4 review-text">"Kasun is not just a guide, he's a friend! He took us to his family
                            home for
                            authentic Sri Lankan dinner. An unforgettable experience!"</p>
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
                        <p class="mb-4 review-text">"Best guide in Sri Lanka! Kasun's passion for his country is
                            contagious. He
                            made us feel like VIPs everywhere we went."</p>
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

    <!-- Personal Touch Section -->
    <section class="personal-touch">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold mb-4">My Promise to You</h2>
                    <p class="mb-4">When you choose me as your Sri Lanka guide, you're not just getting a tour -
                        you're gaining a local friend who genuinely cares about making your Sri Lanka experience
                        extraordinary. I treat every guest like family because that's the Sri Lankan way - "Ayubowan"
                        (may you live long) isn't just a greeting, it's a blessing from the heart.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-certificate fa-2x text-primary mb-2"></i>
                            <p><strong>Licensed & Certified</strong><br>Sri Lanka Tourism Board</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-language fa-2x text-primary mb-2"></i>
                            <p><strong>5 Languages</strong><br>Sinhala, Tamil, English, German, Japanese</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                            <p><strong>24/7 Available</strong><br>Before, during & after your trip</p>
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
                    <h2 class="fw-bold mb-4">Ready to Explore Sri Lanka with Me?</h2>
                    <p class="mb-4">Let me create a personalized Sri Lanka adventure just for you. From ancient
                        temples to pristine beaches, from mountain tea estates to exciting safaris - I'll show you the
                        real Sri Lanka that tourists rarely see.</p>
                    <a href="#" class="btn btn-light btn-lg me-3">Plan My Trip</a>
                    <a href="#" class="btn btn-outline-light btn-lg">WhatsApp Me</a>
                </div>
            </div>
        </div>
    </section>
@endsection
