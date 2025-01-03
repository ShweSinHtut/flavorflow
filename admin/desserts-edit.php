<?php
  $product = null; 
  if(isset($_GET['id'])){
    include('../connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("SELECT * FROM add_desserts WHERE id = $id");
    $product = $sql -> fetch_assoc();
    if(!$product) echo 'Dessert not found!';
    $conn -> close();
  }
?>

<?php
  $updated = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $id = $conn -> real_escape_string($_POST['id']);
    $name = $conn -> real_escape_string($_POST['name']);
    $categoryId = $conn -> real_escape_string($_POST['category_id']);
    $price = $conn -> real_escape_string($_POST['price']);

    if(isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK){
      $image = $_FILES['img'];
      $imgName = $image['name'];
      $imgTmp = $image['tmp_name'];
      $imgSeparate = explode('.', $imgName);
      $imgExtension = strtolower(end($imgSeparate));

      $extension = array('jpg', 'jpeg', 'png');
      if(in_array($imgExtension, $extension)){
        $upload = '../images/'.$imgName;
        if(!move_uploaded_file($imgTmp, $upload)){
          echo 'Failed to upload image.';
        }
      } else{
        echo 'Invalid file type. Only JPG, JPEG, PNG are allowed.';
      }
    } else{
      $imgName = $conn -> real_escape_string($_POST['current_img']);
    }

    $stmt = $conn -> prepare("UPDATE add_desserts SET d_category_id = ?, name = ?, price = ?, image = ? WHERE id = ?");
    $stmt -> bind_param('isdsi', $categoryId, $name, $price, $imgName, $id);
    if($stmt -> execute()){
      $updated = true;
    } else{
      echo $stmt -> error;
    }
    $stmt -> close();

    header('location: desserts-list.php');
    
    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="stylesheet" href="./style/edit.css">
  <title>Dessert Edit</title>
</head>
<body>
  <div class="container">
    <?php if($product): ?>
      <form action="desserts-edit.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
          <input type="hidden" name="current_img" value="<?php echo $product['image']; ?>">
          <img src="../images/<?php echo $product['image']; ?>" width="100px"><br>
          <input type="text" name="name" value="<?php echo $product['name']; ?>"><br>
          <select name="category_id">
            <?php 
                include('../connect.php');
                $sql = "SELECT * FROM `desserts_categories`";
                $result = $conn -> query($sql);
                while($cat = $result -> fetch_assoc()){
                  ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $product['d_category_id'] ? 'selected' : ''; ?>>
                      <?php echo $cat['name']; ?>
                    </option>
                  <?php
                }
                $conn -> close();
            ?>
          </select><br>
          <input type="text" name="price" value="<?php echo $product['price']; ?>"><br>
          <input type="file" name="img" id="upload-img">
          <div class="btn">
            <label for="upload-img"><i class="fa-solid fa-upload"></i> Upload Image</label><br>
            <button type="submit">Update</button>
          </div>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>