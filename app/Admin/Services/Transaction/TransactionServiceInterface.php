<?php

namespace App\Admin\Services\Transaction;

use Illuminate\Http\Request;

interface TransactionServiceInterface
{
    public function update(Request $request);
}