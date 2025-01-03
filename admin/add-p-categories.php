<?php
  $added = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $name = $conn -> real_escape_string($_POST['name']);
    $sql = "INSERT INTO `products_categories`(name) VALUES('$name')";
    $result = $conn -> query($sql);
    if($result){
      $added = true;
    } else{
      die(mysqli_error($conn));
    }
  }

  $redirectPage = "";
  if($added){
    $redirectPage = "
      <script>
        setTimeout(() => {
          window.location.href = 'add-p-categories.php';
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
  <title>Add Products Categories</title>
  <?php echo $redirectPage; ?>
</head>
<body>
  <form action="add-p-categories.php" method="post" enctype="multipart/form-data" class="p-form">
    <h1>Add Products Categories</h1>
    <input type="text" name="name" placeholder="Type name" autocomplete="off" required><br>
    <div class="img category-btn">
      <button type="submit">Add</button>
    </div>
    <?php
      if($added) echo '<div class="added">Product Imported</div>';
    ?>
    <a href="./add-products.php">Add New</a>
  </form>
</body>
</html>