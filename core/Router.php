<?php

namespace App\Core;

use Exception;

class Router
{
    /**
     * A variable that hold all registered routes.
     *
     * @var array
     */
    protected $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => []
    ];

    /**
     * Load the file where are declared all the routes.
     *
     * @param  $file
     * @return $router
     */
    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * Register a GET route for the given uri.
     *
     * @param  string $uri
     * @param  string $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route for the given uri.
     *
     * @param  string $uri
     * @param  string $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Register a PUT route for the given uri.
     *
     * @param  string $uri
     * @param  string $controller
     */
    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }

    /**
     * Register a PATCH route for the given uri.
     *
     * @param  string $uri
     * @param  string $controller
     */
    public function patch($uri, $controller)
    {
        $this->routes['PATCH'][$uri] = $controller;
    }

    /**
     * Register a DELETE route for the given uri.
     *
     * @param  string $uri
     * @param  string $controller
     */
    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
    }

    /**
     * Direct the request to a route.
     *
     * @param  string $uri
     * @param  string $requestType
     */
    public function direct($uri, $requestType)
    {
        $routes = $this->routes[$requestType];

        if ($requestType === 'POST' && isset($_POST['_method'])) {
            switch ($_POST['_method']) {
                case 'DELETE':
                        $routes = $this->routes['DELETE'];
                    break;

                case 'PUT':
                        $routes = $this->routes['PUT'];
                    break;

                case 'PATCH':
                        $routes = $this->routes['PATCH'];
                    break;

                default:
                    throw new Exception('Invalid request method!');
                    break;
            }
        }

        if (array_key_exists($uri, $routes)) {
            return $this->callAction(
                ...explode('@', $routes[$uri])
            );
        }

        return view('errors/404');
    }

    /**
     * Call the given method of the controller.
     *
     * @param  string $controller
     * @param  string $action
     */
    protected function callAction($controller, $action)
    {
        $controller = 'App\\Controllers\\' . $controller;
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new Exception(
                $controller . ' does not respond to the ' . $action . ' action.'
            );
        }

        return $controller->$action();
    }
}
