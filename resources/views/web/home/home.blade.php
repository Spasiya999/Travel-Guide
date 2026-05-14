@extends('layouts.app')
@include('layouts.meta')
@section('content')
    @include('web.home.components.hero')

    @include('web.home.components.categories')

    @include('web.home.components.packages')

    @include('web.home.components.about_us')

    @include('web.home.components.destination')

    @include('web.home.components.testimonial')

    @include('web.home.components.gallery')
@endsection

@section('scripts')
    <script>
        function showDestination(id) {
            const modalBody = document.getElementById('modalBody');
            const modalTitle = document.getElementById('destinationModalLabel');

            $.ajax({
                url: '{{ route('web.get.places') }}',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    if (response.success) {
                        const info = response.data;
                        console.log(info);
                        modalTitle.textContent = info.name;

                        modalBody.innerHTML = `
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <img src="/${info.image}" class="img-fluid rounded shadow-sm" alt="${info.name}" style="width: 100%; height: 250px; object-fit: cover;">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold text-primary mb-2">${info.name}</h5>
                                    <p class="text-muted mb-4" style="text-align: justify;">${info.description}</p>
                                    
                                    ${info.spots ? `
                                        <h6 class="fw-bold mb-3"><i class="fas fa-map-marked-alt text-primary me-2"></i>Spots & Activities</h6>
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            ${info.spots.split(',').map(spot => `<span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 border border-primary border-opacity-25">${spot.trim()}</span>`).join('')}
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;

                        const modal = new bootstrap.Modal(document.getElementById('destinationModal'));
                        modal.show();
                    } else {
                        console.error('Error fetching destination details:', response.message);
                    }
                },
                error: function () {
                    alert('An error occurred while fetching destination details.');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
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
@endsection
