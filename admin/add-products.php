<?php
  $added = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $name = $conn -> real_escape_string($_POST['name']);
    $categoryId = $conn -> real_escape_string($_POST['category_id']);
    $price = $conn -> real_escape_string($_POST['price']);
    $ingredients = $conn -> real_escape_string($_POST['ingredients']);
    
    $img = $_FILES['img'];
    $imgName = $img['name'];
    $imgTmp = $img['tmp_name'];
    $imgSeparate = explode('.', $imgName);
    $imgExtension = strtolower(end($imgSeparate));
    
    $extension = array('jpeg', 'jpg', 'png');
    if(in_array($imgExtension, $extension)){
      $upload = '../images/'.$imgName;
      move_uploaded_file($imgTmp, $upload);
      $sql = "INSERT INTO `add_products` (`p_category_id`, `name`, `price`, `ingredients`, `image`) VALUES ('$categoryId', '$name', '$price', '$ingredients', '$imgName')";
      $result = $conn -> query($sql);

      if($result){
        $added = true;
      } else{
        die(mysqli_error($conn));
      }
    }
  }

  $redirectPage = "";
  if($added){
    $redirectPage = "
      <script>
        setTimeout(() => {
          window.location.href = 'add-products.php';
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
  <title>Add New Products</title>
  <?php echo $redirectPage; ?>
</head>
<body>
  <form action="add-products.php" method="post" enctype="multipart/form-data">
    <h1>Add Products</h1>
    <input type="text" name="name" placeholder="Type name" autocomplete="off" required><br>
    <div class="select">
      <select name="category_id" id="category_id">
        <option>Select products type</option>
          <?php
            include('../connect.php');
            $sql = "SELECT id, name FROM products_categories";
            $result = $conn -> query($sql);

            while($row = mysqli_fetch_assoc($result)){
                ?>
                    <option value="<?php echo  $row['id']; ?>">
                        <?php echo $row['name']; ?>
                    </option>
                <?php
            }
          ?>
      </select>
    </div>
    <input type="text" name="price" placeholder="Type price" autocomplete="off" required><br>
    <input type="text" name="ingredients" placeholder="Type ingredients" autocomplete="off" required><br>
    <div class="img">
      <div class="img-upload">
        <input type="file" name="img" id="upload-img" required>
        <label for="upload-img">Upload Image</label>
      </div>
      <button type="submit">Add</button>
    </div>
    <?php
      if($added) echo '<div class="added">Product Imported</div>';
    ?>
  </form>
</body>
</html>