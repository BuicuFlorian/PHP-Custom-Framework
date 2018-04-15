<?php

use App\Core\App;

require_once (dirname($_SERVER['DOCUMENT_ROOT']) . '/vendor/mailer/class.phpmailer.php');

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

    return require PROJECT_PATH . '/app/views/' . $name . '.view.php';
}

/**
 * Redirect to the given path.
 *
 * @param  string $path
 */
function redirect($path)
{
    header('Location: ' . $path);
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
            $request = (isset($_GET[$data])) ? $_GET[$data] : null;
            break;
        case 'POST':
            $request = (isset($_POST[$data])) ? $_POST[$data] : null;
            break;
        case 'PUT':
            $request = (isset($_PUT[$data])) ? $_PUT[$data] : null;
            break;
        case 'PATCH':
            $request = (isset($_PATCH[$data])) ? $_PATCH[$data] : null;
            break;
        case 'DELETE':
            $request = (isset($_DELETE[$data])) ? $_DELETE[$data] : null;
            break;

        default:
            throw new Exception('Invalid method.');
            break;
    }

    if (!$request) {
        return null;
    }

    if (is_array($request)) {
        return cleanArray($request);
    } else {
        return clean($request);
    }
}

/**
 * Return the file from the request.
 *
 * @param  string $name
 * @return array $file
 */
function requestFile($name)
{
    if (isset($_FILES[$name])) {
        return $_FILES[$name];
    } else {
        return null;
    }
}

/**
 * Go to the previous location.
 */
function back()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        return parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
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
 * Sanitize the given array.
 *
 * @param  array $data
 * @return array $data
 */
function cleanArray($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
        $data[$key] = strip_tags($value);
        $data[$key] = htmlspecialchars($value);
    }

    return $data;
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
 * Wrapper around highlight_string, var_export and die functions.
 *
 * @param $data
 */
function pretty_dd($data)
{
    highlight_string("<?php \n" . var_export($data, true) . '?>');
    echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
    die();
}

/**
 * Get a value by the given name from the config array.
 *
 * @param  string $name
 * @return string $value
 */
function config($name)
{
    return App::get('config')[$name];
}

/**
 * Send an email to the given address with
 * the given message and subject.
 *
 * @param  string $email
 * @param  string $message
 * @param  string $subject
 * @return void
 */
function sendMail($email, $message, $subject)
{
    $mailer = new PHPMailer();
    $mailer->IsSMTP();
    $mailer->SMTPDebug = 0;
    $mailer->SMTPAuth = true;
    $mailer->SMTPSecure = 'ssl';
    $mailer->Host = 'smtp.gmail.com';
    $mailer->Port = 465;
    $mailer->AddAddress($email);
    $mailer->Username = config('mail')['username'];
    $mailer->Password = config('mail')['password'];
    $mailer->SetFrom(config('mail')['from'], config('app')['name']);
    $mailer->AddReplyTo(config('mail')['reply_to'], config('app')['name']);
    $mailer->Subject = $subject;
    $mailer->MsgHTML($message);
    $mailer->Send();
}

/**
 * Sanitize the given url.
 *
 * @param  string $url
 * @return string $url
 */
function url($url)
{
    return htmlspecialchars($url);
}

/**
 * Get the current path.
 *
 * @return $uri
 */
function currentPath()
{
    return $_SERVER['REQUEST_URI'];
}

/**
 * Create an alert and display the given errors.
 * 
 * @param  array $errors
 * @return string $alert
 */
function displayErrors($errors)
{
    $alert = '<div class="alert alert-danger alert-dismissible fade show">';
    $alert .= '<ul>';

    foreach ($errors as $error) {
        $alert .= '<li class="list-unstyled lead">' . $error . '</li>';
    }

    $alert .= '</ul>';
    $alert .= '</div>';

    return $alert;
}

/**
 * Save the given file to the specified path.
 *
 * @param array $file
 * @param string $path
 * @return void
 */
function saveFile($file, $path)
{
    $fileName = time() . '_' . $file['name'];
    $tempFile = $file['tmp_name'];
    $path = $path . $fileName;

    if (!file_exists($path . $fileName)) {
        if (move_uploaded_file($tempFile, $path)) {
            return $fileName;
        } else {
            throw new Exception('The file was not uploaded via HTTP POST upload mechanism.');
        }
    } else {
        throw new Exception('This file already exists.');
    }
}

/**
 * Return the path of the specified asset.
 * 
 * @param  string $name
 * @return string $path
 */
function asset($name) 
{
    return $name;
}

/**
 * Get instance of Session class from App container.
 * 
 * @return Session $object
 */
function session()
{
    return App::get('session');
}
