<?php

/**
 * Controller.class.php
 *
 * Vater-Controller für alle Controller im Projekt. Bietet Basisfunktionen wie ein Model oder eine View laden.
 * Diese Klasse sollte von jedem Controller aufgerufen werden.
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


	class Controller
	{

		function __construct()
		{

			//Auf jeder Seite eine Session starten
			Session::start();
		}

		//Methode um ein Model zu laden
		protected function loadModel($model)
		{
			if(file_exists(MODEL_PATH . $model . "Model.php"))
			{
				require_once MODEL_PATH . $model . "Model.php";
			}
			else
			{
				exit ('The file ' . $model . 'Model.php is missing in the model folder.');
			}

			$model_name = $model ."Model";

			return new $model_name();
		}


		//Methode um eine View MIT Header und Footer zu rendern
		protected function renderLayoutView($view, $data = [])
		{

			foreach ($data as $key => $value)
			{
					$this->$key = $value;
			}

			if(file_exists(VIEW_PATH . $view . ".html"))
			{
				require_once VIEW_PATH . "_header.html";
				require_once VIEW_PATH . $view . ".html";
				require_once VIEW_PATH . "_footer.html";
			}
			else
			{
				exit ('The file ' . $view . '.html is missing in the view folder.');
			}
		}

		//Methode um eine View OHNE Header und Footer zu rendern
		protected function renderView($view, $data = [])
		{

			foreach ($data as $key => $value)
			{
					$this->$key = $value;
			}

			if(file_exists(VIEW_PATH . $view . ".html"))
			{
				require_once VIEW_PATH . $view . ".html";
			}
			else
			{
				exit ('The file ' . $view . '.html is missing in the view folder.');
			}
		}
	}

?>
