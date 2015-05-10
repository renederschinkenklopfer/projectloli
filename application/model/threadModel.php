<?php

  class ThreadModel
  {

    public function getAllThreads()
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id, username, threadname, message, image_name, likes, date_created FROM thread WHERE fk_board_id = :board_id";
      $query = $database->prepare($sql);
      $query->execute(array(':board_id' => 1));

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
