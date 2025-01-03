<?php
  if(isset($_GET['id'])){
    include('../connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("SELECT * FROM tables_categories WHERE id = $id");
    $t_cat = $sql -> fetch_assoc();
    if(!$t_cat) echo 'Table not found!';
    $conn -> close();
  }
?>

<?php
  $updated = false;
  if($_SERVER['REQUEST_METHOD']  == 'POST'){
    include('../connect.php');
    $id = $conn -> real_escape_string($_POST['id']);
    $name = $conn -> real_escape_string($_POST['name']);
    $seats = $conn -> real_escape_string($_POST['seats']);
    $price = $conn -> real_escape_string($_POST['price']);

    $stmt = $conn -> prepare("UPDATE tables_categories SET name = ?, seats = ?, price = ? WHERE id = ?");
    $stmt -> bind_param('sidi', $name, $seats, $price, $id);

    if($stmt -> execute()){
      $updated = true;
    } else{
      $stmt -> error;
    }
    $stmt -> close();

    header('location: t-category-list.php');

    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/t-edit.css">
  <title>Tables Categories Edit</title>
</head>
<body>
  <form action="t-category-edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $t_cat['id']; ?>">
    <input type="text" name="name" value="<?php echo $t_cat['name']; ?>"><br>
    <input type="text" name="seats" value="<?php echo $t_cat['seats']; ?>"><br>
    <input type="text" name="price" value="<?php echo $t_cat['price']; ?>"><br>
    <button type="submit">Update</button>
  </form>
</body>
</html>