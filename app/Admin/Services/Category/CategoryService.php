<?php

namespace App\Admin\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryService implements CategoryServiceInterface
{
    protected $data;

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
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
