<?php

namespace App\Services\Profile;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            Log::error('Error update profile');
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validated();
        $currentPassword = $data['current_password'];
        unset($data['current_password']);

        $user = auth()->guard('web')->user();

        if (Hash::check($currentPassword, $user->password)) {
            $data['password'] = Hash::make($data['password']);
            if ($this->repository->update($user->id, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}