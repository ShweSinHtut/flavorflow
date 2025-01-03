<?php
  $added = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $name = $conn -> real_escape_string($_POST['name']);
    $sql = "INSERT INTO `desserts_categories` (name) VALUES ('$name');";
    $result = $conn -> query($sql);
    if($result) {
      $added = true;
    }else {
      die(mysqli_error($conn));
    }
    $conn -> close();
  }

  $redirectPage = "";
  if($added){
    $redirectPage = "
      <script>
        setTimeout(() => {
          window.location.href = 'add-d-categories.php';
        }, 1000);
      </script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/form.css">
  <title>Add Desserts Categories</title>
  <?php echo $redirectPage; ?>
</head>
<body>
  <form action="add-d-categories.php" method="post" enctype="multipart/form-data" class="p-form">
    <h1>Add Desserts Categories</h1>
    <input type="text" name="name" placeholder="Type name" autocomplete="off" required><br>
    <div class="img category-btn">
        <button type="submit">Add</button>
    </div>
    <?php
      if($added) echo '<div class="added">Dessert Imported</div>';
    ?>
  </form>
</body>
</html>