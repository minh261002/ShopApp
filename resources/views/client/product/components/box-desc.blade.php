<div class="w-100">
    <div class="container">
        {{-- <div style="max-width:700px; margin:0 auto"> --}}
        <div class="accordion" id="accordion-desc">
            <div class="accordion-item">
                <h2 class="accordion-header bg-red-lt" id="heading-1">
                    <p class="mb-0 fs-20px accordion-button collapsed text-red" type="button" data-bs-toggle="collapse"
                        data-bs-target="#desc" aria-expanded="false">
                        Mô tả sản phẩm
                    </p>
                </h2>
                <div id="desc" class="accordion-collapse collapse show pt-5" data-bs-parent="#accordion-example"
                    style="">
                    <div class="accordion-body pt-0">
                        {!! $product->desc !!}
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
