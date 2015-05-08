<?php

	class Webapp
	{
	
		function __construct()
		{
			if(isset($_GET["url"]))
			{
				$exploded_url = explode("/", $_GET["url"]);
				$controller = $exploded_url[0];
			}
			else
			{
				$controller = "index";
			}
			
			
			switch($controller)
			{
				case "index":
					$this->loadController($controller);
					break;
				
				case "computer":
					$this->loadController($controller);
					break;
					
				default:
					echo "404";
			}
		}
	   
		private function loadController($controller_name)
		{
			if(file_exists(CONTROLLER_PATH . $controller_name . ".contr.php"))
			{
				require_once CONTROLLER_PATH . $controller_name . ".contr.php";
			}
			else
			{
				exit ('The file ' . $controller_name . '.contr.php is missing in the controller folder.');
			}
		}
	   
	}

?>