<?php
  include('./config/connect.php');

  $sql10 = "SELECT COUNT(*) as total FROM log WHERE log.read = 0";
  $query10 = mysqli_query($connect, $sql10);
  $data10 = mysqli_fetch_assoc($query10);
  $amount = $data10['total'];
?>