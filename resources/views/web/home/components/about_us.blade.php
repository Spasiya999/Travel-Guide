<style>
    .main-container {
        background: linear-gradient(135deg, #87CEEB 0%, #4A90E2 100%);
    }

    .travel-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 200px;
        position: relative;
    }

    .travel-card:hover {
        transform: translateY(-5px);
    }

    .travel-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .about-section {
        color: white;
        padding: 20px 0;
    }

    .about-title {
        font-style: italic;
        font-size: 1.2em;
        margin-bottom: 10px;
        opacity: 0.9;
    }

    .main-heading {
        font-size: 2.8em;
        font-weight: bold;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .description-text {
        font-size: 0.95em;
        line-height: 1.6;
        margin-bottom: 30px;
        opacity: 0.95;
    }

    .feature-box {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .feature-icon {
        font-size: 2.5em;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 10px;
    }

    .feature-title {
        font-size: 1.3em;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .feature-text {
        font-size: 0.9em;
        opacity: 0.9;
    }

    .dashed-line {
        position: absolute;
        top: 60px;
        right: 60px;
        width: 200px;
        height: 150px;
        border: 3px dashed rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        transform: rotate(-20deg);
    }

    .airplane-icon {
        position: absolute;
        top: -10%;
        right: 22%;
    }

    @media (max-width: 768px) {
        .main-heading {
            font-size: 2.2em;
        }

        .travel-card {
            height: 150px;
            margin-bottom: 15px;
        }

        .airplane-icon {
            position: absolute;
            top: -15%;
            right: 0%;
        }
    }
</style>
<div class="main-container py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left side - Images -->
            <div class="col-lg-5 col-md-6">
                <div class="row">
                    <div class="col-md-6 col-12 d-flex justify-content-between flex-column mb-3">
                        <img src="{{ asset('frontend/img/about_us (3).png') }}" alt="Tropical Island Paradise"
                            class="h-100 w-auto object-cover rounded-15 mb-3">
                        <img src="{{ asset('frontend/img/about_us (1).png') }}" alt="Ancient Temple">
                    </div>
                    <div class="col-md-6 col-12">
                        <img src="{{ asset('frontend/img/about_us (2).png') }}" alt="Palm Trees Landscape"
                            class="w-100">
                    </div>
                </div>
            </div>

            <!-- Right side - Content -->
            <div class="col-lg-6 col-md-6 offset-lg-1">
                <div class="about-section position-relative">
                    <!-- Decorative elements -->
                    <img src="{{ asset('frontend/img/plane.png') }}" alt="Airplane Icon" class="airplane-icon">

                    <div class="carattere" style="font-size: 28px;">About Us</div>
                    <h1 class="main-heading">Great opportunity for <br /> Adventure & Travels</h1>

                    <p class="description-text">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley of type and scrambled it to make
                        a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem
                        Ipsum passages, and more recently with desktop publishing software like Aldus
                        PageMaker including versions of Lorem Ipsum.
                    </p>

                    <a href="{{ route('web.packages') }}" class="btn btn-primary px-4 rounded">Start Your Journey</a>
                </div>
            </div>
        </div>
    </div>
</div>
