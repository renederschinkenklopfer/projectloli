<?php

	class Nsfw extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "NSFW";
			$this->renderLayoutView('nsfw', ['threads' => $threadModel->getAllThreads()]);
		}

	}
?>
