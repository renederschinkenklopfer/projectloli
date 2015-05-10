<?php

	class Over18 extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "Sure ur not underage?";
			$this->renderView('over18');
		}

	}
?>
