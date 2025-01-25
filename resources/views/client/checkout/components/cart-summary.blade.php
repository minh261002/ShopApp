 <h2 class="text-left fw-bold mb-3">Đơn hàng</h2>

 <div class="card">
     <div class="card-body">

         <div class="mb-4">
             <label class="form-label fw-semibold mb-2">
                 MÃ PHIẾU GIẢM GIÁ
             </label>
             @include('client.checkout.components.cart-apply-voucher')

             <p class="text-sm mt-2">
                 Kiểm tra
                 <a href="#" class="text-success text-decoration-underline">
                     Phiếu giảm giá của tôi
                 </a>
             </p>
         </div>

         <hr class="border-dashed mb-4 border-dark" />

         <div class="space-y-3 mb-4">
             <div class="d-flex justify-content-between text-sm">
                 <span class="text-muted">Tạm tính</span>
                 <span class="fw-semibold" id="subTotal">{{ number_format($subTotal) }}đ</span>
             </div>
             <div class="d-flex justify-content-between text-sm">
                 <span class="text-muted">Phí vận chuyển</span>
                 <span class="fw-semibold">0đ</span>
             </div>
             <div class="d-flex justify-content-between text-sm">
                 <span class="text-muted">Mã giảm giá</span>
                 <span class="fw-semibold text-danger">-0đ</span>
             </div>
         </div>

         <hr class="border-dashed mb-4 border-dark" />

         <div class="d-flex justify-content-between align-items-center fs-4 fw-bold text-danger mb-4">
             <span>Tổng thanh toán</span>
             <span id="total">{{ number_format($totalPrice) }}đ</span>
         </div>

         <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100">
             Tiến hành thanh toán
         </a>
     </div>
 </div>
