<?php

namespace App\Services\Profile;

use App\Repositories\User\UserRepositoryInterface;
use App\Supports\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileService implements ProfileServiceInterface
{
    use UploadFile;

    protected $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validated();

        if (!empty($data['image'])) {
            $data['image'] = $this->uploadImage($request, 'image', $data['old_image'], '/uploads/images/avatars');
        } else {
            $data['image'] = '/admin/images/not-found.jpg';
        }

        unset($data['old_image']);


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