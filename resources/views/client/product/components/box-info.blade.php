{{-- @php
    session()->forget('cart');
@endphp --}}

<div class="w-100 bg-white">
    <input type="hidden" name="product_variation_id" value="{{ $product->variations->first()->id }}">

    <div class="d-flex flex-column gap-3">
        <h1 class="fs-28px mb-0 fw-bold text-dark">
            {{ $product->name }}
            <br />
            <span class="fs-16px fw-medium text-secondary" id="variation-sku">
                SKU: {{ $product->variations->first()->sku }}
            </span>
        </h1>

        <div>
            {{ $product->short_desc }}
        </div>

        <div class="d-flex align-items-center justify-content-start gap-2">
            <div class="d-flex align-items-center justify-content-start gap-1">
                @for ($i = 0; $i < 5; $i++)
                    <i class="ti ti-star text-yellow"></i>
                @endfor
            </div>
            <span>(11 Đánh giá)</span>
        </div>

        @if ($product->flashSale && $product->flashSale->first()->items()->first()->product_id == $product->id)
            <div class="d-flex align-items-center justify-content-between">"
                <div class="card w-100">
                    <div class="card-header bg-red-lt text-white py-2">
                        <h4 class="mb-0 text-center">
                            {{ $product->flashSale->first()->title }}
                        </h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="row text-center">
                            <div class="col-3">
                                <h3 id="days" class="display-4 mb-0 text-red fw-bold">00</h3>
                            </div>
                            <div class="col-3">
                                <h3 id="hours" class="display-4 mb-0 text-red fw-bold">00</h3>
                            </div>
                            <div class="col-3">
                                <h3 id="minutes" class="display-4 mb-0 text-red fw-bold">00</h3>
                            </div>
                            <div class="col-3">
                                <h3 id="seconds" class="display-4 mb-0 text-red fw-bold">00</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    const countDownDate = new Date('{{ $product->flashSale->first()->end_date }}').getTime();
                    const x = setInterval(function() {
                        const now = new Date().getTime();

                        const distance = countDownDate - now;

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
                        document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
                        document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
                        document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("days").innerHTML = "00";
                            document.getElementById("hours").innerHTML = "00";
                            document.getElementById("minutes").innerHTML = "00";
                            document.getElementById("seconds").innerHTML = "00";
                        }
                    }, 1000);
                </script>
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                @if ($product->flashSale && $product->flashSale->first()->items()->first()->product_id == $product->id)
                    @if ($product->variations->first()->sale_price)
                        <input type="hidden" name="price"
                            value="  {{ ($product->variations->first()->price * (100 - $product->flashSale->first()->items()->first()->discount)) / 100 }} " />
                        <span class="text-red fs-28px fw-bold">
                            {{ format_price(($product->variations->first()->price * (100 - $product->flashSale->first()->items()->first()->discount)) / 100) }}
                        </span>

                        <span class="text-muted fs-20px text-decoration-line-through text-secondary fw-medium">
                            {{ format_price($product->variations->first()->sale_price) }}
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @endif
                @else
                    @if ($product->variations->first()->sale_price)
                        <input type="hidden" name="price" value="{{ $product->variations->first()->sale_price }}" />

                        <span class="text-red fs-28px fw-bold">
                            {{ format_price($product->variations->first()->sale_price) }}
                        </span>
                        <span class="text-muted fs-20px text-decoration-line-through text-secondary fw-medium">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @else
                        <input type="hidden" name="price" value="{{ $product->variations->first()->price }}" />

                        <span class="text-danger fs-24px fw-bold">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @endif
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between gap-4">
            @foreach ($groupedAttributes as $attributeName => $values)
                <div class="flex-grow-1" id="variation-{{ Str::slug($attributeName) }}">
                    <label class="form-label fw-medium">{{ $attributeName }}</label>
                    <select class="form-select" name="variation_values[{{ Str::slug($attributeName) }}][]" required>
                        @foreach ($values as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <div>
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modal-simple">
                <i class="ti ti-ruler-2 fs-18px me-1"></i>
                Hướng dẫn chọn kích thước
            </a>
        </div>

        <div class="w-100">
            <label class="form-label fw-medium">Số lượng</label>

            <div class="d-flex align-items-center position-relative justify-content-between">
                <div class="d-flex align-items-center position-relative">
                    <button type="button" class="btn bg-red text-white position-absolute py-2 ms-1" id="decrement">
                        <i class="ti ti-minus"></i>
                    </button>
                    <input type="number" name="quantity" class="form-control text-center" value="1" min="1"
                        step="1" readonly>
                    <button type="button" class="btn bg-red text-white position-absolute py-2 end-0 me-1"
                        id="increment">
                        <i class="ti ti-plus"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center gap-2 ms-3">
                    <i class="ti ti-building-warehouse fs-18px me-1"></i>
                    <span class="text-secondary" id="stock">Còn
                        {{ $product->variations->first()->stock }}
                        sản phẩm</span>
                </div>
            </div>
        </div>

        <div class="d-flex gap-3">
            @if (auth()->guard('web')->check())
                <button class="btn bg-red-lt w-100 fs-18px">
                    <i class="ti ti-heart fs-20px me-1"></i>
                    Yêu thích
                </button>
                <button class="btn bg-red text-white w-100 fs-18px">
                    <i class="ti ti-shopping-cart fs-20px me-1"></i>
                    Thêm vào giỏ hàng
                </button>
            @else
                <a href="{{ route('login', ['redirect' => route('product.detail', $product->slug)]) }}"
                    class="btn bg-red-lt w-100 fs-18px">
                    <i class="ti ti-login fs-20px me-1"></i>
                    Bạn cần đăng nhập
                </a>
            @endif
        </div>

        <div class="d-flex align-items-stretch">
            <div class="flex-grow-1 d-flex flex-column align-items-center gap-2 text-center">
                <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1735367737/Pengu/delivery_yhvchy.svg"
                    width="50" height="auto" class="object-fit-cover">
                <span class="text-secondary fs-14px fw-bold">Giao hàng toàn quốc</span>
            </div>

            <div class="flex-grow-1  d-flex flex-column align-items-center gap-2 text-center">
                <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1735367738/Pengu/cash_yh8ysr.svg"
                    width="35" height="auto" class="object-fit-cover">
                <span class="text-secondary fs-14px fw-bold">Thanh toán khi nhận hàng</span>
            </div>

            <div class="flex-grow-1  d-flex flex-column align-items-center gap-2 text-center">
                <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1735367737/Pengu/back_dsc2yw.svg"
                    width="35" height="auto" class="object-fit-cover">
                <span class="text-secondary fs-14px fw-bold">Đổi trả miễn phí</span>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hướng dẫn chọn kích thước</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('uploads/images/17341036337427596.webp') }}" class="w-100" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        const format_price = (price) => {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        }

        //increment and decrement quantity

        $('input[name="quantity"]').val(1);

        $('#increment').on('click', function() {
            let quantity = parseInt($('input[name="quantity"]').val());
            let stock = parseInt('{{ $product->variations->first()->stock }}');

            if (quantity < stock) {
                quantity++;
                $('input[name="quantity"]').val(quantity);
            }
        });

        $('#decrement').on('click', function() {
            let quantity = parseInt($('input[name="quantity"]').val());

            if (quantity > 1) {
                quantity--;
                $('input[name="quantity"]').val(quantity);
            }
        });

        @foreach ($groupedAttributes as $attributeName => $values)
            $('#variation-{{ Str::slug($attributeName) }} select').on('change', function() {
                let data = {};

                @foreach ($groupedAttributes as $attributeName => $values)
                    data['{{ Str::slug($attributeName) }}'] = $(
                        '#variation-{{ Str::slug($attributeName) }} select').val();
                @endforeach

                $.ajax({
                    url: '{{ route('product.variation.get') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: data,
                        product_id: '{{ $product->id }}'
                    },
                    success: function(response) {
                        $('input[name="product_variation_id"]').val(response.variation.id);

                        $('#variation-sku').text('SKU: ' + response.variation.sku);

                        if (response.variation.sale_price) {
                            $('.text-red').text(format_price(response.variation.sale_price));
                            $('.text-muted').text(format_price(response.variation.price));
                            $('input[name="price"]').val(response.variation.sale_price);
                        } else {
                            $('.text-danger').text(format_price(response.variation.price));
                            $('input[name="price"]').val(response.variation.price);
                        }

                        $('#stock').text('Còn ' + response.variation.stock + ' sản phẩm');

                        if (parseInt($('input[name="quantity"]').val()) > response.variation.stock) {
                            $('input[name="quantity"]').val(response.variation.stock);
                        }

                        if (response.variation.stock === 0) {
                            $('button[type="submit"]').prop('disabled', true);
                        } else {
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    }
                });
            });
        @endforeach
    </script>
@endpush
