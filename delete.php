<?php 
  include('./config/connect.php');
  $id = $_GET['id'];

  $sql = "DELETE FROM product WHERE product.id = '$id'";
  $query = mysqli_query($connect, $sql);
    
  header( "location: index.php" );
  exit(0);
?>