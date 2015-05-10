<?php

	class Computer extends Controller
	{

		public function __construct()
		{

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "Computer/Tech";
			$this->renderLayoutView('computer', ['threads' => $threadModel->getAllThreads()]);
		}

		public function thread($thread_id = 0)
		{
			$postModel = $this->loadModel('post');
			$threadPost = $postModel->getThreadPost($thread_id);
			if($threadPost)
			{
				$this->title = $threadPost->threadname;
				$this->renderView('thread', ['thread' => $threadPost, 'posts' => $postModel->getAllPosts($thread_id)]);
			}
			else
			{
				require_once(CONTROLLER_PATH .'Error404' .".controller.php");
				$error404 = new Error404;
				$error404->index();
			}

		}
	}
?>
