<?php

  class Request
  {

    public static function post($post_var)
    {
      return isset($_POST[$post_var]) ? $_POST[$post_var] : "";
    }


    public static function files($files_var)
    {
      return isset($_FILES[$files_var]) ? $_FILES[$files_var] : "";
    }

  }

?>
