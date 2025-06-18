{{-- <div class="container my-5">
    <h5 class="text-center text-primary mb-0 carattere" style="font-size: 28px;">Wonderful Place for Your</h5>
    <h2 class="text-center fw-bold mb-4" style="font-size: 48px;">Most Popular Tour</h2>

    <div class="row justify-content-center">
        <div class="col-lg-3 col-6 mb-3 h-auto">
            <div class="card d-flex flex-column h-100 shadow-card border-0 rounded-4 px-2 pt-2">
                <img src="{{ asset('frontend/img/packges (3).png') }}" class="card-img-top rounded-4"
                    alt="Cultural Triangle">
                <div class="card-body d-flex flex-column px-2 py-3 justify-content-between">
                    <div>
                        <h5 class="card-title fw-bold font-14">Cultural Triangle Explorer</h5>
                        <p class="mb-1 font-12 texr-primary">7 Days / 6 Nights</p>
                        <p class="card-text mb-3" style="font-size: 13px;">Lorem Ipsum is simply dummy text of the
                            printing
                            and typesetting industry.</p>
                    </div>
                    <a href="#" class="btn btn-primary btn-smpx-3 py-1" style="font-size: 12px;">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-3 h-auto">
            <div class="card d-flex flex-column h-100 shadow-card border-0 rounded-4 px-2 pt-2">
                <img src="{{ asset('frontend/img/packges (3).png') }}" class="card-img-top rounded-4"
                    alt="Cultural Triangle">
                <div class="card-body d-flex flex-column px-2 py-3 justify-content-between">
                    <div>
                        <h5 class="card-title fw-bold font-14">Cultural Triangle Explorer</h5>
                        <p class="mb-1 font-12 texr-primary">7 Days / 6 Nights</p>
                        <p class="card-text mb-3" style="font-size: 13px;">Lorem Ipsum is simply dummy text of the
                            printing
                            and typesetting industry.</p>
                    </div>
                    <a href="#" class="btn btn-primary btn-smpx-3 py-1" style="font-size: 12px;">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-3 h-auto">
            <div class="card d-flex flex-column h-100 shadow-card border-0 rounded-4 px-2 pt-2">
                <img src="{{ asset('frontend/img/packges (3).png') }}" class="card-img-top rounded-4"
                    alt="Cultural Triangle">
                <div class="card-body d-flex flex-column px-2 py-3 justify-content-between">
                    <div>
                        <h5 class="card-title fw-bold font-14">Cultural Triangle Explorer</h5>
                        <p class="mb-1 font-12 texr-primary">7 Days / 6 Nights</p>
                        <p class="card-text mb-3" style="font-size: 13px;">Lorem Ipsum is simply dummy text of the
                            printing
                            and typesetting industry.</p>
                    </div>
                    <a href="#" class="btn btn-primary btn-smpx-3 py-1" style="font-size: 12px;">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-3 h-auto">
            <div class="card d-flex flex-column h-100 shadow-card border-0 rounded-4 px-2 pt-2">
                <img src="{{ asset('frontend/img/packges (3).png') }}" class="card-img-top rounded-4"
                    alt="Cultural Triangle">
                <div class="card-body d-flex flex-column px-2 py-3 justify-content-between">
                    <div>
                        <h5 class="card-title fw-bold font-14">Cultural Triangle Explorer</h5>
                        <p class="mb-1 font-12 texr-primary">7 Days / 6 Nights</p>
                        <p class="card-text mb-3" style="font-size: 13px;">Lorem Ipsum is simply dummy text of the
                            printing
                            and typesetting industry.</p>
                    </div>
                    <a href="#" class="btn btn-primary btn-smpx-3 py-1" style="font-size: 12px;">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container my-5">
    <h5 class="text-center text-primary mb-0 carattere" style="font-size: 28px;">Wonderful Place for Your</h5>
    <h2 class="text-center fw-bold mb-4" style="font-size: 48px;">Most Popular Tour</h2>

    <div class="row justify-content-center">
        @foreach ($services as $service)
            <div class="col-lg-3 col-6 mb-3 h-auto">
                <div class="card d-flex flex-column h-100 shadow-card border-0 rounded-4 px-2 pt-2">
                    <img src="{{ $service->image ? asset($service->image) : asset('frontend/img/packges (3).png') }}"
                        class="card-img-top rounded-4" alt="{{ $service->title ?? 'Service' }}">
                    <div class="card-body d-flex flex-column px-2 py-3 justify-content-between">
                        <div>
                            <h5 class="card-title fw-bold font-14">{{ $service->title ?? 'Service Title' }}</h5>
                            <p class="mb-1 font-12 texr-primary">{{ $service->duration ?? '' }}</p>
                            <div class="card-text mb-3" style="font-size: 13px;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 100) }}
                            </div>
                        </div>
                        <a href="{{ route('web.packages', ['category' => $service->category_id]) }}"
                            class="btn btn-primary btn-smpx-3 py-1" style="font-size: 12px;">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
