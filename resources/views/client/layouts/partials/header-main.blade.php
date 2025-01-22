<div class="w-100 header-main-bg">
    <div class="container py-3">
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
                            <i class="ti ti-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex-grow-1">
                <div class="d-flex justify-content-end align-items-center gap-4">
                    <div class="cursor-pointer">
                        <i class="ti ti-truck-delivery fs-2"></i>
                    </div>

                    <div class="mb-0" data-bs-toggle="offcanvas" href="#shoppingCart" role="button"
                        aria-controls="shoppingCart">
                        <div class="position-relative">
                            <i class="ti ti-shopping-cart fs-2"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        </div>
                    </div>

                    <div class="dropdown">
                        <div class="user-dropdown dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-user-circle fs-2"></i>

                        </div>
                        <ul class="dropdown-menu">
                            {{-- <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                            @if (auth()->guard('web')->check())
                                <li><a class="dropdown-item" href="{{ route('client.logout') }}">Đăng xuất</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
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
