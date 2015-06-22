<?php

/**
 * Request.class.php
 *
 * Klasse um die $_POST und $_FILES-Variablen zu initialisieren.
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
