<div class="w-100 header-main-bg">
    <div class="container py-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <a href="{{ route('home') }}">
                    <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1735367386/Pengu/logo_vk3mee.svg   "
                        alt="logo" class="img-fluid" width="150">
                </a>
            </div>

            <div class="flex-grow-1">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sản phẩm">
                        <button class="btn btn-danger" type="submit">
                            <i class="ti ti-search fs-22px"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex-grow-1">
                <div class="d-flex justify-content-end align-items-center gap-4">
                    <div class="cursor-pointer">
                        <i class="ti ti-truck-delivery fs-28px"></i>
                    </div>

                    <div class="mb-0" data-bs-toggle="offcanvas" href="#shoppingCart" role="button"
                        aria-controls="shoppingCart">
                        <div class="position-relative">
                            <i class="ti ti-shopping-cart fs-28px"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge bg-red text-white rounded-pill">
                                0
                            </span>
                        </div>
                    </div>

                    <div class="dropdown">
                        <div class="user-dropdown dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (auth()->guard('web')->check())
                                <img src="{{ auth()->guard('web')->user()->image }}" alt="avatar"
                                    class="img-fluid rounded-circle" width="35">
                            @else
                                <i class="ti ti-user-circle fs-28px"></i>
                            @endif

                        </div>
                        <ul class="dropdown-menu">
                            @if (auth()->guard('web')->check())
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCart" aria-labelledby="shoppingCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="shoppingCartLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            Some text as placeholder. In real life you can have the elements you have chosen. Like,
            text, images, lists, etc.
        </div>
        <div class="dropdown mt-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Dropdown button
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.header-main-bg').addClass('slide-down');
            } else {
                $('.header-main-bg').removeClass('slide-down');
            }
        });
    </script>
@endpush
