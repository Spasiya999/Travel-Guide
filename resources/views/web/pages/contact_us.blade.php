@extends('layouts.app')
@section('content')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        }

        .contact-form-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .contact-info-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 15px 40px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        .info-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-icon {
            font-size: 3rem;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .map-section {
            padding: 60px 0;
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h1 class="display-4 fw-bold mb-4">Contact Me</h1>
                    <h3 class="mb-4 carattere">Let's Plan Your Perfect Sri Lanka Adventure</h3>
                    <p class="lead mb-4">Ready to explore the pearl of the Indian Ocean? I'm here to help you create
                        unforgettable memories in Sri Lanka.</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-card">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-3">Send Me a Message</h2>
                            <p class="text-muted">Fill out the form below and I'll get back to you within 24 hours to start
                                planning your Sri Lanka journey.</p>
                        </div>

                        <form method="POST" action="{{ route('web.contact.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="firstName" class="form-label fw-bold">First Name *</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name"
                                        value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="lastName" class="form-label fw-bold">Last Name *</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name"
                                        value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label fw-bold">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label fw-bold">Phone Number *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="country" class="form-label fw-bold">Country *</label>
                                    <select class="form-control" id="country" name="country">
                                        <option value="">Select your country</option>
                                        <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>
                                            Australia</option>
                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada
                                        </option>
                                        <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany
                                        </option>
                                        <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan
                                        </option>
                                        <option value="United Kingdom"
                                            {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom
                                        </option>
                                        <option value="United States"
                                            {{ old('country') == 'United States' ? 'selected' : '' }}>United States
                                        </option>
                                        <option value="Other" {{ old('country') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="travelDates" class="form-label fw-bold">Preferred Travel Dates</label>
                                    <input type="text" class="form-control" id="travelDates" name="date"
                                        placeholder="e.g., March 2025" value="{{ old('date') }}">
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="tourType" class="form-label fw-bold">Tour Interest *</label>
                                <select class="form-control" id="tourType" name="service_id">
                                    <option value="">What interests you most?</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="groupSize" class="form-label fw-bold">Group Size *</label>
                                <select class="form-control" id="groupSize" name="group_size">
                                    <option value="">How many travelers?</option>
                                    <option value="1" {{ old('group_size') == '1' ? 'selected' : '' }}>Solo Traveler
                                    </option>
                                    <option value="2" {{ old('group_size') == '2' ? 'selected' : '' }}>Couple (2
                                        people)</option>
                                    <option value="3" {{ old('group_size') == '3' ? 'selected' : '' }}>Small Group
                                        (3-4 people)</option>
                                    <option value="5" {{ old('group_size') == '5' ? 'selected' : '' }}>Family/Friends
                                        (5-8 people)</option>
                                    <option value="8" {{ old('group_size') == '8' ? 'selected' : '' }}>Large Group
                                        (8+ people)</option>
                                </select>
                                @error('group_size')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label fw-bold">Your Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="6">{{ old('message') }}</textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="contact-info-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold mb-3">Get In Touch</h2>
                    <p class="mb-0">Multiple ways to reach me - I'm here to help plan your perfect Sri Lanka adventure
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Call Me</h5>
                        <p class="mb-2">+94 77 123 4567</p>
                        <p class="mb-0"><small>Available 7AM - 9PM (Sri Lanka Time)</small></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h5 class="fw-bold mb-3">WhatsApp</h5>
                        <p class="mb-2">+94 77 123 4567</p>
                        <p class="mb-0"><small>Quick responses & photo sharing</small></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Email Me</h5>
                        <p class="mb-2">kasun@srilankaguide.com</p>
                        <p class="mb-0"><small>Detailed trip planning & quotes</small></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Meet Me</h5>
                        <p class="mb-2">Kandy, Sri Lanka</p>
                        <p class="mb-0"><small>Can arrange pickup anywhere</small></p>
                    </div>
                </div>
            </div>

            <!-- Additional Contact Info -->
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Response Time</h5>
                        <p class="mb-1">Email: Within 4-6 hours</p>
                        <p class="mb-1">WhatsApp: Within 30 minutes</p>
                        <p class="mb-0">Emergency: Available 24/7</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Languages</h5>
                        <p class="mb-1">🇱🇰 Sinhala & Tamil (Native)</p>
                        <p class="mb-1">🇬🇧 English (Fluent)</p>
                        <p class="mb-1">🇩🇪 German & 🇯🇵 Japanese</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Certifications</h5>
                        <p class="mb-1">Licensed Tour Guide</p>
                        <p class="mb-1">Wildlife Safari Specialist</p>
                        <p class="mb-0">First Aid Certified</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold mb-3">Find Me in Sri Lanka</h2>
                    <p class="text-muted">Based in Kandy, but I can meet you anywhere in Sri Lanka</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63371.812148439845!2d80.59485658286865!3d7.290572992709947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae368a0113c1b69%3A0x1b7bb6552aa30e02!2sKandy%2C%20Sri%20Lanka!5e0!3m2!1sen!2s!4v1703123456789!5m2!1sen!2s"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 60px 0;">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h3 class="fw-bold mb-3">Ready to Start Your Sri Lanka Adventure?</h3>
                    <p class="mb-4">Don't wait - the best time to visit Sri Lanka is now! Contact me today and let's
                        create memories that will last a lifetime.</p>
                    <a href="tel:+94771234567" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-phone me-2"></i>Call Now
                    </a>
                    <a href="https://wa.me/94771234567" class="btn btn-outline-light btn-lg" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
