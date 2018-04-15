<?php

namespace App\Controllers;

class HomeController
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        if (session()->isLoggedIn()) {
            return redirect('/tasks');
        }
    }

    /**
     * Display the view for the home page.
     */
    public function index()
    {
        $greetings = 'Simple PHP Framework';

        return view('home', compact('greetings'));
    }
}
