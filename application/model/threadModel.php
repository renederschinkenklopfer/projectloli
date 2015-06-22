<?php

/**
 * threadModel.php
 *
 * Model für Thread Operationen.
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


  class ThreadModel
  {

	//Methode um alle Threads eines Boards anzuzeigen und zu ordnen
    public function getAllThreadsBoard($board_id, $page = 1)
    {
	     $page = ($page - 1) * 20;

       $database = Database::getFactory()->getConnection();
	  //Anzeigen aller Threads aus einem bestimmten Board/Kategorie. Stickys werden zuerst angezeigt. Nachher wird nach neusten/Zuletzt geänderten (Post hinzugefügt) Threads geordnet. 
      $sql = "SELECT thread.pk_thread_id, thread.sticky, thread.username, thread.staff, thread.threadname, thread.message, thread.image_name, thread.date_created, thread.fk_board_id, GREATEST(thread.date_created, COALESCE(MAX(post.date_created), 0)) as datemax, COUNT(fk_thread_id) AS replies FROM thread LEFT JOIN post ON fk_thread_id = pk_thread_id WHERE fk_board_id = :board_id GROUP BY pk_thread_id ORDER BY sticky DESC, datemax DESC LIMIT :page, 20";
      $query = $database->prepare($sql);
  	  $query->bindParam(':board_id', $board_id, PDO::PARAM_INT);
  	  $query->bindParam(':page', $page, PDO::PARAM_INT);
  	  $query->execute();

      return $query->fetchAll();
    }

	//Methode um alle Threads aus allen Boards anzuzeigen und zu ornden
    public function getAllThreads($page = 1)
    {
	     $page = ($page - 1) * 20;

       $database = Database::getFactory()->getConnection();
	  //Anzeigen aller Threads aus allen Board/Kategorie. Geordnet nach neusten Threads/Zuletzt geänderten (Post hinzugefügt) Threads zuerst. Ausgeblendet werden Stickys und 18+ Threads.
      $sql = "SELECT thread.pk_thread_id, thread.sticky, thread.username, thread.staff, thread.threadname, thread.message, thread.image_name, thread.date_created, thread.fk_board_id, GREATEST(thread.date_created, COALESCE(MAX(post.date_created), 0)) as datemax, COUNT(fk_thread_id) AS replies FROM thread LEFT JOIN post ON fk_thread_id = pk_thread_id WHERE sticky = 0 AND fk_board_id != 3 GROUP BY pk_thread_id ORDER BY datemax DESC LIMIT :page, 20";
      $query = $database->prepare($sql);
  	  $query->bindParam(':page', $page, PDO::PARAM_INT);
  	  $query->execute();

      return $query->fetchAll();
    }

	//Methode um zu validieren, ob alle Anforderungen erfüllt wurden, um einen neuen Thread zu erstellen
    public function createThreadValidate($username, $subject, $comment, $image)
    {
      if((!empty($username) || Session::isLoggedIn()) && !empty($subject) && !empty($comment) && is_uploaded_file($image["tmp_name"]))
      {
        if(Session::isLoggedIn())
        {
          $thread_info = array('username' => $_SESSION["username"], 'staff' => true, 'subject' => trim($subject), 'comment' => trim($comment));
        }
        else
        {
          $thread_info = array('username' => trim($username), 'staff' => false, 'subject' => trim($subject), 'comment' => trim($comment));
        }
      }
      else
      {
        $thread_info = false;
      }

      return $thread_info;
    }

	//Methode um einen neuen Thread in der Datenbank zu erstellen
    public function createThread($username, $staff, $subject, $comment, $image_name, $board_id)
    {
       $database = Database::getFactory()->getConnection();

       $sql = "INSERT INTO `webapp`.`thread` (`username`, `staff`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (:username, :staff, :subject, :comment, :image_name, CURRENT_TIMESTAMP, :fk_board_id);";
       $query = $database->prepare($sql);
       $query->execute(array(':username' => $username, ':staff' => $staff, ':subject' => $subject, ':comment' => $comment, ':image_name' => $image_name, ':fk_board_id' => $board_id));
    }

	//Methode um als Administrator einen Thread zu pinnen (dass er immer ganz oben angezeigt wird)
    public function pinThread($thread_id)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id FROM thread WHERE pk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));
      $result = $query->fetch();

      if($result)
      {
        $sql = "UPDATE thread SET sticky = true WHERE pk_thread_id = :thread_id;";
        $query = $database->prepare($sql);
        $query->execute(array(':thread_id' => $thread_id));

        $status = true;
      }
      else
      {
        $status = false;
      }

      return $status;
    }

	//Methode um als Administrator einen Thread zu entpinnen
    public function unpinThread($thread_id)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id FROM thread WHERE pk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));
      $result = $query->fetch();

      if($result)
      {
        $sql = "UPDATE thread SET sticky = false WHERE pk_thread_id = :thread_id;";
        $query = $database->prepare($sql);
        $query->execute(array(':thread_id' => $thread_id));

        $status = true;
      }
      else
      {
        $status = false;
      }

      return $status;
    }

	//Methode um einen Thread aus der Datenbank, sowie die dazugehörigen Files auf der Festplatte zu löschen
    public function deleteThread($thread_id)
    {
       $database = Database::getFactory()->getConnection();

       $sql = "SELECT image_name FROM thread WHERE pk_thread_id = :thread_id";
       $query = $database->prepare($sql);
       $query->execute(array(':thread_id' => $thread_id));
       $result = $query->fetch();

       if($result)
       {
         //Bild vom Thread auf der Festplatte löschen
         unlink(getcwd() ."\\public\\img\\" .$result->image_name);

         $sql = "SELECT image_name FROM post WHERE fk_thread_id = :thread_id";
         $query = $database->prepare($sql);
         $query->execute(array(':thread_id' => $thread_id));
         $result = $query->fetchAll();

         if($result)
         {
           foreach($result as $value)
           {
             //Bilder von den entsprechenden Posts von der Festplatte löschen
             if($value->image_name != "0")
             {
               unlink(getcwd() ."\\public\\img\\" .$value->image_name);
            }
           }
         }

         $sql = "DELETE FROM thread WHERE pk_thread_id = :thread_id";
         $query = $database->prepare($sql);
         $query->execute(array(':thread_id' => $thread_id));

         $status = true;
       }
       else
       {
         $status = false;
       }

       return $status;

    }

	//Methode um von einem Datum die vergangene Zeit zurückzugeben 2015-03-15 15:00:00 -> 3hours ago
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
