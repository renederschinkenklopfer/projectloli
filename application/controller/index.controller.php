<?php

	class Index extends Controller
	{

		public function __construct()
		{

			//Wichtig, dass bei jedem Controller der Vater-Controller aufgerufen wird.
			parent::__construct();

		}

		public function index($page = 1, $error = array(true, ""))
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "New";
			$this->renderLayoutView('board', ['error' => $error, 'page' => $page, 'threads' => $threadModel->getAllThreads($page)]);
		}


		public function page($page)
		{
			$this->index($page);
		}


		public function create()
		{
			if(isset($_POST['btnPost']))
			{
				$threadModel = $this->loadModel('thread');
				if($thread_info = $threadModel->createThreadValidate(Request::post("username"), Request::post("subject"), Request::post("comment"), Request::files("fileToUpload")))
				{
					$uploadModel = $this->loadModel('upload');
					$img_name = $uploadModel->uploadImg(Request::files("fileToUpload"));
				}
				else
				{
					$img_name = array(false, "Bitte alle Felder ausfüllen oder Bild zu gross (max. 2MB).");
				}

				if($img_name[0])
				{
					$threadModel->createThread($thread_info["username"], $thread_info["staff"], $thread_info["subject"], $thread_info["comment"], $img_name[1], 1);
					header('Location: ' .WORKING_DIR .'computer/');
					exit();
				}
				else
				{
					$this->index(1, $img_name);
				}

			}
			else
			{
				$this->index();
			}
		}


		public function pin($thread_id = 0)
		{
			//Nur eingeloggte User dürfen Threads sticken
			Session::authenticatedOnly();

			if($thread_id != 0)
			{
				$threadModel = $this->loadModel('thread');
				if($threadModel->pinThread($thread_id))
				{
					header('Location: ' .WORKING_DIR .'computer/');
					exit();
				}
				else
				{
					$error = array(false, "Thread kann nich gepint werden, weil er nicht existiert");
					$this->index(1, $error);
				}

			}
			else
			{
				header('Location: ' .WORKING_DIR .'computer/');
				exit();
			}
		}

		public function unpin($thread_id = 0)
		{
			//Nur eingeloggte User dürfen Threads sticken
			Session::authenticatedOnly();

			if($thread_id != 0)
			{
				$threadModel = $this->loadModel('thread');
				if($threadModel->unpinThread($thread_id))
				{
					header('Location: ' .WORKING_DIR .'computer/');
					exit();
				}
				else
				{
					$error = array(false, "Thread kann nich geunpined werden, weil er nicht existiert");
					$this->index(1, $error);
				}

			}
			else
			{
				header('Location: ' .WORKING_DIR .'computer/');
				exit();
			}
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
					$error = array(false, "Thread kann nich gelöscht werden, weil er nicht existiert.");
					$this->index(1, $error);
				}
			}
			else
			{
				header('Location: ' .WORKING_DIR .'computer/');
				exit();
			}
		}


		public function thread($thread_id = 0, $error = array(true, ""))
		{
			if($thread_id === "create")
			{
				if(isset($_POST['btnPost']) && isset($_POST['thread_id']))
				{
					$postModel = $this->loadModel('post');
			    $post_info = $postModel->createPostValidate(Request::post("thread_id"), Request::post("username"), Request::post("comment"), Request::files("fileToUpload"));
					if($post_info["thread_id"])
					{
						if($post_info["complete"])
						{
							$img_name = array(true, "0");

							if($post_info["image"])
							{
								$uploadModel = $this->loadModel('upload');
					      $img_name = $uploadModel->uploadImg(Request::files("fileToUpload"));
							}

							if($img_name[0])
							{
								$postModel->createPost($post_info["thread_id"], $post_info["username"], $post_info["comment"], $img_name[1], $post_info["staff"]);
								header('Location: ' .WORKING_DIR .'computer/thread/' .$post_info["thread_id"]);
								exit();
							}
							else
							{
								$error = $img_name;
								$this->thread($post_info["thread_id"], $error);
							}
						}
						else
						{
							$error = array(false, "Bitte alle Felder ausfüllen oder Bild zu gross (max. 2MB).");
							$this->thread($post_info["thread_id"], $error);
						}
					}
					else
					{
						$error = array(false, "Thread existiert nicht.");
						$this->index(1, $error);
					}
				}
				else
				{
					$this->index();
				}
			}
			else
			{
				$postModel = $this->loadModel('post');
				$threadPost = $postModel->getThreadPost($thread_id);
				if($threadPost)
				{
					$this->title = $threadPost->threadname;
					$this->renderView('thread', ['error' => $error, 'thread' => $threadPost, 'posts' => $postModel->getAllPosts($thread_id)]);
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
