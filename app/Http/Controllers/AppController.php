<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Show the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function app()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->makeVisible(['email']);
        return view('app', [
            'user' => $user,
        ]);
    }
}
