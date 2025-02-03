<div class="card">
    <div class="card-header">
        <h2 class="card-title text-left fw-bold">Thông tin giỏ hàng</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
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

                        <td class="text-secondary">
                            {{ $item['quantity'] }}
                        </td>
                        <td>
                            {{ format_price($item['price'] * $item['quantity']) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
@endpush
