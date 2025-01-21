<?php

namespace App\Admin\Services\Discount;

use App\Repositories\Discount\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class DiscountService implements DiscountServiceInterface
{
    protected $data;

    protected $repository;

    public function __construct(DiscountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        if ($this->data['image'] == null) {
            $this->data['image'] = '/admin/images/not-found.jpg';
        }
        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        if ($this->data['image'] == null) {
            $this->data['image'] = '/admin/images/not-found.jpg';
        }
        return $this->repository->update($this->data['id'], $this->data);
    }
}