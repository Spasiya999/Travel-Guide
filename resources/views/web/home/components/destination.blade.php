<style>
    .destination-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        height: 250px;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .destination-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .destination-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.2));
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }

    .destination-name {
        color: white;
        font-size: 20px;
        font-weight: 600;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .location-icon {
        font-size: 20px;
    }

    .nine-arch {
        background-image: url('{{asset('frontend/img/desti (1).png')}}');
    }

    .sigiriya {
        background-image: url('{{asset('frontend/img/desti (2).png')}}');
    }

    .kandy {
        background-image: url('{{asset('frontend/img/desti (3).png')}}');
    }

    .galle {
        background-image: url('{{asset('frontend/img/desti (4).png')}}');
    }

    .yala {
        background-image: url('{{asset('frontend/img/desti (5).png')}}');
    }

    .nuwara-eliya {
        background-image: url('{{asset('frontend/img/desti (6).png')}}');
    }

    .text-primary-custom {
        color: #4a90e2 !important;
    }

    .main-title {
        font-weight: 700;
        color: #333;
        letter-spacing: -1px;
    }

    .container {
        max-width: 1200px;
    }

    @media (max-width: 768px) {
        .destination-card {
            height: 200px;
            margin-bottom: 20px;
        }

        .destination-name {
            font-size: 18px;
        }

        .main-title {
            font-size: 2.2rem !important;
        }
    }
</style>
<div class="container my-5">
    <h5 class="text-center text-primary-custom mb-0 carattere" style="font-size: 28px;">Visit Sri Lanka
    </h5>
    <h2 class="text-center main-title mb-5" style="font-size: 48px;">Top Destinations in Sri Lanka</h2>

    <div class="row justify-content-center g-4">

        <div class="col-lg-4 col-md-6">
            <div class="destination-card nine-arch" onclick="showDestination('Nine Arch Bridge')">
                <div class="destination-overlay">
                    <h3 class="destination-name">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        Nine Arch Bridge
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="destination-card sigiriya" onclick="showDestination('Sigiriya')">
                <div class="destination-overlay">
                    <h3 class="destination-name">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        Sigiriya
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="destination-card kandy" onclick="showDestination('Kandy')">
                <div class="destination-overlay">
                    <h3 class="destination-name">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        Kandy
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="destination-card galle" onclick="showDestination('Galle')">
                <div class="destination-overlay">
                    <h3 class="destination-name">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        Galle
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="destination-card yala" onclick="showDestination('Yala')">
                <div class="destination-overlay">
                    <h3 class="destination-name">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        Yala
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="destination-card nuwara-eliya" onclick="showDestination('Nuwara Eliya')">
                <div class="destination-overlay">
                    <h3 class="destination-name">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        Nuwara Eliya
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="destinationModal" tabindex="-1" aria-labelledby="destinationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="destinationModalLabel">Destination Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const destinationInfo = {
        'Nine Arch Bridge': {
            description: 'A stunning railway bridge in Ella, famous for its nine stone arches surrounded by lush greenery and tea plantations.',
            highlights: ['Historic railway bridge', 'Scenic train rides', 'Tea plantation views',
                'Photography hotspot'
            ]
        },
        'Sigiriya': {
            description: 'An ancient rock fortress and archaeological site, known as the "Lion Rock" - a UNESCO World Heritage Site.',
            highlights: ['Ancient palace ruins', 'Climbing experience', 'Historical significance',
                'Panoramic views'
            ]
        },
        'Kandy': {
            description: 'The cultural capital of Sri Lanka, home to the Temple of the Sacred Tooth Relic and beautiful lake views.',
            highlights: ['Sacred temples', 'Cultural shows', 'Lake walks', 'Traditional crafts']
        },
        'Galle': {
            description: 'A historic coastal city featuring Dutch colonial architecture and a well-preserved fort by the ocean.',
            highlights: ['Colonial architecture', 'Fort walls', 'Beach views', 'Art galleries']
        },
        'Yala': {
            description: 'Sri Lanka\'s most famous national park, renowned for its high density of leopards and diverse wildlife.',
            highlights: ['Wildlife safari', 'Leopard spotting', 'Bird watching', 'Natural landscapes']
        },
        'Nuwara Eliya': {
            description: 'Known as "Little England," this hill station offers cool climate, tea estates, and colonial charm.',
            highlights: ['Tea plantations', 'Cool climate', 'Colonial architecture', 'Strawberry farms']
        }
    };

    function showDestination(name) {
        const info = destinationInfo[name];
        const modalBody = document.getElementById('modalBody');
        const modalTitle = document.getElementById('destinationModalLabel');

        modalTitle.textContent = name;
        modalBody.innerHTML = `
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">About ${name}</h6>
                        <p class="mb-4">${info.description}</p>

                        <h6 class="text-primary mb-3">Highlights</h6>
                        <ul class="list-unstyled">
                            ${info.highlights.map(highlight => `
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        ${highlight}
                                    </li>
                                `).join('')}
                        </ul>
                    </div>
                </div>
            `;

        const modal = new bootstrap.Modal(document.getElementById('destinationModal'));
        modal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.destination-card');

        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';

            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
