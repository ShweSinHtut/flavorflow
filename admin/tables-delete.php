<?php
  if(isset($_GET['id'])){
    include('../connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("DELETE FROM `add_tables` WHERE id = $id");
    header('location: tables-list.php');
    $conn -> close();
  }

?>