<?php

namespace App\Core;

class Request 
{
    /**
     * Get the uri from the request.
     * 
     * @return string $uri
     */
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    /**
     * Get the method from the request.
     * 
     * @return string $method
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}  