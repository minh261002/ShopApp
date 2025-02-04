<div class="w-100 bg-white">
    @if (count($product->variations) > 0)
        <input type="hidden" name="product_variation_id" value="{{ $product->variations->first()->id }}">
    @endif
    <input type="hidden" name="product_name" value="{{ $product->name }}">
    <input type="hidden" name="product_image" value="{{ $product->image }}">
    <input type="hidden" name="product_slug" value="{{ $product->slug }}">

    <div class="d-flex flex-column gap-3">
        <h1 class="fs-28px mb-0 fw-bold text-dark">
            {{ $product->name }}
            <br />
            <span class="fs-16px fw-medium text-secondary" id="variation-sku">
                @if (count($product->variations) > 0)
                    SKU: {{ $product->variations->first()->sku }}
                @else
                    Không có thông tin
                @endif
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

        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                @if (count($product->variations) > 0)
                    @if ($product->variations->first()->sale_price)
                        <input type="hidden" name="price" value="{{ $product->variations->first()->price }} " />
                        <span class="text-red fs-28px fw-bold">
                            {{ format_price($product->variations->first()->sale_price) }}
                        </span>
                        <span class="text-muted fs-20px text-decoration-line-through text-secondary fw-medium">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @else
                        <input type="hidden" name="price" value="{{ $product->variations->first()->price }} " />
                        <span class="text-danger fs-28px fw-bold">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @endif
                @else
                    <span class="text-danger fs-28px fw-bold">
                        Liên hệ
                    </span>
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between gap-4">
            @foreach ($groupedAttributes as $attributeName => $values)
                <div class="flex-grow-1" id="variation-{{ Str::slug($attributeName) }}">
                    <label class="form-label fw-medium">{{ $attributeName }}</label>
                    <select class="form-select" name="variation_values[{{ $attributeName }}][]" required>
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
                    @if (count($product->variations) > 0)
                        <span class="text-secondary" id="stock">Còn
                            {{ $product->variations->first()->stock }}
                            sản phẩm</span>
                    @endif
                </div>
            </div>
        </div>

        @if (count($product->variations) > 0)
            <div class="d-flex gap-3">
                @if (auth()->guard('web')->check())
                    <button type="button" class="btn bg-red-lt w-100 fs-18px" id="addToWishlist">
                        <i class="ti ti-heart fs-20px me-1"></i>
                        Yêu thích
                    </button>
                    <button class="btn bg-red text-white w-100 fs-18px" id="addToCart">
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
        @endif

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
        $('#addToCart').on('click', function() {
            $(this).html(
                '<i class="spinner-border spinner-border-sm me-2"></i> Đang xử lý...'
            );
        });

        $('#addToWishlist').on('click', function() {
            $(this).html(
                '<i class="spinner-border spinner-border-sm me-2"></i> Đang xử lý...'
            );
        });

        const format_price = (price) => {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        }

        $('input[name="quantity"]').val(1);

        $('#increment').on('click', function() {
            let quantity = parseInt($('input[name="quantity"]').val());
            let stock = parseInt('{{ $product->variations->first()->stock ?? 0 }}');

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
