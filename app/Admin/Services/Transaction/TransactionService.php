<?php

namespace App\Admin\Services\Transaction;

use App\Admin\Services\Transaction\TransactionServiceInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionService implements TransactionServiceInterface
{
    protected $repository;

    public function __construct(
        TransactionRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function update(Request $request)
    {
        $data = $request->validated();

        return $this->repository->update($data['id'], $data);
    }
}