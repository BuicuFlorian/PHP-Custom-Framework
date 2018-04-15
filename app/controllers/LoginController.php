<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Validator;

class LoginController
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
     * Display the view for the login page.
     */
    public function index()
    {   
        $message = session()->message();
        session()->clearMessage();
        $errors = session()->errors();
        session()->clearErrors();

        return view('login', compact('message', 'errors'));
    }

    /**
     * Authenticate the given user.
     */
    public function authenticate()
    {   
        $validator = new Validator();
        $validator->isEmpty(['username' => request('username')]);
        $validator->isString(['username' => request('username')]);
        $validator->isEmpty(['password' => request('password')]);
        $validator->isString(['password' => request('password')]);

        if (empty($validator->errors)) {
            $user = User::findByUsername(request('username'));

            if ($user && password_verify(request('password'), $user->password)) {
                session()->login($user);
                return redirect('/tasks');
            } else {
                session()->errors(['Username and password do not match our records.']);
            }
        } else {
            session()->errors($validator->errors);
        }

        return redirect('/login');
    }

    /**
     * Log out the user and redirect to the login page.
     */
    public function logout()
    {
        if (session()->isLoggedIn()) {
            session()->logout();

            return redirect('/login');
        }

        return view('errors/404');
    }
}
