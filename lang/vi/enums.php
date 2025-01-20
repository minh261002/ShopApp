<?php

use App\Enums\ActiveStatus;
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

];
