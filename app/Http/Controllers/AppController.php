<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    /**
     * Show the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function app()
    {
        return view('app');
    }
}
