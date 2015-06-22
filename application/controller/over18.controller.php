<?php

/**
 * over18.controller.php
 *
 * Controller für die 18+ Warnung, welche auf das NSFW Board weiterleitet.
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


	class Over18 extends Controller
	{

		public function __construct()
		{

			//Wichtig, dass bei jedem Controller der Vater-Controller aufgerufen wird.
			parent::__construct();

		}

		public function index()
		{
			$threadModel = $this->loadModel('thread');
			$this->title = "Sure ur not underage?";
			$this->renderView('over18');
		}

	}
?>
