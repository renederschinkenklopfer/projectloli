<?php

/**
 * gif.controller.php
 *
 * Controller für das Board Gif. Das Topic dieses Boards sollen animierte Bilder im GIF-Format sein.
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


	class Gif extends Board
	{
		public $board_id = 2;

		public function __construct()
		{
			parent::__construct($this->board_id);

		}

		public function index($page = 1, $error = array(true, ""))
	  {
	    $threadModel = $this->loadModel('thread');
	    $this->title = "Gif Animated Images";
	    $this->renderLayoutView('board', ['error' => $error, 'page' => $page, 'threads' => $threadModel->getAllThreadsBoard($this->board_id, $page)]);
	  }


	}
?>
