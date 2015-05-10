<?php

  class Thread
  {

    public function getAllThreads()
    {
      $database = Database::getFactory()->getConnection();

      $sql = "SELECT pk_thread_id, username, threadname, message, image_name, likes, date_created FROM thread WHERE fk_board_id = :board_id";
      $query = $database->prepare($sql);
      $query->execute(array(':board_id' => 1));

      return $query->fetchAll();
    }

  }

?>
