<?php

  class Database
  {

  	private static $factory;
  	private $database;

  	public static function getFactory()
  	{
  		if (!self::$factory)
      {
  			self::$factory = new Database();
  		}
  		return self::$factory;
  	}

  	public function getConnection()
    {
  		if (!$this->database)
      {
  			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
  			$this->database = new PDO(DB_TYPE .':host=' .DB_HOST .';dbname=' .DB_NAME .';port=3306' .';charset=utf8', DB_USER, DB_PASS, $options);
  		}

  		return $this->database;
  	}
  }

?>
