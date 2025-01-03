<?php
  include('../connect.php');
  if(isset($_GET['type'])){
    $typeId = $conn -> real_escape_string($_GET['type']);
    $type = $conn -> query("SELECT * FROM add_products WHERE p_category_id = $typeId");
  } else{
    $type = $conn -> query("SELECT * FROM `add_products`");
  }
  $conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="stylesheet" href="./style/list.css">
</head>
<body>
  <div class="container">
    <div class="nav">
      <i class="fa-solid fa-arrows-rotate"></i>

      <div class="switch-btn">
        <a href="./add-products.php" class="add-new">Add New</a>
        <a href="./p-category-list.php" class="categories">Categories</a>
      </div>

      <div class="options">
        <div class="session-list">
          <a href="products-list.php" class="active">Products List</a>
          <a href="./desserts-list.php">Desserts List</a>
          <a href="./p-category-list.php">Products Categories List</a>
          <a href="./d-category-list.php">Desserts Categories List</a>
          <a href="./logout.php">Log out</a>
        </div>

        <div class="category-list">
          <?php
            include('../connect.php');
            $sql = $conn -> query("SELECT * FROM `products_categories`");
            while($cat = $sql -> fetch_assoc()){
              ?>
                <a href="products-list.php?type=<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a>
              <?php
            }
            $conn -> close();
          ?>
        </div>
      </div>
    </div>

    <h1>Products List</h1>

    <div class="p-container">
      <?php
        include('../connect.php');
        while($row = $type -> fetch_assoc()){
          ?>
            <div class="products">
              <div>
                <img src="../images/<?php echo $row['image']; ?>">
                <div class="details">
                  <div class="name">--- <?php echo $row['name']; ?> ---</div>
                  <div class="price"><?php echo $row['price']; ?> MMK</div>
                  <div class="ingredients"><?php echo $row['ingredients']; ?></div>
                  <div class="modify-btn">
                    <a href="products-edit.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="products-delete.php?id=<?php echo $row['id']; ?>" 
                    onClick="return confirm('Are you sure to delete this product')"><i class="fa-solid fa-circle-minus"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php
        }
        $conn -> close();
      ?>
    </div>
  </div>

  <script src="./script/list.js"></script>
</body>
</html>