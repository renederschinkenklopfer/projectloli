<?php

	class Controller
	{

		function __construct()
		{

		}


		public function loadModel($model)
		{
			if(file_exists(MODEL_PATH . $model . ".model.php"))
			{
				require_once MODEL_PATH . $model . ".model.php";
			}
			else
			{
				exit ('The file ' . $model . '.model.php is missing in the model folder.');
			}

			return new $model();
		}


		//Funktion um eine View MIT Header und Footer zu rendern
		public function renderLayoutView($view, $data = [])
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

		//Funktion um eine View OHNE Header und Footer zu rendern
		public function renderView($view, $data = [])
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
