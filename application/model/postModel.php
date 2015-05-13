<?php

  class PostModel
  {

	 public function createPost($thread_id, $username, $comment, $image_name)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "INSERT INTO `webapp`.`post` (`username`, `message`, `image_name`, `date_created`, `fk_thread_id`) VALUES (:username, :comment, :image_name, CURRENT_TIMESTAMP, :thread_id);";
      $query = $database->prepare($sql);
      $query->execute(array(':username' => $username, ':comment' => $comment, ':image_name' => $image_name, ':thread_id' => $thread_id));

    }
 

    public function getThreadPost($thread_id)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id, username, threadname, message, image_name, date_created, fk_board_id FROM thread WHERE pk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));

      return $query->fetch();
    }


    public function getAllPosts($thread_id)
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_post_id, username, message, image_name, date_created FROM post WHERE fk_thread_id = :thread_id";
      $query = $database->prepare($sql);
      $query->execute(array(':thread_id' => $thread_id));

      return $query->fetchAll();
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
