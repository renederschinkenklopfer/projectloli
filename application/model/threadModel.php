<?php

  class ThreadModel
  {

    public function getAllThreadsBoard($board_id, $page = 1)
    {
	     $page = ($page - 1) * 20;

       $database = Database::getFactory()->getConnection();

      $sql = "SELECT thread.pk_thread_id, thread.sticky, thread.username, thread.staff, thread.threadname, thread.message, thread.image_name, thread.date_created, GREATEST(thread.date_created, COALESCE(MAX(post.date_created), 0)) as datemax, COUNT(fk_thread_id) AS replies FROM thread LEFT JOIN post ON fk_thread_id = pk_thread_id WHERE fk_board_id = :board_id GROUP BY pk_thread_id ORDER BY sticky DESC, datemax DESC LIMIT :page, 20";
      $query = $database->prepare($sql);
  	  $query->bindParam(':board_id', $board_id, PDO::PARAM_INT);
  	  $query->bindParam(':page', $page, PDO::PARAM_INT);
  	  $query->execute();

      return $query->fetchAll();
    }

    public function getAllThreads($page = 1)
    {
	     $page = ($page - 1) * 20;

       $database = Database::getFactory()->getConnection();

      $sql = "SELECT thread.pk_thread_id, thread.sticky, thread.username, thread.staff, thread.threadname, thread.message, thread.image_name, thread.date_created, GREATEST(thread.date_created, COALESCE(MAX(post.date_created), 0)) as datemax, COUNT(fk_thread_id) AS replies FROM thread LEFT JOIN post ON fk_thread_id = pk_thread_id GROUP BY pk_thread_id ORDER BY sticky DESC, datemax DESC LIMIT :page, 20";
      $query = $database->prepare($sql);
  	  $query->bindParam(':page', $page, PDO::PARAM_INT);
  	  $query->execute();

      return $query->fetchAll();
    }

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


    public function createThread($username, $staff, $subject, $comment, $image_name, $board_id)
    {
       $database = Database::getFactory()->getConnection();

       $sql = "INSERT INTO `webapp`.`thread` (`username`, `staff`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (:username, :staff, :subject, :comment, :image_name, CURRENT_TIMESTAMP, :fk_board_id);";
       $query = $database->prepare($sql);
       $query->execute(array(':username' => $username, ':staff' => $staff, ':subject' => $subject, ':comment' => $comment, ':image_name' => $image_name, ':fk_board_id' => $board_id));
    }


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
