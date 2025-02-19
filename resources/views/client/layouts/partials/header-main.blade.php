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
                <form method="GET" action="{{ route('product.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Tìm kiếm sản phẩm"
                            value="{{ request()->q ?? '' }}">
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

                    <a href="{{ route('cart.index') }}" class="mb-0 cursor-pointer nav-link">
                        <div class="position-relative">
                            <i class="ti ti-shopping-cart fs-28px"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge bg-red text-white rounded-pill">
                                {{ session()->has('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </div>
                    </a>

                    <div class="dropdown">
                        <div class="user-dropdown dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (auth()->guard('web')->check())
                                <img src="{{ auth()->guard('web')->user()->image }}" alt="avatar"
                                    class="img-fluid rounded-circle object-fit-cover"
                                    style="width: 35px; height: 35px;">
                            @else
                                <i class="ti ti-user-circle fs-28px"></i>
                            @endif

                        </div>
                        <ul class="dropdown-menu">
                            @if (auth()->guard('web')->check())
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">Thông báo</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.change.password') }}">Đổi mật
                                        khẩu</a>
                                </li>
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
