<?php
  $table = null;
  if(isset($_GET['id'])){
    include('./connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("SELECT * FROM add_tables WHERE id = $id");
    $table = $sql -> fetch_assoc();
    $conn -> close();
  }
?>

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('./connect.php');
    $t_id = $conn -> real_escape_string($_POST['t-id']);
    $username = $conn -> real_escape_string($_POST['name']);
    $phone = $conn -> real_escape_string($_POST['phone']);
    $email = $conn -> real_escape_string($_POST['email']);

    $stmt = $conn -> prepare("INSERT INTO tables_lists (username, phone, email, t_id) VALUES (?, ?, ?, ?)");
    $stmt -> bind_param('ssss', $username, $phone, $email, $t_id);
    if($stmt -> execute()){
      $update = $conn -> prepare("UPDATE add_tables SET status = 'occupied' WHERE t_id = ?");
      $update -> bind_param('s', $t_id);
      $update -> execute();
      header('location: ./index.php?reserve=submitted');
      exit();
      $stmt -> close();
    }
    $conn -> close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if($table): ?>
  <title>Reservation - <?php echo $table['t_id']; ?></title>
  <link rel="icon" href="./images/restaurant-logo.jpg">
  <link rel="stylesheet" href="./user-styles/t-booking.css">
</head>
<body>
  <div class="container">
    <form action="tables-form.php" method="post" enctype="multipart/form-data">
      <h2><?php echo $table['t_id']; ?></h2>
      <input type="hidden" name="t-id" value="<?php echo $table['t_id']; ?>">
      <input type="text" name="name" placeholder="Type your name" autocomplete="off" required><br>
      <input type="tel" name="phone" placeholder="Type your number" autocomplete="off" required><br>
      <input type="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Type your email" autocomplete="off" required><br>
      <div class="order-opt-btn">
        <a href="./index.php" class="back">Back</a>
        <button type="submit" class="order">Submit</button>
      </div>
    </form>
  </div>
  <?php endif; ?>
</body>
</html>