<div class="pb-5 w-100">
    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
        <h1 class="mb-0 text-danger fs-20px fw-semibold text-uppercase">Sản phẩm mới ra mắt</h1>
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
    </div>
    <div class="row">
        <div class="owl-carousel owl-theme">
            @foreach ($newProducts as $item)
                <div class="card border-0">
                    <div class="card-body p-0 border-gray rounded-2">
                        <div class="img-wrapper" style="height: 340px; object-fit: cover;">
                            <a href="{{ route('product.detail', $item->slug) }}">
                                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-100 h-100 rounded-2">
                            </a>
                        </div>

                        <div class="d-flex flex-column mt-3 px-3">
                            <div class="d-flex mb-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="ti ti-star text-yellow"></i>
                                @endfor
                            </div>

                            <a href="{{ route('product.detail', $item->slug) }}"
                                class="text-dark fs-14px fw-normal text-decoration-none">
                                {{ limit_text($item->name, 30) }}
                            </a>

                            <div class="d-flex align-items-center justify-content-between">
                                @if ($item->variations->first()->sale_price)
                                    <p class="mb-0 text-danger fs-18px fw-semibold">
                                        {{ format_price($item->variations->first()->sale_price) }}
                                    </p>
                                    <p class="mb-0 text-muted fs-14px text-decoration-line-through">
                                        {{ format_price($item->variations->first()->price) }}
                                    </p>
                                @else
                                    <p class="mb-0 text-danger fs-18px fw-semibold">
                                        {{ format_price($item->variations->first()->price) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5 text-center w-100">
            <a href="" class="btn btn-danger text-uppercase">Xem tất cả sản phẩm</a>
        </div>
    </div>
</div>

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
