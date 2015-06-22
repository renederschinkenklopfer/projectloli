<?php

/**
 * Session.class.php
 *
 * Klasse für Session-Operationen/Abfragen
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


  class Session
  {
    public static function start()
    {
      if(empty(session_id()))
      {
          session_start();
      }
    }

    //Statische Methode um Controller-Methoden nur eingeloggten Benutzern zur Verfügung zu stellen
    public static function authenticatedOnly()
    {
      if(!Session::isLoggedIn())
      {
        header('Location: ' .WORKING_DIR. 'login');
        exit();
      }
    }

    //Statische Methode zum prüfen, ob ein User eingeloggt ist
    public static function isLoggedIn()
    {
      if(isset($_SESSION["user_logged_in"]))
      {
        $user_logged_in = $_SESSION["user_logged_in"];
      }
      else
      {
        $user_logged_in = false;
      }

      if($user_logged_in)
      {
        $status = true;
      }
      else
      {
        $status = false;
      }

      return $status;
    }

    public static function destroy()
    {
      session_destroy();
    }

  }

?>
