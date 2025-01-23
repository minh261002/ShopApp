<div class="w-100">
    <div class="d-flex flex-column">
        <h1 class="fs-28px fw-bold text-dark">{{ $product->name }}</h1>

        <div class="d-flex align-items-center justify-content-start gap-2">
            <div class="d-flex align-items-center justify-content-start gap-1">
                @for ($i = 0; $i < 5; $i++)
                    <i class="ti ti-star text-yellow"></i>
                @endfor
            </div>
            <span>(11 Đánh giá)</span>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3">
            @if ($product->flashSale)
                <div class="card w-100">
                    <div class="card-header bg-red-lt text-white py-3">
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
            @endif
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3">
            <div class="d-flex align-items-center gap-2">
                @if ($product->flashSale)
                    @if ($product->variations->first()->sale_price)
                        <span class="text-red fs-28px fw-bold">
                            {{ format_price(($product->variations->first()->price * (100 - $product->flashSale->first()->items()->first()->discount)) / 100) }}
                        </span>
                        <span class="text-muted fs-20px text-decoration-line-through text-secondary fw-medium">
                            {{ format_price($product->variations->first()->sale_price) }}
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @else
                        <span class="text-muted fs-20px text-decoration-line-through text-secondary fw-medium">
                            {{ format_price($product->variations->first()->sale_price) }}
                        </span>
                        <span class="text-danger fs-24px fw-bold">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @endif
                @else
                    @if ($product->variations->first()->sale_price)
                        <span class="text-red fs-28px fw-bold">
                            {{ format_price($product->variations->first()->sale_price) }}
                        </span>
                        <span class="text-muted fs-20px text-decoration-line-through text-secondary fw-medium">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @else
                        <span class="text-danger fs-24px fw-bold">
                            {{ format_price($product->variations->first()->price) }}
                        </span>
                    @endif
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3 gap-4">
            @foreach ($groupedAttributes as $attributeName => $values)
                <div class="flex-grow-1">
                    <label class="form-label fw-medium">{{ $attributeName }}</label>
                    <select class="form-select">
                        @foreach ($values as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>
</div>
