<?php

/**
 * login.controller.php
 *
 * Controller für das Login.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @copyright  2015 Yolo Inc.
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0
 */


	class Login extends Controller
	{

		public function __construct()
		{
			//Wichtig, dass bei jedem Controller der Vater-Controller aufgerufen wird.
			parent::__construct();
		}

		public function index()
		{
			if(Session::isLoggedIn())
			{
				header('Location: ' .WORKING_DIR);
        exit();
			}
			else
			{
				$this->title = "Login";
				$this->renderLayoutView('login');
			}

		}


		public function validate()
		{
			if(!empty($_POST["login_username"]) && !empty($_POST["login_password"]))
			{
				$login_username = $_POST["login_username"];
				$login_password = $_POST["login_password"];

				$threadModel = $this->loadModel('login');
				if($threadModel->login($login_username, $login_password))
				{
					header('Location: ' .WORKING_DIR);
					exit();
				}
				else
				{
					$this->title = "Login";
					$this->renderLayoutView('login', ['login_error' => 'Username oder Passwort falsch.']);
				}
			}
			else
			{
				$this->title = "Login";
				$this->renderLayoutView('login', ['login_error' => 'Bitte Username und Passwort eingeben.']);
			}
		}

		public function logout()
		{
			Session::destroy();
			header('Location: ' .WORKING_DIR .'login');
		}
	}
?>
