<?php
  include('./config/connect.php');

  $sql11 = "SELECT * FROM setting";
  $query11 = mysqli_query($connect, $sql11);
  $rows11 = mysqli_num_rows($query11);
  $notify11 = 10;

  if ($rows11 < 1){
    $sql11 = "INSERT INTO setting (notify) VALUES ($notify11)";  
    $query11 = mysqli_query($connect, $sql11);
  } else {
    $data11 = mysqli_fetch_assoc($query11);
    $notify11 = $data11['notify'];
  }

  $sql11 = "SELECT COUNT(*) as total FROM product WHERE product.stock <= $notify11";
  $query11 = mysqli_query($connect, $sql11);
  $data11 = mysqli_fetch_assoc($query11);
  $stock11 = $data11['total'];
?>