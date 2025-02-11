<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('client.profile.wishlist');
    }
}