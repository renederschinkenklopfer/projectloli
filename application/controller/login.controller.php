<?php

	class Login extends Controller
	{

		public function __construct()
		{

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
