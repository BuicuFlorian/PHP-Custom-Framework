<?php

namespace App\Core;

class Validator
{
    public $errors = [];

    /**
     * Check and see if the given data is empty.
     * 
     * @param  string|array $data
     * @return boolean
     */
    public function isEmpty($data)
    {
        if (empty(array_values($data)[0])) {
            $this->errors[] = str_replace('_', ' ', ucfirst(array_keys($data)[0])) . ' is required.';
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check and see if the given data is a valid email address.
     * 
     * @param  string $data
     * @return boolean
     */
    public function isEmail($data)
    {
        if (filter_var(array_values($data)[0], FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->errors[] = 'Invalid email address.';
            return false;
        }
    }

    /**
     * Check and see if the given data it's a number.
     * 
     * @param  number $data
     * @return boolean
     */
    public function isNumber($data)
    {
        if (!is_numeric(array_values($data)[0])) {
            $this->errors[] = str_replace('_', ' ', ucfirst(array_keys($data)[0])) . ' is not a number.';
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check and see if the given data it's a string.
     * 
     * @param  string  $data
     * @return boolean
     */
    public function isString($data)
    {
        if (ctype_alpha($data)) {
            return !!true;
        }
    }

    /**
     * Check and see if the given file is a valid image.
     * 
     * @param  array $file
     * @return boolean
     */
    public function isImage($file)
    {
        $validFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = explode('.', $file['name']);

        if (is_uploaded_file($file['tmp_name'])) {
            if (preg_match('/^[A-Za-z0-9\-\_]{1,}\.[a-zA-Z0-9]{0,4}$/', $file['name'])) {
                if (in_array(strtolower($fileExtension[1]), $validFileExtensions)) {
                } else {
                    $this->errors[] = 'You can upload only JPG, JPEG, PNG and GIF files.';
                    return false;
                }
            } else {
                $this->errors[] = 'This file contains non-alphanumeric characters.';
                return false;
            }
        } else {
            $this->errors[] = 'The file named by filename was not uploaded via HTTP POST.';
            return false;
        }

    }
	
	/**
	 * Check and see if the given data has the specified length.
	 *
	 * @param string $data
	 * @param string $length
	 * @return boolean
	 */
    public function hasLength($data, $length)
    {
        if (strlen($data) === $length) {
            return !!true;
        }
    }

    /**
     * Check and see if the given password is complex or not.
     * 
     * @param  string $password
     * @return boolean
     */
    public function isComplexPassword($password)
    {
        if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
            return !!true;
        }
    }

    /**
     * Check and see if the given passwords are equals.
     * 
     * @param  string $password
     * @param  string $passwordConfirmation
     * @return boolean
     */
    public function passwordsMatch($password, $passwordConfirmation)
    {
        if ($password === $passwordConfirmation) {
            return true;
        } else {
            $this->errors[] = 'Passwords don\'t match!';
            return false;
        }
    }

    /**
     * Check and see if the size of the given 
     * file is lower than specified size.
     *
     * @param array $file
     * @param string $mb
     * @return boolean
     */
    public function maxFileSize($file, $mb)
    {
        $fileSize = $file['size'];
        $maxSize = 1024 * 1024 * $mb;

        if ($fileSize > $maxSize) {
            $this->errors[] = 'The file is larger than ' . $mb . ' MB.';
            return false;
        } else {
            return true;
        }
    }
}