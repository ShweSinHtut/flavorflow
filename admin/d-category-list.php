<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/category-list.css">
  <title>Desserts Categories List</title>
</head>
<body>
  <div class="container">
    <div class="nav">
      <a href="./add-d-categories.php">Add New</a>
      <div class="session-list">
        <a href="products-list.php">Products List</a>
        <a href="./desserts-list.php">Desserts List</a>
        <a href="./p-category-list.php">Products Categories List</a>
        <a href="d-category-list.php" class="active">Desserts Categories List</a>
        <a href="./logout.php">Log out</a>
      </div>
    </div>

    <h1>Desserts Categories List</h1>

    <div class="lists">
      <?php
        include('../connect.php');
        $sql = $conn -> query("SELECT * FROM `desserts_categories`");
        while($row = $sql -> fetch_assoc()){
          ?>
            <div class="list-row">
              <div class="name"><?php echo $row['name']; ?></div>
              <a href="./d-category-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            </div>
          <?php
        }
        $conn -> close();
      ?>
    </div>
  </div>
</body>
</html>