<?php
  $host = 'localhost';
  $username = 'root';
  $pwd = '';
  $dbname = 'restaurant';

  $conn = mysqli_connect($host, $username, $pwd, $dbname, 3307);
  // $conn -> new mysqli($host, $username, $pwd, $dbname, 3307);
  
  if(!$conn) die(mysqli_error($conn));
?>