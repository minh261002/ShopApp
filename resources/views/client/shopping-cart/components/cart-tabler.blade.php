<h1 class="text-left fw-bold mb-4">Giỏ hàng</h1>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>
                            <img src="{{ $item['product_image'] }}" alt="" class="img-fluid"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        </td>

                        <td class="text-secondary">
                            <a href="{{ route('product.detail', $item['product_slug']) }}"
                                class="fs-16px fw-bold text-reset">
                                {{ $item['product_name'] }}
                            </a>

                            @foreach ($item['variation_values'] as $key => $value)
                                <div class="text-secondary">
                                    {{ $key }}: {{ implode(', ', $value) }}
                                </div>
                            @endforeach
                        </td>

                        <td class="text-secondary">
                            {{ format_price($item['price']) }}
                        </td>

                        <td class="text-secondary w-25">
                            <div class="d-flex align-items-center justify-content-start position-relative">
                                <button class="btn btn-icon bg-red-lt" id="decrease-quantity">
                                    <i class="ti ti-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center w-25"
                                    value="{{ $item['quantity'] }}" readonly>
                                <button class="btn btn-icon bg-red-lt" id="increase-quantity">
                                    <i class="ti ti-plus"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            {{ format_price($item['price'] * $item['quantity']) }}
                        </td>
                        <td>
                            <a href="{{ route('cart.destroy', $item['product_variation_id']) }}">
                                <i class="ti ti-trash fs-20px text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script></script>
@endpush
