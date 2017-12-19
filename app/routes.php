<?php
/**
 * Routes
 * 
 * Here is where you can register web routes for your application. 
 */

$router->get('', 'HomeController@index');

$router->get('login', 'LoginController@index');
$router->post('login', 'LoginController@authenticate');

$router->get('logout', 'LoginController@logout');

$router->get('register', 'RegisterController@index');
$router->post('register', 'RegisterController@register');

$router->get('tasks', 'TasksController@index');
$router->post('tasks', 'TasksController@store');
$router->put('tasks/edit', 'TasksController@update');
$router->delete('tasks/delete', 'TasksController@destroy');