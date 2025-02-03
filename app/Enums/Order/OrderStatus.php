<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum OrderStatus: string
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
            OrderStatus::Pending => 'bg-yellow text-yellow-fg',
            OrderStatus::Processing => 'bg-blue text-blue-fg',
            OrderStatus::Shipping => 'bg-purple text-purple-fg',
            OrderStatus::Completed => 'bg-green text-green-fg',
            OrderStatus::Cancelled => 'bg-red text-red-fg',
        };
    }
}