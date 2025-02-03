<?php

use App\Enums\ActiveStatus;
use App\Enums\Discount\DiscountApplyFor;
use App\Enums\Discount\DiscountType;
use App\Enums\Module\ModuleStatus;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use App\Enums\Order\ShippingMethod;
use App\Enums\Order\ShippingStatus;



return [
    ActiveStatus::class => [
        ActiveStatus::Active->value => 'Đang hoạt động',
        ActiveStatus::InActive->value => 'Không hoạt động',
    ],
    ModuleStatus::class => [
        ModuleStatus::InProgress->value => 'Chưa hoàn thành',
        ModuleStatus::Completed->value => 'Đã hoàn thành',
    ],
    DiscountType::class => [
        DiscountType::Percentage->value => 'Phần trăm',
        DiscountType::Fixed->value => 'Số tiền',
    ],
    DiscountApplyFor::class => [
        DiscountApplyFor::All->value => 'Áp dụng cho tất cả khách hàng',
        DiscountApplyFor::One->value => 'Áp dụng cho khách hàng cụ thể',
    ],
    PaymentMethod::class => [
        PaymentMethod::Cash->value => 'Thanh toán khi nhận hàng',
        PaymentMethod::BankTransfer->value => 'Chuyển khoản ngân hàng',
    ],
    ShippingMethod::class => [
        ShippingMethod::GHTK->value => 'Giao hàng tiết kiệm',
        ShippingMethod::Express->value => 'Giao hàng nhanh',
        ShippingMethod::VNPost->value => 'VN Post',
    ],
    PaymentStatus::class => [
        PaymentStatus::Pending->value => 'Chờ thanh toán',
        PaymentStatus::Paid->value => 'Đã thanh toán',
    ],
    ShippingStatus::class => [
        ShippingStatus::Pending->value => 'Chờ xử lý',
        ShippingStatus::Processing->value => 'Đang xử lý',
        ShippingStatus::Shipping->value => 'Đang giao hàng',
        ShippingStatus::Completed->value => 'Đã giao hàng',
        ShippingStatus::Cancelled->value => 'Đã hủy',
    ],
    OrderStatus::class=> [
        OrderStatus::Pending->value => 'Chờ xử lý',
        OrderStatus::Processing->value => 'Đang xử lý',
        OrderStatus::Shipping->value => 'Đang giao hàng',
        OrderStatus::Completed->value => 'Đã hoàn thành',
        OrderStatus::Cancelled->value => 'Đã hủy',
    ]
];