<?php

/**
 * loginModel.php
 *
 * Model für Login-Operationen
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


  class LoginModel
  {

    public function login($username, $password)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_user_id, username, password FROM user WHERE username = :username LIMIT 1";
      $query = $database->prepare($sql);
      $query->execute(array(':username' => $username));

      $result = $query->fetch();
      if(isset($result->pk_user_id))
      {
        $db_password = $result->password;

        if(password_verify($password, $db_password))
        {
          $_SESSION["user_id"] = $result->pk_user_id;
          $_SESSION["username"] = $result->username;
          $_SESSION["user_logged_in"] = true;

          $status = true;
        }
        else
        {
          $status = false;
        }
      }
      else
      {
        $status = false;
      }

      return $status;
    }

  }

?>
