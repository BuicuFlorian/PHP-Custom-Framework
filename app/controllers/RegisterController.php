<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Validator;

class RegisterController
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
     * Display the view for the registration page.
     */
    public function index()
    {   
        $errors = session()->errors();
        session()->clearErrors();

        return view('register', compact('errors'));
    }

    /**
     * Create a new user account.
     */
    public function register()
    {
        $user = request('user');
        $errors = $this->validateRegistrationForm($user);

        if (empty($errors)) {
            $userFound = User::findByUsername($user['username']);

            if (empty($userFound)) {
                $newUser = new User($user);
                $newUser->save();
            } else {
                session()->errors(['This username is already taken!']);
                return redirect('/register');
            }
        } else {
            session()->errors($errors);
            return redirect('/register');      
        }

        session()->message('Your account was successfully created.');
        return redirect('/login');
    }

     /**
     * Validate registration form data.
     *
     * @param array $user
     * @return array $errors
     */
    public function validateRegistrationForm($user)
    {
        $validator = new Validator();
        $validator->isEmpty(['username' => $user['username']]);
        $validator->isString(['username' => request('username')]);
        $validator->isEmpty(['password' => $user['password']]);
        $validator->isString(['password' => request('password')]);
        $validator->isEmpty(['password_confirmation' => $user['password_confirmation']]);
        $validator->isString(['password_confirmation' => request('password_confirmation')]);
        $validator->passwordsMatch($user['password'], $user['password_confirmation']);

        return $validator->errors;
    }
}
