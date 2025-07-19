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
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">About ${info.name}</h6>

                                    <h6 class="text-primary mb-3">Highlights</h6>
                                    <div class="list-unstyled">
                                        ${info.description}
                                    </div>
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
