<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the current user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showMe()
    {
        return Auth::user();
    }

    /**
     * Show a user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        return $user;
    }
}
