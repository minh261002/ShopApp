<?php

namespace App\Services\Profile;

use Illuminate\Http\Request;

interface ProfileServiceInterface
{
    public function updateProfile(Request $request);

    public function updatePassword(Request $request);
}