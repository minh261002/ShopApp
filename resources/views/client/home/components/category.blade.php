<div class="pb-5 w-100">
    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
        <h1 class="mb-0 text-danger fs-20px fw-semibold text-uppercase">Mua gì hôm nay</h1>
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
    </div>

    <div class="row align-items-center">
        @forelse ($homeCategories as $category)
            <div class="col-4 col-md-2">
                <a href="" class="nav-link p-0  d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="img-fluid home-category-img">
                    <p class="text-center text-uppercase text-dark fw-semibold mt-3">{{ $category->name }}</p>
                </a>
            </div>
        @empty
            <div class="w-100 alert alert-light" role="alert">
                Không có danh mục nào
            </div>
        @endforelse
    </div>
</div>
