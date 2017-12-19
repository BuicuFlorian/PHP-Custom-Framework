<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController 
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        if (isAuth()) {
            return redirect('/tasks');
        }
    }

    /**
     * Display the view for the registration page.
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Create a new user account.
     */
    public function register()
    {
        User::save([
            'username' => request('username'),
            'password' => bcrypt(request('password'))
        ]);

        redirect('/login');
    }
}