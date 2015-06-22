<?php

/**
 * config.php
 *
 * Config File für projektweite Konfigurationen
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



	define("WEBAPP_NAME", "This is why i'm laughing");
	//Verzeichis, in welchem das Projekt liegt
	define("WORKING_DIR", "/projectloli/");

	define("CLASS_PATH", "application/core/");
	define("CONTROLLER_PATH", "application/controller/");
	define("MODEL_PATH", "application/model/");
	define("VIEW_PATH", "application/view/");

	define("DB_TYPE", "mysql");
	define("DB_HOST", "127.0.0.1");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "webapp");


	//Jedes Board bekommt ein Kürzel und eine eindeutige Nummer
	//Alle Boards müssen hier ebenfalls aufgelistet werden
	function getBoard($board_id)
	{
		switch($board_id)
		{
			case 1:
				$board_name = "computer";
				break;
			case 2:
				$board_name = "gif";
				break;
			case 3:
				$board_name = "nsfw";
				break;
			case 4:
				$board_name = "funny";
				break;
			case 5:
				$board_name = "nosleep";
				break;
		}

		return $board_name;

	}

?>
