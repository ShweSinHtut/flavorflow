<?php
  if(isset($_GET['id'])){
    include('../connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("SELECT * FROM add_tables WHERE id = $id");
    $row = $sql -> fetch_assoc();
    if(!$row) echo 'Table not found!';
    $conn -> close();
  }
?>

<?php
  $updated = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $id = $conn -> real_escape_string($_POST['id']);
    $t_id = $conn -> real_escape_string($_POST['t-id']);
    $categoryId = $conn -> real_escape_string($_POST['category_id']);

    $stmt = $conn -> prepare("UPDATE add_tables SET t_id = ?, t_category_id = ? WHERE id = ?");
    $stmt -> bind_param('sii', $t_id, $categoryId, $id);

    if($stmt -> execute()){
      $updated = true;
    } else{
      $stmt -> error;
    }
    $stmt -> close();

    header('location: tables-list.php');

    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/t-edit.css">
  <title>Tables Edit</title>
</head>
<body>
  <form action="tables-edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="text" name="t-id" value="<?php echo $row['t_id']; ?>"><br>
    <select name="category_id">
      <?php
        include('../connect.php');
        $sql = $conn -> query("SELECT * FROM `tables_categories`");
        while($cat = $sql -> fetch_assoc()){
          ?>
            <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $row['t_category_id'] ? 'selected': ''; ?>>
              <?php echo $cat['name']; ?>
            </option>
          <?php
        }
        $conn -> close();
      ?>
    </select><br>
    <button type="submit">Update</button>
  </form>
</body>
</html>