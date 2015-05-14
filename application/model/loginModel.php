<?php

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
