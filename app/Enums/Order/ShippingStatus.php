<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum ShippingStatus: string
{
    use Enum;

    case Pending = 'pending';

    case Processing = 'processing';

    case Shipping = 'shipping';

    case Completed = 'completed';

    case Cancelled = 'cancelled';


    public function badge(): string
    {
        return match ($this) {
            ShippingStatus::Pending => 'bg-yellow text-yellow-fg',
            ShippingStatus::Processing => 'bg-blue text-blue-fg',
            ShippingStatus::Shipping => 'bg-purple text-purple-fg',
            ShippingStatus::Completed => 'bg-green text-green-fg',
            ShippingStatus::Cancelled => 'bg-red text-red-fg',
        };
    }
}