<?php

/**
 * init.php
 *
 * Initialisierungsfile. Die Core-Files werden hier in die Webapp eingebunden.
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


	require_once('application/core/config.php');


	function autoload($class)
	{
		if (file_exists(CLASS_PATH . $class . ".class.php"))
		{
			require_once CLASS_PATH . $class . ".class.php";
		}
		else
		{
			exit ('The file ' . $class . '.class.php is missing in the folder.');
		}
	}

	spl_autoload_register("autoload");


	/*!!Bei produktivem Gebrauch entfernen!!
	Die ganze Datenbank wird mit Folgendem Code jedes mal gelöscht
	und neu erstellt um Änderungen in der Datenbankstrukutr
	sofort wirksam zu machen*/
	require_once('application/core/db_setup.php');
?>
