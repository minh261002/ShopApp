<div class="pb-5 w-100 bg-white">
    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
        <h1 class="mb-0 text-danger fs-20px fw-semibold text-uppercase">Mã giảm giá hot</h1>
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($homeDiscounts as $discount)
            <div class="col-6 col-md-4">
                <div class="bg-red-lt w-100 rounded-xl d-flex">

                    <div class="d-flex flex-column  p-4 gap-3 w-100">
                        <h1 class="mb-0 fs-20px fw-bold text-danger">
                            {{ $discount->code }}
                        </h1>
                        <p class="mb-0 fs-14px text-secondary">
                            {{ $discount->description }}
                        </p>
                        <p class="mb-0 fs-14px text-secondary">Hết hạn: {{ formatDate($discount->date_end) }}</p>
                    </div>

                    <div class="d-flex flex-column justify-content-center position-relative w-50 border-start border-2 border-dashed border-gray p-3"
                        style="width:45%; max-width:40%;">
                        <div class="position-absolute bg-white rounded-circle"
                            style="width:45px; height:45px; top:-15%; left:-20%;"></div>
                        <button class="btn btn-danger text-white px-4 py-2">
                            Copy
                        </button>
                        <div class="position-absolute bg-white rounded-circle"
                            style="width:45px; height:45px; bottom:-15%; left:-20%;"></div>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-100 alert alert-light" role="alert">
                Không có mã giảm giá nào
            </div>
        @endforelse
    </div>
</div>
