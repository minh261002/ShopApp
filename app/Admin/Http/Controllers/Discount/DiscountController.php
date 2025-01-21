<?php

namespace App\Admin\Http\Controllers\Discount;

use App\Admin\Services\Discount\DiscountServiceInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Discount\DiscountRepositoryInterface;


class DiscountController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        DiscountRepositoryInterface $repository,
        DiscountServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
}