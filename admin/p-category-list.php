<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/category-list.css">
  <title>Products Categories List</title>
</head>
<body>
  <div class="container">
    <div class="nav">
      <a href="./add-p-categories.php">Add New</a>
      <div class="session-list">
        <a href="products-list.php">Products List</a>
        <a href="./desserts-list.php">Desserts List</a>
        <a href="p-category-list.php" class="active">Products Categories List</a>
        <a href="./d-category-list.php">Desserts Categories List</a>
        <a href="./logout.php">Log out</a>
      </div>
    </div>

    <h1>Products Categories List</h1>

    <div class="lists">
      <?php
        include('../connect.php');
        $sql = $conn -> query("SELECT * FROM `products_categories`");
        while($row = $sql -> fetch_assoc()){
          ?>
            <div class="list-row">
              <div class="name"><?php echo $row['name']; ?></div>
              <a href="./p-category-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            </div>
          <?php
        }
        $conn -> close();
      ?>
    </div>
  </div>
</body>
</html>