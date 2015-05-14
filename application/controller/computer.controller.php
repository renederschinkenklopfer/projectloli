<?php

	class Computer extends Controller
	{

		public function __construct()
		{

			//Wichtig, dass bei jedem Controller der Vater-Controller aufgerufen wird.
			parent::__construct();

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "Computer/Tech";
			$this->renderLayoutView('computer', ['threads' => $threadModel->getAllThreads()]);
		}


		public function create()
		{
			if($_POST["username"])
			{
				$username = trim($_POST["username"]);
			}
			else
			{
				$username = "Anonymous";
			}

			$subject = trim($_POST["subject"]);
			$comment = trim($_POST["comment"]);

			if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"]))
			{
				$new_filename = substr(md5(uniqid(rand(), true)), 14) ."." .pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], getcwd() ."\\public\\img\\" .$new_filename);
			}
			else
			{
				$new_filename = 0;
			}

			$threadModel = $this->loadModel('thread');
			$threadModel->createThread($username, $subject, $comment, $new_filename);
			header('Location: ' .WORKING_DIR .'computer/');
			exit();
		}


		public function delete($thread_id = 0)
		{
			//Nur eingeloggte User dürfen Threads löschen
			Session::authenticatedOnly();

			if($thread_id != 0)
			{
				$threadModel = $this->loadModel('thread');
				if($threadModel->deleteThread($thread_id))
				{
					header('Location: ' .WORKING_DIR .'computer/');
					exit();
				}
				else
				{
					header('Location: ' .WORKING_DIR .'computer/');
					exit();
				}
			}
			else
			{
				header('Location: ' .WORKING_DIR .'computer/');
				exit();
			}
		}


		public function thread($thread_id = 0)
		{
			if($thread_id === "create")
			{
				$thread_id = trim($_POST["thread_id"]);

				if(Session::isLoggedIn())
				{
					$username = $_SESSION["username"];
					$staff = true;
				}
				else
				{
					if($_POST["username"])
					{
						$username = trim($_POST["username"]);
					}
					else
					{
						$username = "Anonymous";
					}

					$staff = false;
				}

				$comment = trim($_POST["comment"]);

				if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"]))
				{
					$new_filename = substr(md5(uniqid(rand(), true)), 14) ."." .pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
					move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], getcwd() ."\\public\\img\\" .$new_filename);
				}
				else
				{
					$new_filename = 0;
				}


				$postModel = $this->loadModel('post');
				$postModel->createPost($thread_id, $username, $comment, $new_filename, $staff);
				header('Location: /projectloli/computer/thread/' .$thread_id);
				exit();
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
