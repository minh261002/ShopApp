@foreach ($flashSales as $flashSale)
    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
        <h1 class="mb-0 text-danger fs-4 fw-semibold text-uppercase">{{ $flashSale->title }}</h1>
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
    </div>

    <div class="owl-carousel owl-theme">
        {{-- <div class="item">
            <h4>1</h4>
        </div> --}}
        @foreach ($flashSale->items as $item)
            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="img-fluid">
        @endforeach
    </div>
@endforeach

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
@endpush
