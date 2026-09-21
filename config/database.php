<?php
  require __DIR__ . '/../env_variables.php';
  
  class DatabaseConfig {
    /** @return mysqli */
    public function connect() { return mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); }

    public function disconnect(mysqli $connection) { return mysqli_close($connection); }
  }
?>