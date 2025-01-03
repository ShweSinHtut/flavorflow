<?php
  $added = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../connect.php');
    $t_id = $conn -> real_escape_string($_POST['t_id']);
    $categoryId = $conn -> real_escape_string($_POST['category_id']);
    $sql = "INSERT INTO `add_tables` (`t_id`, `t_category_id`) VALUES ('$t_id', '$categoryId')";
    $result = $conn -> query($sql);

    if($result){
      $added = true;
    }else{
      die(mysqli_error($conn));
    }
  }

  $redirectPage = "";
  if($added){
    $redirectPage = "
      <script>
        setTimeout(() => {
          window.location.href = 'add-tables.php';
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
  <title>Add New Tables</title>
  <?php echo $redirectPage; ?>
</head>
<body>
  <form action="add-tables.php" method="post" enctype="multipart/form-data">
    <h1>Add Tables</h1>
    <input type="text" name="t_id" placeholder="Type table id" autocomplete="off" required><br>
    <div class="select">
      <select name="category_id" id="category_id">
      <option>Select tables category type</option>
        <?php
            include('../connect.php');
            $sql = "SELECT id, name FROM tables_categories";
            $result = $conn -> query($sql);

            while($row = mysqli_fetch_assoc($result)){
                ?>
                  <option value="<?php echo  $row['id']; ?>">
                      <?php echo $row['name']; ?>
                  </option>
                <?php
            }
            $conn -> close();
        ?>
      </select>
    </div>
    <button type="submit" class="t-add-btn">Add</button>
    <?php
      if($added) echo '<div class="added">Table Imported</div>';
    ?>
  </form>
</body>
</html>