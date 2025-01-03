<?php
  $dessert = null;
  if(isset($_GET['id'])){
    include('./connect.php');
    $id = $conn -> real_escape_string($_GET['id']);
    $sql = $conn -> query("SELECT * FROM add_desserts WHERE id = $id");
    $dessert = $sql -> fetch_assoc();
    $conn -> close();
  }
?>

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('./connect.php');
    $f_name = $conn -> real_escape_string($_POST['food-name']);
    $name = $conn -> real_escape_string($_POST['name']);
    $phone = $conn -> real_escape_string($_POST['phone']);
    $email = $conn -> real_escape_string($_POST['email']);
    $quantity = $conn -> real_escape_string($_POST['quantity']);

    $sql = $conn -> query("INSERT INTO orders_lists (food_name, username, phone, email, quantity) VALUES ('$f_name', '$name', '$phone', '$email', '$quantity')");

    if($sql){
      header('location: index.php?order=submitted');
      exit();
    }
    echo $conn -> error;

    $conn -> close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="stylesheet" href="./user-styles/details.css">
  <link rel="icon" href="./images/restaurant-logo.jpg">
  <?php if($dessert): ?>
  <title><?php echo $dessert['name']; ?></title>
</head>
<body>
  <div class="container">
    <div class="home-btn">
      <a href="./index.php"><i class="fa-solid fa-house"></i> Home</a>
    </div>

    <div class="render">
      <h1><?php echo $dessert['name']; ?></h1>

      <div class="img">
        <img src="./images/<?php echo $dessert['image']; ?>">
      </div>

      <div class="details">
        <div>
          <div><?php echo $dessert['price']; ?> MMK</div>
          <div class="line"></div>
          <div class="ingredients"><?php echo $dessert['name']; ?></div>
          <div class="line"></div>
          <button class="order-btn">Order</button>
        </div>
      </div>
    </div>
    <dialog class="modal">
      <form action="desserts-details.php" method="post" enctype="multipart/form-data">
        <h2><?php echo $dessert['name']; ?></h2>
        <input type="hidden" name="food-name" value="<?php echo $dessert['name']; ?>">
        <input type="text" name="name" placeholder="Type your name" autocomplete="off" required><br>
        <input type="tel" name="phone" placeholder="Type your number" autocomplete="off" required><br>
        <input type="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Type your email" autocomplete="off" required><br>
        <input type="number" name="quantity"  value="1">
        <div class="order-opt-btn">
          <div class="back">Back</div>
          <button type="submit" class="order">Submit</button>
        </div>
      </form>
    </dialog>
  </div>
  <?php endif; ?>

  <script src="./user-scripts/details.js"></script>
</body>
</html>