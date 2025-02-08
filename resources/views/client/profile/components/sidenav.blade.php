<div class="list-group list-group-transparent">
    <a href="{{ route('profile.index') }}"
        class="list-group-item list-group-item-action d-flex align-items-center {{ setSidebarActive(['profile.index']) }}">
        Thông tin cá nhân</a>
    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
        Thông báo
    </a>
    <a href="{{ route('profile.change.password') }}"
        class="list-group-item list-group-item-action d-flex align-items-center {{ setSidebarActive(['profile.change.password']) }}">
        Đổi mật khẩu
    </a>
    <a href="{{ route('profile.order') }}"
        class="list-group-item list-group-item-action d-flex align-items-center {{ setSidebarActive(['profile.order']) }}">
        Đơn hàng
    </a>
    <a href="{{ route('profile.discount') }}"
        class="list-group-item list-group-item-action d-flex align-items-center {{ setSidebarActive(['profile.discount']) }}">
        Mã giảm giá
    </a>
</div>
