<?php

/**
 * Webapp.class.php
 *
 * Root Klasse im ganzen Projekt. Hier findet das URL-Routing und das Laden des entsprechenden Controllers statt.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @copyright  2015 Yolo Inc.
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0
 */


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


		private function parseUrl()
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

	}

?>
