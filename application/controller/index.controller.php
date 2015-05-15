<?php

	class Index extends Controller
	{

		public function __construct()
		{

			//Wichtig, dass bei jedem Controller der Vater-Controller aufgerufen wird.
			parent::__construct();

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "New";
			$this->renderLayoutView('index', ['threads' => $threadModel->getAllThreads()]);
		}
	}
?>
