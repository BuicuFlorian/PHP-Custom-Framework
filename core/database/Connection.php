<?php
namespace App\Core\Database;

use PDO;

class Connection
{   
    /**
     * Connect to the database
     * 
     * @param  array $config
     * @return object PDO
     */
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
