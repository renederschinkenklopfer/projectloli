<?php

	class Controller 
	{
		function __construct()
		{
			
		}
		
		public function loadView($view_name)
		{
			if(file_exists(VIEW_PATH . $view_name . ".html"))
			{
				require_once VIEW_PATH . $view_name . ".html";
			}
			else
			{
				exit ('The file ' . $view_name . '.html is missing in the view folder.');
			}
		}
	}

?>