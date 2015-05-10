<?php

	class Error404 extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
      header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
			$this->title = "404 Not Found";
      $this->renderLayoutView('404');
		}
	}

?>
