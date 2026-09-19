<?php
  require 'env_variables.php';
  
  $dbConnection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
  if( !$dbConnection ) echo "Connection error: " . mysqli_connect_error();
?>