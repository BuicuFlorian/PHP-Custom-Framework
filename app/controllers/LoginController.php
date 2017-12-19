<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
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
     * Display the view for the login page.
     */
    public function index()
    {   
        $error = session('login-error');
        
        return view('login', compact('error'));
    }

    /**
     * Authenticate the given user.
     */
    public function authenticate()
    {
        $user = User::findByUsername(request('username'));

        if ($user) {
            return $this->verifyPassword(request('password'), $user[0]);
        }

        session('login-error', 'Invalid username.');
        return redirect('/login');
    }

    /**
     * Verify that the given password matches user's password.
     * 
     * @param  string $password
     * @param  object $user
     */
    private function verifyPassword($password, $user)
    {
        $validPassword = password_verify($password, $user->password);

        if ($validPassword) {
            User::setSession($user);
            return redirect('/tasks');
        }

        session('login-error', 'Invalid password.');
        return redirect('/login');
    }

    /**
     * Log out the user and redirect to the login page.
     */
    public function logout()
    {
        session_unset();
        session_destroy();

        return redirect('/login');
    }
}