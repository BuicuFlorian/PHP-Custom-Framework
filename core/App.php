<?php

namespace App\Core;

/**
 * A class that represents a Dependency Injection Container.
 */
class App 
{
    protected static $registry = [];

    /**
     * Bind the given key with the value.
     * 
     * @param  string $key
     * @param  $value
     */
    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * Get the value of the given key.
     * 
     * @param  string $key
     * @return $value
     */
    public static function get($key)
    {
        if (! array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container.");
        }

        return static::$registry[$key];
    }
}