<?php

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
