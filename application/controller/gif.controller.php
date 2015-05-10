<?php

	class Gif extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "Gif";
			$this->renderLayoutView('gif', ['threads' => $threadModel->getAllThreads()]);
		}

	}
?>
