<?php
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
