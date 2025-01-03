<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/t-category-list.css">
  <title>Tables Categories List</title>
</head>
<body>
  <div class="nav">
    <div class="switch-btn">
      <a href="./add-t-categories.php" class="add-new">Add New</a>
      <a href="./t-category-list.php" class="categories">Categories</a>
    </div>

    <div class="options">
      <a href="./tables-list.php">Tables List</a>
      <a href="t-category-list.php" class="active">Tables Categories List</a>
      <a href="logout.php">Log out</a>
    </div>
  </div>

  <h1>Tables Categories List</h1>

  <div class="tables">    
    <?php
      include('../connect.php');
      $sql = $conn -> query("SELECT * FROM `tables_categories`");
      while($row = $sql -> fetch_assoc()){
        ?>
          <div class="lists">
            <div class="name"><?php echo $row['name']; ?></div>
            <div class="seats">Seats - <?php echo $row['seats']; ?></div>
            <div class="price"><?php echo $row['price']; ?> MMK</div>
            <a href="t-category-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
          </div>
        <?php
      }
    ?>
  </div>
</body>
</html>