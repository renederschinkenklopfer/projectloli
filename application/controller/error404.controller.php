<?php

	class Error404 extends Controller
	{

		public function __construct()
		{

			//Wichtig, dass bei jedem Controller der Vater-Controller aufgerufen wird.
			parent::__construct();

		}

		public function index()
		{
      header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
			$this->title = "404 Not Found";
      $this->renderLayoutView('404');
		}
	}

?>
