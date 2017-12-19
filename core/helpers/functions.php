<?php

/**
 * Return the view that has the given name.
 * 
 * @param  string $name
 * @param  array  $data
 * @return view
 */
function view($name, $data = [])
{
    extract($data);

    return require "app/views/{$name}.view.php";
}

/**
 * Redirect to the given path.
 * 
 * @param  string $path
 */
function redirect($path)
{
    header("Location: $path");
}

/**
 * Return the data from the request.
 * 
 * @param  string $data
 * @return string $value
 */
function request($data)
{
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            $request = $GET[$data];
            break;
        case 'POST':
            $request = $_POST[$data];
            break;
        case 'PUT':
            $request = $_PUT[$data];
            break;
         case 'PATCH':
            $request = $_PATCH[$data];
            break;
        case 'DELETE':
            $request = $_DELETE[$data];
            break;

        default:
            throw new Exception('Invalid method.');
            break;
    }

    return clean($request);
}

/**
 * Go to the previous location.
 */
function back()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
}

/**
 * Wrapper around password_hash function.
 * Return a hash for the given string.
 * 
 * @param  string $password
 * @return string %hash
 */
function bcrypt($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Sanitize the given data.
 * 
 * @param  string $data
 * @return string $cleanedData
 */
function clean($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}

/**
 * Verify if the user it's authenticated.
 * 
 * @return boolean
 */
function isAuth()
{
    if (isset($_SESSION['user'])) {
        return !!true;
    }
}

/**
 * Wrapper around die and var_dump methods.
 * 
 * @param  $data
 */
function dd($data)
{
    die(var_dump($data));
}

/**
 * Set a session variable with the given value or 
 * get a session variable by the given name.
 * 
 * @param  string $name
 * @param  string $value
 */
function session($name, $value = null)
{   
    if (isset($value)) {
        $_SESSION[$name] = $value;
    }
    
    if (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    } else {
        return null;
    }
}