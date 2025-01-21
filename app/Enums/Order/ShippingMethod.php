<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum ShippingMethod: string
{
    use Enum;

    case GHTK = 'ghtk';
    case VNPost = 'vnpost';
    case Express = 'express';

    public function badge(): string
    {
        return match ($this) {
            ShippingMethod::GHTK => 'bg-yellow text-yellow-fg',
            ShippingMethod::VNPost => 'bg-blue text-blue-fg',
            ShippingMethod::Express => 'bg-purple text-purple-fg',
        };
    }
}
