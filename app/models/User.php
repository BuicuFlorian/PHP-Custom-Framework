<?php

namespace App\Models;

use App\Core\App;
use App\Core\Database\BaseModel;

class User extends BaseModel
{   
    static protected $table = 'users';
    static protected $columns = ['id', 'username', 'password', 'joining_date'];

    public $id;
    public $username;
    public $password;
    public $joining_date;

    /**
     * Class constructor.
     * 
     * @param array $args
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    /**
     * Encrypt the password.
     */
    public function encryptPassword()
    {
        $this->password = bcrypt($this->password);
    }

    /**
     * Override create method.
     */
    public function create()
    {
        $this->encryptPassword();
        parent::create();
    }

    /**
     * Overdire update method.
     */
    public function update()
    {
        $this->encryptPassword();
        parent::update();
    }

    /**
     * Get a user from the users table by it's username.
     * 
     * @param  string $username
     * @return array $user
     */
    public static function findByUsername($username)
    {
        $user = App::get('database')->find(static::$table, ['username' => $username]);

        return array_shift($user);
    }
}