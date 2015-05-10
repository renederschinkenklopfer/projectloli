<?php

	class Webapp
	{
		protected $controller = 'Error404';
		protected $method = 'index';
		protected $params = [];

		public function __construct()
		{
			$url = $this->parseUrl();

			if(file_exists(CONTROLLER_PATH .$url[0] .".controller.php"))
			{
				$this->controller = $url[0];
				unset($url[0]);
			}

			require_once(CONTROLLER_PATH .$this->controller .".controller.php");
			$this->controller = new $this->controller;

			if(isset($url[1]))
			{
				if(method_exists($this->controller, $url[1]))
				{
					$this->method = $url[1];
					unset($url[1]);
				}
				else
				{
					unset($this->controller);
					require_once(CONTROLLER_PATH .'Error404' .".controller.php");
					$this->controller = new Error404;
				}
			}

			$this->params = $url ? array_values($url) : [];
			call_user_func_array([$this->controller, $this->method], $this->params);
		}


		public function parseUrl()
		{
			if(isset($_GET["url"]))
			{
				$url = explode('/', filter_var(rtrim($_GET["url"], '/'), FILTER_SANITIZE_URL));
			}
			else
			{
				$url = ['index', 'index'];
			}

			return $url;
		}
/*
		private function loadController($controller_name)
		{
			if(file_exists(CONTROLLER_PATH .$controller_name .".controller.php"))
			{
				require_once CONTROLLER_PATH .$controller_name .".controller.php";
			}
			else
			{
				require_once CONTROLLER_PATH ."404.controller.php";
			}
		}
*/

	}

?>
