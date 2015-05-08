<?php

	class Webapp
	{
		private $url = "";
	
		function __construct()
		{
			if(isset($_GET["url"]))
			{
				$url = $_GET["url"];
				echo $url;
			}
			else
			{
				$url = "";
			}
		}
	}

?>