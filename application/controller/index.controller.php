<?php

/**
 * index.controller.php
 *
 * Controller für die Startseite. Die Startseite zeigt die aktuellesten Threads aus allen Boards an.
 * Da es sich hier nicht um ein eigenes Board, sondern aus einer Zusammenstellung aus andern Boards handelt,
 * wurden einige Methoden mit einem 404-Fehler überschrieben.
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


	class Index extends Board
	{

		//Die News-Page ist kein eigenes Board, sondern eine Zusammenstellung aus den neusten Beiträgen aus allen Boards
		public $board_id = 0;

		public function __construct()
		{
			parent::__construct($this->board_id);

		}

		public function index($page = 1, $error = array(true, ""))
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "New";
			$this->renderLayoutView('board', ['error' => $error, 'page' => $page, 'threads' => $threadModel->getAllThreads($page)]);
		}


		//Die News-Page hat keine eigenen Beiträge und braucht desshalb folgende Mehtoden nicht
		public function create()
		{
			require_once(CONTROLLER_PATH .'Error404' .".controller.php");
			$error404 = new Error404;
			$error404->index();
		}

		public function pin()
		{
			require_once(CONTROLLER_PATH .'Error404' .".controller.php");
			$error404 = new Error404;
			$error404->index();
		}

		public function unpin()
		{
			require_once(CONTROLLER_PATH .'Error404' .".controller.php");
			$error404 = new Error404;
			$error404->index();
		}

		public function thread()
		{
			require_once(CONTROLLER_PATH .'Error404' .".controller.php");
			$error404 = new Error404;
			$error404->index();
		}

	}
?>
