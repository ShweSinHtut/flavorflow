<?php // from the products-list.php
$product = null; // အောက်က $cat['id] && $product['p_category_id'] နဲ့လာညိနေလို့ လုပ်ထားခဲ့တာ
  include('../connect.php');
  if(isset($_GET['id'])){ // တစ်ဖက်က get နဲ့ယူလာမှာတွေကို isset() စစ်ရန်
    $id = $_GET['id'];
    $sql = $conn -> query("SELECT * FROM `add_products` WHERE id = $id");
    $product = $sql -> fetch_assoc();  // product value ပြောင်းသွား
    if(!$product) echo 'Product not found.';
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
    $ingredients = $conn -> real_escape_string($_POST['ingredients']);

    if(isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK){
      $image = $_FILES['img'];
      $imgName = $image['name'];
      $imgTmp = $image['tmp_name'];
      $imgSeparate = explode('.', $imgName);
      $imgExtension = strtolower(end($imgSeparate));

      $extension = array('jpeg', 'jpg', 'png');
      if(in_array($imgExtension, $extension)){
        $upload = '../images/'.$imgName;
        if(!move_uploaded_file($imgTmp, $upload)){
          echo 'Failed to upload image.';
        }
      }else {
        echo 'Invalid file type. Only JPEG, JPG, PNG are allowed.';
      }
    } else{
      $imgName = $conn -> real_escape_string($_POST['current_img']);
    }
    // prepare > bind > execute
    $stmt = $conn -> prepare("UPDATE `add_products` SET p_category_id = ?, name = ?, price = ?, ingredients = ?, image = ? WHERE id = ?");
    $stmt -> bind_param('isdssi', $categoryId, $name, $price, $ingredients, $imgName, $id);
    if($stmt -> execute()){
      $updated = true;
    }else {
      echo $stmt -> error;
    }
    $stmt -> close();

    header("location: products-list.php");
    
    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products Edit</title>
</head>
<body>
  <div class="container">
    <?php if(isset($product)): ?> <!-- php ထဲမှာ html form ကိုထည့်လိုက်တာ၊ ဒီထည့်ထားမှ ဒါလုပ်မယ်ဆိုတဲ့ပုံစံမျိုး -->
      <form action="products-edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>"><br>
        <input type="hidden" name="current_img" value="<?php echo $product['image']; ?>"><br> <!-- ပုံမပြောင်းတဲ့ကိစ္စအတွက် -->
        <input type="text" name="name" value="<?php echo $product['name']; ?>"><br>
        <select name="category_id">
          <?php 
            include('../connect.php');
            $sql = "SELECT * FROM `products_categories`";
            $result = $conn -> query($sql);
            while($cat = $result -> fetch_assoc()){
              ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $product['p_category_id'] ? 'selected': ''; ?>>
                  <?php echo $cat['name']; ?>
                </option>
              <?php
            }
            $conn -> close();
          ?>
        </select>
        <input type="text" name="price" value="<?php echo $product['price']?>"><br>
        <input type="text" name="ingredients" value="<?php echo $product['ingredients']?>"><br>
        <img src="../images/<?php echo $product['image']; ?>" width="100px"><br>
        <input type="file" name="img">
        <button type="submit">Update</button>
      </form>
    <?php endif; ?>
  </div>

  <!-- edit, update တို့က အရေးကြီးတာမလို့ (data ကိုလာထိတာမလို့) if() တွေနဲ့စစ်တာကောင်းှ -->
</body>
</html>