<div class="card mb-5">
    <div class="card-header">
        <h2 class="card-title text-left fw-bold">Thanh toán & Giao hàng</h2>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
            <select name="payment_method" id="payment_method" class="form-control">
                @foreach ($payment_methods as $key => $payment_method)
                    <option value="{{ $key }}">{{ $payment_method }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="shipping_method" class="form-label">Phương thức vận chuyển</label>
            <select name="shipping_method" id="shipping_method" class="form-control">
                @foreach ($shipping_methods as $key => $shipping_method)
                    <option value="{{ $key }}">{{ $shipping_method }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h2 class="card-title text-left fw-bold">Thành tiền</h2>
    </div>

    <div class="card-body">
        <div class="mb-4">
            <label class="form-label fw-semibold mb-2">
                MÃ PHIẾU GIẢM GIÁ
            </label>
            @include('client.checkout.components.cart-apply-voucher')

            <p class="text-sm mt-2">
                Kiểm tra
                <a href="{{ route('profile.discount') }}" class="text-success text-decoration-underline">
                    Phiếu giảm giá của tôi
                </a>
            </p>
        </div>

        <hr class="border-dashed mb-4 border-dark" />

        <div class="space-y-3 mb-4">
            <div class="d-flex justify-content-between text-sm">
                <span class="text-muted">Tạm tính</span>
                <span class="fw-semibold" id="subTotal">{{ number_format($subTotal) }} đ</span>
            </div>
            <div class="d-flex justify-content-between text-sm">
                <span class="text-muted">Phí vận chuyển</span>
                <span class="fw-semibold" id="shipping_fee">0 đ</span>
            </div>
            <input type="hidden" name="shipping_fee" value="0">

            <div class="d-flex justify-content-between text-sm">
                <span class="text-muted">Mã giảm giá</span>
                <span class="fw-semibold text-danger" id="discount">-0 đ</span>
            </div>
            <input type="hidden" name="discount_amount" value="0">
        </div>

        <hr class="border-dashed mb-4 border-dark" />

        <div class="d-flex justify-content-between align-items-center fs-4 fw-bold text-danger mb-4">
            <span>Tổng thanh toán</span>
            <span id="total">{{ number_format($totalPrice) }} đ</span>
        </div>

        <button type="submit" class="btn btn-danger w-100">
            Tiến hành thanh toán
        </button>
    </div>
</div>
