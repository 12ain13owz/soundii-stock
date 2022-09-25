<?php 
  include('./config/connect.php');
  $id = $_GET['id'];

  $sql = "DELETE FROM account WHERE account.id = '$id'";
  $query = mysqli_query($connect, $sql);
    
  header( "location: setting.php" );
  exit(0);
?>