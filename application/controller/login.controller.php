<?php

	class Login extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
			$this->title = "Login";
			$this->renderLayoutView('login');
		}
	}
?>
