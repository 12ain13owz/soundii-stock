<?php 
  $host = "localhost";
  $user = "root";
  $pass = "";
  $dbname = "soundii";
  $connect = mysqli_connect($host, $user, $pass, $dbname);

  if (!$connect) {
    echo "Cannot connect Database soundii";
  }

  mysqli_set_charset($connect, 'utf8');
?>