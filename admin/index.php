<?php 
  $fail = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    session_start();
    $name = $conn -> real_escape_string($_POST['name']);
    $password = $conn -> real_escape_string($_POST['password']);

    if($name == 'admin' && $password = '12345'){
      header('location: admin-option.php');
    }else{
      $fail = true;
    }

    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/form.css">
  <title>Welcome Admin</title>
</head>
<body>
  <form action="index.php" method="post" enctype="multipart/form-data" class="login-container">
    <h1>Welcome Admin</h1>
    <input type="text" name="name" placeholder="Enter username" autocomplete="off" required class="login-form"><br>
    <input type="password" name="password" placeholder="Enter password">
    <button type="submit" class="login">Login</button>
    <?php
      if($fail) echo '<div class="fail">Username or password is wrong.</div>';
    ?>
  </form>
</body>
</html>