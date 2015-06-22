<?php

/**
 * postModel.php
 *
 * Model für Post (Beiträge in Threads) Operationen.
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


  class PostModel
  {

    public function getThreadPost($thread_id)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id, username, threadname, message, image_name, date_created, staff, fk_board_id FROM thread WHERE pk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));

      return $query->fetch();
    }


    public function getAllPosts($thread_id)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_post_id, username, message, image_name, date_created, staff FROM post WHERE fk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));

      return $query->fetchAll();
    }


    public function createPostValidate($thread_id, $username, $comment, $image)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id FROM thread WHERE pk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));
      $result = $query->fetch();

      if($result)
      {
        if((!empty($username) || Session::isLoggedIn()) && !empty($comment))
        {
          if(Session::isLoggedIn())
          {
            $post_info = array('username' => $_SESSION["username"], 'staff' => true, 'comment' => trim($comment));
          }
          else
          {
            $post_info = array('username' => trim($username), 'staff' => false, 'comment' => trim($comment));
          }

          $post_info["complete"] = true;

          if(is_uploaded_file($image["tmp_name"]))
          {
            $post_info["image"] = true;
          }
          else
          {
            $post_info["image"] = false;
          }
        }
        else
        {
          $post_info["complete"] = false;
        }

        $post_info["thread_id"] = $thread_id;
      }
      else
      {
        $post_info["thread_id"] = false;
      }

      return $post_info;
    }

    public function createPost($thread_id, $username, $comment, $image_name, $staff = false)
    {
       $database = Database::getFactory()->getConnection();

       $sql = "INSERT INTO `webapp`.`post` (`username`, `message`, `image_name`, `date_created`, `staff`, `fk_thread_id`) VALUES (:username, :comment, :image_name, CURRENT_TIMESTAMP, :staff, :thread_id);";
       $query = $database->prepare($sql);
       $query->execute(array(':username' => $username, ':comment' => $comment, ':image_name' => $image_name, ':staff' => $staff, ':thread_id' => $thread_id));
    }

    public static function getElapsedTime($ptime)
    {
        $etime = time() - strtotime($ptime);

        if ($etime < 1)
        {
            return '0 seconds ago';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => 'years',
                           'month'  => 'months',
                           'day'    => 'days',
                           'hour'   => 'hours',
                           'minute' => 'minutes',
                           'second' => 'seconds'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

  }

?>
