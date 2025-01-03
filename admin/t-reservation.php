<?php
  $found = false;
  $failed = false;
  if(isset($_GET['id'])){
    include('../connect.php');
    $id = $conn -> real_escape_string($_GET['id']);

    $stmt = $conn -> prepare("SELECT t_id FROM add_tables WHERE id = ?");
    $stmt -> bind_param('i', $id);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if($result){
      $row = $result -> fetch_assoc();
      $t_id = $row['t_id'];

      $sql = $conn -> prepare("SELECT * FROM tables_lists WHERE t_id = ?");
      $sql -> bind_param('s', $t_id);
      $sql -> execute();
      $resultTable = $sql -> get_result();

      if($resultTable && $resultTable -> num_rows > 0){
        $table = $resultTable -> fetch_assoc();
        $found = true;
      } else{
        $failed = true;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="stylesheet" href="./style/t-reservation.css">
  <?php if($found): ?>
    <title><?php echo $table['t_id']; ?></title>
  <?php elseif($failed): ?>
    <title>No reservation...</title>
  <?php endif; ?>
</head>
<body>
  <?php if($found): ?>
    <div>
      <div class="nav">
        <h2><?php echo $table['t_id']; ?></h2>
      </div>

      <div class="cus-details">
        <div>
          <div class="username">🔖 &nbsp;&nbsp; <?php echo $table['username']; ?> has reserved this table &nbsp;&nbsp; 🔖</div>
          <div class="contact">
            <div><i class="fa-solid fa-envelope"></i> <?php echo $table['email']; ?></div>
            <div><i class="fa-solid fa-phone"></i> <?php echo $table['phone']; ?></div>
          </div>
        </div>
      </div>
    </div>
  <?php elseif($failed): ?>
    <div class="container">
      <h1>No reservation for this table...</h1>
    </div>
  <?php endif; ?>
</body>
</html>