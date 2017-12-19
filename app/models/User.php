<?php

namespace App\Models;

use App\Core\App;

class User 
{
    /**
     * Insert the given user into the users table.
     * 
     * @param  array $user
     */
    public static function save($user)
    {
        App::get('database')->insert('users', $user);
    }

    /**
     * Get a user from the users table by it's username.
     * 
     * @param  string $username
     * @return array $user
     */
    public static function findByUsername($username)
    {
        return App::get('database')->find('users', ['username' => $username]);
    }

    /**
     * Set the session for the given user.
     * 
     * @param objec $user
     */
    public static function setSession($user)
    {
        session('user', $user->id);
    }
}