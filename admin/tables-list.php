<?php
  include('../connect.php');
  if(isset($_GET['type'])){
    $typeId = $conn -> real_escape_string($_GET['type']);
    $type = $conn -> query("SELECT * FROM add_tables WHERE t_category_id = $typeId");
  } else{
    $type = $conn -> query("SELECT * FROM `add_tables`");
  }
  $conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="stylesheet" href="./style/tables-list.css">
  <title>Tables List</title>
</head>
<body>
  <div class="nav">
    <i class="fa-solid fa-arrows-rotate"></i>

    <div class="switch-btn">
      <a href="./add-tables.php" class="add-new">Add New</a>
      <a href="./t-category-list.php" class="categories">Categories</a>
    </div>

    <div class="options">
      <div class="session-list">
        <a href="tables-list.php" class="active">Tables List</a>
        <a href="./t-category-list.php">Tables Categories List</a>
        <a href="logout.php">Log out</a>
      </div>

      <div class="category-list">
        <?php
          include('../connect.php');
          $sql = $conn -> query("SELECT * FROM `tables_categories`");
          while($cat = $sql -> fetch_assoc()){
            ?>
              <a href="tables-list.php?type=<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a>
            <?php
          }
          $conn -> close();
        ?>
      </div>
    </div>
  </div>

  <h1>Tables List</h1>

  <div class="t-container">
    <?php
      include('../connect.php');
      while($row = $type -> fetch_assoc()){
        ?>
          <div class="table">
            <div class="t-name-status">
              <a href="./t-reservation.php?id=<?php echo $row['id']; ?>" class="t-id-name"><?php echo $row['t_id']; ?></a>
              <?php 
                if($row['status'] == 'active') : ?>
                  <div class="t-active"></div>
                <?php elseif($row['status'] == 'occupied') : ?>
                  <div class="t-occupied"></div>
                <?php endif;
              ?>
            </div>

            <div class="t-btn">
              <a href="tables-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
              <a href="tables-delete.php?id=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure to delete this table?')">Delete</a>
            </div>
          </div>
        <?php
      }
      $conn -> close();
    ?>
  </div>

  <script src="./script/list.js"></script>
</body>
</html>