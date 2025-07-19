<div class="container my-5">
    <h5 class="text-center text-primary mb-0 carattere" style="font-size: 28px;">Me be Your Tour More Places</h5>
    <h2 class="text-center fw-bold mb-4" style="font-size: 48px;">Recent Gallery</h2>

    <div class="row justify-content-center">
        @foreach ($galleries as $index => $gallery)
            <div class="col-md-4 col-12 mb-3">
                <img src="{{ asset($gallery->image) }}" class="w-100 rounded-4" alt="">
            </div>
        @endforeach
    </div>
</div>
