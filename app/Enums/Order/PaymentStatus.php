<?php

namespace App\Enums\Payment;

use App\Supports\Enum;

enum PaymentStatus: string
{
    use Enum;

    case Pending = 'pending';
    case Paid = 'paid';


    public function badge(): string
    {
        return match ($this) {
            PaymentStatus::Pending => 'bg-yellow text-yellow-fg',
            PaymentStatus::Paid => 'bg-blue text-blue-fg',
        };
    }
}
