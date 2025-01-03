<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/orders-lists.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <title>Orders Lists</title>
</head>
<body>
  <div class="container">
    <h1>Orders Lists</h1>
    <div class="lists">
      <div>
        <?php
            include('../connect.php');
            $sql = $conn -> query("SELECT * FROM `orders_lists`");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="order-container">
                  <div class="f-name-q">
                    <div class="f-name"><?php echo $row['food_name']; ?></div>
                    <div class="f-q"><?php echo $row['quantity']; ?></div>
                  </div>

                  <div class="user-details">
                    <div><?php echo $row['username']; ?></div>
                    <div><?php echo $row['email']; ?></div>
                    <div><i class="fa-solid fa-phone"></i> <?php echo $row['phone']; ?></div>
                  </div>
                </div>
              <?php
            }
          ?>
      </div>
    </div>
  </div>
</body>
</html>