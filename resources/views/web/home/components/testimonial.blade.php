<style>
    .testimonials-container {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
    }

    .testimonials-carousel {
        flex: 1;
        min-width: 0;
    }

    .testimonial-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin: 0 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        height: auto;
        min-height: 280px;
    }

    .testimonial-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .testimonial-info h5 {
        color: #333;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .star-rating {
        color: #ffc107;
        font-size: 16px;
        margin-bottom: 0;
    }

    .testimonial-text {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .travel-date {
        color: #999;
        font-size: 14px;
        font-style: italic;
    }

    .main-layout {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .owl-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        pointer-events: none;
    }

    .owl-nav button {
        position: absolute;
        width: 50px;
        height: 50px;
        background: #4a90e2 !important;
        border-radius: 50%;
        border: none;
        color: white !important;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        pointer-events: all;
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }

    .owl-nav button:hover {
        background: #3a7bc8 !important;
        transform: scale(1.1);
    }

    .owl-prev {
        left: -25px;
    }

    .owl-next {
        right: -25px;
    }

    .owl-nav button span {
        font-size: 20px;
        font-weight: bold;
    }

    .owl-dots {
        text-align: center;
        margin-top: 30px;
    }

    .owl-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd;
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .owl-dot.active {
        background: #4a90e2;
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .main-layout {
            flex-direction: column;
            gap: 30px;
        }

        .section-title {
            font-size: 36px;
        }

        .section-subtitle {
            font-size: 24px;
        }

        .testimonials-section {
            padding: 60px 0;
        }
    }
</style>

<section class="testimonials-section">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="text-center text-primary mb-0 carattere" style="font-size: 28px;">Our Testimonials</h5>
            <h2 class="text-center fw-bold mb-4" style="font-size: 48px;">What they are talking about</h2>
        </div>

        <div class="testimonials-container">
            <div class="main-layout">
                <!-- Main Traveler Image -->
                <div class="testimonial-main-image">
                    <img src="{{ asset('frontend/img/testimonial.png') }}" class="w-100 rounded-4" alt="Main Traveler">
                </div>

                <div class="testimonials-carousel py-3">
                    <div class="owl-carousel owl-theme py-3" id="testimonialsCarousel">
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <svg class="testimonial-avatar" width="60" height="60" viewBox="0 0 60 60"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#fbbf24" />
                                    <circle cx="30" cy="22" r="12" fill="#8b4513" />
                                    <path d="M15 50 Q30 40 45 50" fill="#8b4513" />
                                    <circle cx="25" cy="20" r="2" fill="#000" />
                                    <circle cx="35" cy="20" r="2" fill="#000" />
                                    <path d="M25 25 Q30 28 35 25" stroke="#000" stroke-width="1" fill="none" />
                                </svg>
                                <div class="testimonial-info">
                                    <h5>Sarah Thompson</h5>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                            <p class="travel-date">Traveled December 2024</p>
                        </div>

                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <svg class="testimonial-avatar" width="60" height="60" viewBox="0 0 60 60"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#3b82f6" />
                                    <circle cx="30" cy="22" r="12" fill="#8b4513" />
                                    <path d="M15 50 Q30 40 45 50" fill="#8b4513" />
                                    <circle cx="25" cy="20" r="2" fill="#000" />
                                    <circle cx="35" cy="20" r="2" fill="#000" />
                                    <path d="M25 25 Q30 28 35 25" stroke="#000" stroke-width="1" fill="none" />
                                </svg>
                                <div class="testimonial-info">
                                    <h5>Tom Hardy</h5>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                            <p class="travel-date">Traveled December 2024</p>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <svg class="testimonial-avatar" width="60" height="60" viewBox="0 0 60 60"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#10b981" />
                                    <circle cx="30" cy="22" r="12" fill="#8b4513" />
                                    <path d="M15 50 Q30 40 45 50" fill="#8b4513" />
                                    <circle cx="25" cy="20" r="2" fill="#000" />
                                    <circle cx="35" cy="20" r="2" fill="#000" />
                                    <path d="M25 25 Q30 28 35 25" stroke="#000" stroke-width="1" fill="none" />
                                </svg>
                                <div class="testimonial-info">
                                    <h5>Emily Johnson</h5>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                            <p class="travel-date">Traveled December 2024</p>
                        </div>

                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <svg class="testimonial-avatar" width="60" height="60" viewBox="0 0 60 60"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#f59e0b" />
                                    <circle cx="30" cy="22" r="12" fill="#8b4513" />
                                    <path d="M15 50 Q30 40 45 50" fill="#8b4513" />
                                    <circle cx="25" cy="20" r="2" fill="#000" />
                                    <circle cx="35" cy="20" r="2" fill="#000" />
                                    <path d="M25 25 Q30 28 35 25" stroke="#000" stroke-width="1" fill="none" />
                                </svg>
                                <div class="testimonial-info">
                                    <h5>Michael Brown</h5>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                            <p class="travel-date">Traveled December 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#testimonialsCarousel").owlCarousel({
            items: 2,
            margin: 30,
            nav: true,
            dots: true,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: ['<span>‹</span>', '<span>›</span>'],
            responsive: {
                0: {
                    items: 1,
                    margin: 15
                },
                768: {
                    items: 1,
                    margin: 20
                },
                992: {
                    items: 2,
                    margin: 30
                }
            },
            onInitialized: function(event) {
                // Custom initialization if needed
            },
            onChanged: function(event) {
                $('.testimonial-card').removeClass('animate-in');
                setTimeout(function() {
                    $('.owl-item.active .testimonial-card').addClass('animate-in');
                }, 100);
            }
        });

        $('.testimonial-card').hover(
            function() {
                $(this).css('transform', 'translateY(-5px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );

        setTimeout(function() {
            $('.testimonial-card').css({
                'opacity': '1',
                'transform': 'translateY(0)'
            });
        }, 500);
    });
</script>

<style>
    /* Additional animations */
    .testimonial-card {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .animate-in {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    /* Owl carousel smooth transitions */
    .owl-carousel .owl-item {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .owl-carousel .owl-item.active {
        opacity: 1;
    }
</style>
