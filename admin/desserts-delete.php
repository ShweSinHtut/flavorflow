<?php
  include('../connect.php');
  $id = $_GET['id'];

  $sql = "DELETE FROM add_desserts WHERE id = $id";

  if($conn -> query($sql)){
    header('location: desserts-list.php');
  }
  $conn -> close();
?>
