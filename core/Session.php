<?php

namespace App\Core;

class Session
{
	public $user_id;
	public $email;
	public $last_login;
	public $two_step_auth;
	const MAX_LOGIN_AGE = 60 * 60 * 24; // 1 day

	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		session_start();
		$this->checkStoredLogin();
	}

	/**
	 * Login the given user.
	 * 
	 * @return boolean
	 */
	public function login($user)
	{
		if ($user) {
			// prevent session fixation attacks
			session_regenerate_id();
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->email = $_SESSION['email'] = $user->email;
			$this->last_login = $_SESSION['last_login'] = time();
		}

		return true;
	}

	/**
	 * Authenticate the user.
	 * 
	 * @return void
	 */
	public function authenticate()
	{
		$this->two_step_auth = $_SESSION['two_step_auth'] = true;
	}

	/**
	 * Verify if the user is logged in.
	 * 
	 * @return boolean
	 */
	public function isLoggedIn()
	{
		return isset($this->user_id) && $this->lastLoginIsRecent();
	}

	/**
	 * Check and see if the user is authenticated.
	 * 
	 * @return boolean
	 */
	public function isAuth()
	{
		return $this->two_step_auth === true;
	}

	/**
	 * Destroy the session of the user.
	 * 
	 * @return boolean
	 */
	public function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['email']);
		unset($_SESSION['last_login']);
		unset($_SESSION['two_step_auth']);
		unset($this->user_id);
		unset($this->email);
		unset($this->last_login);
		unset($this->two_step_auth);

		return true;
	}

	/**
	 * Check and see if the user_id value is set in the SESSION.
	 * 
	 * @return void
	 */
	private function checkStoredLogin()
	{
		if (isset($_SESSION['user_id'])) {
			$this->user_id = $_SESSION['user_id'];
			$this->email = $_SESSION['email'];
			$this->last_login = $_SESSION['last_login'];

			if (isset($_SESSION['two_step_auth'])) {
				$this->two_step_auth = $_SESSION['two_step_auth'];
			}
		}
	}

	/**
	 * Check and see if the user logged in recently.
	 * 
	 * @return boolean
	 */
	private function lastLoginIsRecent()
	{
		if (!isset($this->last_login)) {
			return false;
		} elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Set the message to the session or get it from there.
	 * 
	 * @param  string $msg
	 * @return boolean | string
	 */
	public function message($msg = '')
	{
		if (!empty($msg)) {
			// This is a 'set' message.
			$_SESSION['message'] = $msg;
			return true;
		} else {
			// This is a 'get' message.
			return $_SESSION['message'] ?? '';
		}
	}

	/**
	 * Set the errors to the session or get it from there.
	 * 
	 * @param  array $errors
	 * @return boolean | array
	 */
	public function errors($errors = [])
	{
		if (!empty($errors)) {
			// This is a 'set' message.
			$_SESSION['errors'] = $errors;
			return true;
		} else {
			// This is a 'get' message.
			return $_SESSION['errors'] ?? [];
		}
	}

	/**
	 * Clear the message from the SESSION.
	 * 
	 * @return void
	 */
	public function clearMessage()
	{
		unset($_SESSION['message']);
	}

	/**
	 * Clear the message from the SESSION.
	 * 
	 * @return void
	 */
	public function clearErrors()
	{
		unset($_SESSION['errors']);
	}
}