<?php

	class Index extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "New";
			$this->renderLayoutView('index', ['threads' => $threadModel->getAllThreads()]);
		}

		public function test()
		{
			echo "index/test";
		}
	}
?>
