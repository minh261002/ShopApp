<?php

namespace App\Services\Profile;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class ProfileService implements ProfileServiceInterface
{
    protected $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validated();

        $userId = auth()->guard('web')->id();
        if ($this->repository->update($userId, $data)) {
            return true;
        } else {
            \Log::error('Error update profile');
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validated();
        $user = auth()->guard('web')->user();
        $this->repository->update($user->id, $data);
    }

}