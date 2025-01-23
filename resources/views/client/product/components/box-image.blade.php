<div class="row">
    <div class="col-md-2">
        @foreach ($gallery as $item)
            <div class="product-gallery-preview-item mb-3 cursor-pointer">
                <img src="{{ $item }}" alt="{{ $product->name }}" class="w-100">
            </div>
        @endforeach
    </div>

    <div class="col-md-10">
        <div class="product-gallery-preview overflow-scroll">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100">
        </div>
    </div>
</div>
