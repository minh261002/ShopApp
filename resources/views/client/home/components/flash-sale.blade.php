@foreach ($flashSales as $flashSale)
    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
        <h1 class="mb-0 text-danger fs-20px fw-semibold text-uppercase">{{ $flashSale->title }}</h1>
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
    </div>

    <div class="owl-carousel owl-theme">
        @foreach ($flashSale->items as $item)
            <div class="card border-0">
                <div class="card-body p-0 border-gray rounded-2">
                    <div class="img-wrapper" style="height: 300px; object-fit: cover;">
                        <a href="">
                            <img src="{{ $item->product->image }}" alt="{{ $item->name }}"
                                class="w-100 h-100 rounded-2">
                        </a>
                        <div>
                            <span
                                class="badge bg-danger text-white fw-semibold fs-14px position-absolute top-0 start-0 m-2">
                                -{{ $item->discount }}%
                            </span>
                        </div>
                    </div>

                    <div class="d-flex flex-column mt-3 px-3">
                        <div class="d-flex mb-1">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="ti ti-star text-yellow"></i>
                            @endfor
                        </div>

                        <a href="" class="text-dark fs-14px fw-normal text-decoration-none">
                            {{ limit_text($item->product->name, 30) }}
                        </a>

                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 text-danger fs-18px fw-semibold">
                                {{ format_price(($item->product->variations->first()->price * (100 - $item->discount)) / 100) }}
                            <p class="mb-0 text-muted fs-14px text-decoration-line-through">
                                {{ format_price($item->product->variations->first()->price) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
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
