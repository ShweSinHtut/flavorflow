<?php
  $added = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $name = $conn -> real_escape_string($_POST['name']);
    $seats = $conn -> real_escape_string($_POST['seats']);
    $price = $conn -> real_escape_string($_POST['price']);
    $sql = "INSERT INTO `tables_categories` (name, seats, price) VALUES ('$name', '$seats', '$price');";
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
          window.location.href = 'add-t-categories.php';
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
  <title>Add Tables Categories</title>
  <?php echo $redirectPage; ?>
</head>
<body>
  <form action="add-t-categories.php" method="post" enctype="multipart/form-data" class="p-form">
    <h1>Add Tables Categories</h1>
    <input type="text" name="name" placeholder="Type name" autocomplete="off" required><br>
    <input type="text" name="seats" placeholder="Type no of seats" autocomplete="off" required><br>
    <input type="text" name="price" placeholder="Type price" autocomplete="off" required class="t-price"><br>
    <div class="img category-btn">
        <button type="submit">Add</button>
    </div>
    <?php
      if($added) echo '<div class="added">Table Imported</div>';
    ?>
  </form>
</body>
</html>