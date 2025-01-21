<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum PaymentMethod: string
{
    use Enum;

    case Cash = 'cash';
    case BankTransfer = 'bank_transfer';


    public function badge(): string
    {
        return match ($this) {
            PaymentMethod::Cash => 'bg-yellow text-yellow-fg',
            PaymentMethod::BankTransfer => 'bg-blue text-blue-fg',
        };
    }
}