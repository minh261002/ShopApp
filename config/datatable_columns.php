<?php

return [
    'shippings' => [
        'order_id' => [
            'title' => 'Mã đơn hàng',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Tên người nhận',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'phone' => [
            'title' => 'Số điện thoại',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'shipping_method' => [
            'title' => 'Phương thức vận chuyển',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'tracking_number' => [
            'title' => 'Mã vận đơn',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'shipping_status' => [
            'title' => 'Trạng thái vận chuyển',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'transactions' => [
        'user_id' => [
            'title' => 'Người thanh toán',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'order_id' => [
            'title' => 'Mã đơn hàng',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'sub_total' => [
            'title' => 'Tạm tính',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'discount_amount' => [
            'title' => 'Giảm giá',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'shipping_fee' => [
            'title' => 'Phí vận chuyển',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'grand_total' => [
            'title' => 'Tổng tiền ',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'payment_method' => [
            'title' => 'Phương thức thanh toán',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'payment_status' => [
            'title' => 'Trạng thái ',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'orders' => [
        'order_number' => [
            'title' => 'Mã đơn hàng',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'name' => [
            'title' => 'Người nhận',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'amount' => [
            'title' => 'Tổng tiền',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'pạyment_status' => [
            'title' => 'Thanh toán',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'productVariations' => [
        'sku' => [
            'title' => 'SKU',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'price' => [
            'title' => 'Giá',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'sale_price' => [
            'title' => 'Giá khuyến mãi',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'stock' => [
            'title' => 'Số lượng tồn kho',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'products' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle w-100px',
        ],
        'name' => [
            'title' => 'Tên sản phẩm',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'viewed' => [
            'title' => 'Lượt xem',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'users' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle w-100px',
        ],
        'name' => [
            'title' => 'Tên khách hàng',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'categories' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle w-100px',
        ],
        'name' => [
            'title' => 'Tên chuyên mục',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'show_home' => [
            'title' => 'Hiển thị trang chủ',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'show_menu' => [
            'title' => 'Hiển thị menu',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'notifications' => [
        'user_id' => [
            'title' => 'Khách hàng',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'admin_id' => [
            'title' => 'Quản trị viên',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'content' => [
            'title' => 'Nội dung',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'is_read' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'created_at' => [
            'title' => 'Ngày gửi',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'discounts' => [
        'code' => [
            'title' => 'Mã giảm giá',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'date_start' => [
            'title' => 'Ngày bắt đầu',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'date_end' => [
            'title' => 'Ngày kết thúc',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'type' => [
            'title' => 'Loại giảm giá',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'value' => [
            'title' => 'Giá giảm',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'post_catalogues' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle w-100px',
        ],
        'name' => [
            'title' => 'Tên chuyên mục',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'position' => [
            'title' => 'Vị trí',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'show_menu' => [
            'title' => 'Hiển thị menu',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'posts' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle w-100px',
        ],
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'is_featured' => [
            'title' => 'Nổi bật',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'slider_items' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'link' => [
            'title' => 'Link',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'position' => [
            'title' => 'Vị trí',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'sliders' => [
        'name' => [
            'title' => 'Tên slider',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'desc' => [
            'title' => 'Mô tả',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],
    ],
    'admins' => [
        'image' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Họ và tên',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'role' => [
            'title' => 'Vai trò',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'roles' => [
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Vai trò (ROLE_NAME)',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'guard_name' => [
            'title' => 'Nhóm quyền (GUARD_NAME)',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'permissions' => [
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Quyền (PERMISSION_NAME)',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'guard_name' => [
            'title' => 'Nhóm quyền (GUARD_NAME)',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'modules' => [
        'name' => [
            'title' => 'Tên module',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'description' => [
            'title' => 'Mô tả',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày bắt đầu',
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
];