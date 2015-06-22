<?php

/**
 * Database.class.php
 *
 * Klasse, um eine Verbindung mit einer MySQL Datenbank zu machen
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
