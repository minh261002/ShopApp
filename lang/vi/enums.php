<?php

use App\Enums\ActiveStatus;
use App\Enums\Discount\DiscountApplyFor;
use App\Enums\Discount\DiscountType;
use App\Enums\Module\ModuleStatus;



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
];