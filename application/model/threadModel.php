<?php

  class ThreadModel
  {

    public function getAllThreads()
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT thread.pk_thread_id, thread.username, thread.threadname, thread.message, thread.image_name, thread.likes, thread.date_created, COUNT(fk_thread_id) AS replies FROM thread LEFT JOIN post ON fk_thread_id = pk_thread_id WHERE fk_board_id = :board_id GROUP BY pk_thread_id ORDER BY pk_thread_id DESC";
      $query = $database->prepare($sql);
      $query->execute(array(':board_id' => 1));

      return $query->fetchAll();
    }


    public function createThread($username, $subject, $comment, $image_name)
    {
       $database = Database::getFactory()->getConnection();

       $sql = "INSERT INTO `webapp`.`thread` (`username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (:username, :subject, :comment, :image_name, '0', CURRENT_TIMESTAMP, '1');";
       $query = $database->prepare($sql);
       $query->execute(array(':username' => $username, ':subject' => $subject, ':comment' => $comment, ':image_name' => $image_name));
    }

    public function deleteThread($thread_id)
    {
       $database = Database::getFactory()->getConnection();

       $sql = "DELETE FROM thread WHERE pk_thread_id = :thread_id";
       $query = $database->prepare($sql);
       $query->execute(array(':thread_id' => $thread_id));

       if($query->rowCount() > 0)
       {
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
