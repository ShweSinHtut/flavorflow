<?php
  include('../connect.php');
  $id = $_GET['id'];
  $sql = "DELETE FROM `add_products` WHERE id = $id";
  if($conn -> query($sql)) {
    header('location: products-list.php');
  } 
  $conn -> close();
?>