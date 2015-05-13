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
			if($thread_id === "create")
			{
				$thread_id = $_POST["thread_id"];
				$username = $_POST["username"];
				$comment = $_POST["comment"];
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], getcwd() ."\\public\\img\\test.jpg");
				
				$postModel = $this->loadModel('post');
				$postModel->createPost($thread_id, $username, $comment, "test.jpg");
				header('Location: /projectloli/computer/thread/' .$thread_id);
			}
			else
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
	}
?>
