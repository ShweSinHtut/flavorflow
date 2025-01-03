<?php
  if(isset($_GET['id'])){
    include('../connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("SELECT * FROM desserts_categories WHERE id = $id");
    $p_cat = $sql -> fetch_assoc();
    if(!$p_cat) echo 'Dessert not found.';
    $conn -> close();
  }
?>

<?php
  $updated = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $id = $conn -> real_escape_string($_POST['id']);
    $name = $conn -> real_escape_string($_POST['name']);

    $stmt = $conn -> prepare("UPDATE desserts_categories SET name = ? WHERE id = ?");
    $stmt -> bind_param('si', $name, $id);
    if($stmt -> execute()){
      $updated = true;
    } else{
      echo $stmt -> error;
    }
    $stmt -> close();

    header('location: d-category-list.php');

    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/category-edit.css">
  <title>Desserts Categories Edit</title>
</head>
<body>
  <div class="container">
    <form action="d-category-edit.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $p_cat['id']; ?>">
      <input type="text" name="name" value="<?php echo $p_cat['name']; ?>" autocomplete="off" class="text">
      <button type="submit">Update</button>
    </form>
  </div>
</body>
</html>