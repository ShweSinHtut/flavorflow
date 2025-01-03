<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="stylesheet" href="./user-styles/main.css">
  <link rel="icon" href="./images/restaurant-logo.jpg">
  <title>Restaurant</title>
</head>
<body>
  <div class="container">
    <div class="options">
      <div>
        <div class="active top-btn nav-btn"><i class="fa-solid fa-house"></i> <p>Home</p></div>
        <div class="nav-btn"><i class="fa-solid fa-bowl-food"></i> <p>Food</p></div>
        <div class="nav-btn"><i class="fa-solid fa-ice-cream"></i> <p>Desserts</p></div>
        <div class="nav-btn"><i class="fa-solid fa-tablet-button"></i> <p>Tables Reservation</p></div>
      </div>

      <div>
        <div class="nav-btn"><i class="fa-solid fa-reply"></i> <p>Feedback</p></div>
      </div>
    </div>

    <div class="line"></div>
 
    <div class="of-option">
      <div class="home">
        <div class="opt-buttons">
          <div class="buttons">
            <div class="opt-btn-active">Food & Drinks</div>
            <div>Desserts</div>
          </div>
        </div>
        <div class="food-drink">
          <?php
            include('./connect.php');
            $sql = $conn -> query("SELECT * FROM `add_products`");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="products-grid">
                  <div>
                    <img src="./images/<?php echo $row['image']; ?>">
                    <div class="overlay">
                      <div>
                        <a href="products-details.php?id=<?php echo $row['id']; ?>">Details</a>
                      </div>
                    </div>
                  </div>
                  <div class="name"><?php echo $row['name']; ?></div>
                </div>
              <?php
            }
            $conn -> close();
          ?>
        </div>

        <div class="desserts">
          <?php
              include('./connect.php');
              $sql = $conn -> query("SELECT * FROM `add_desserts`");
              while($row = $sql -> fetch_assoc()){
                ?>
                  <div class="products-grid">
                    <div>
                      <img src="./images/<?php echo $row['image']; ?>">
                      <div class="overlay">
                        <div>
                          <a href="desserts-details.php?id=<?php echo $row['id']; ?>">Details</a>
                        </div>
                      </div>
                    </div>
                    <div class="name"><?php echo $row['name']; ?></div>
                  </div>
                <?php
              }
              $conn -> close();
              ?>
          </div>
        </div>
  
        <div class="food">
          <div class="opt-buttons">
            <div class="food-buttons">
              <div class="opt-btn-active">Korean Food</div>
              <div class="food-thai">Thai Food</div>
              <div>Myanmar Food</div>
            </div>
          </div>
  
          <div class="food-drink" id="thai-food">
            <?php
              include('./connect.php');
              $sql = $conn -> query("SELECT * FROM add_products WHERE p_category_id = 3");
              while($row = $sql -> fetch_assoc()){
                ?>
                  <div class="products-grid">
                    <div>
                      <img src="./images/<?php echo $row['image']; ?>">
                      <div class="overlay">
                        <div>
                          <a href="products-details.php?id=<?php echo $row['id']; ?>">Details</a>
                        </div>
                      </div>
                    </div>
                    <div class="name"><?php echo $row['name']; ?></div>
                  </div>
                <?php
              }
              $conn -> close();
            ?>
          </div>
          <div class="food-drink" id="myanmar-food">
          <?php
            include('./connect.php');
            $sql = $conn -> query("SELECT * FROM add_products WHERE p_category_id = 1");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="products-grid">
                  <div>
                    <img src="./images/<?php echo $row['image']; ?>">
                    <div class="overlay">
                      <div>
                        <a href="products-details.php?id=<?php echo $row['id']; ?>">Details</a>
                      </div>
                    </div>
                  </div>
                  <div class="name"><?php echo $row['name']; ?></div>
                </div>
              <?php
            }
            $conn -> close();
          ?>
        </div>

        <div class="food-drink" id="korean-food">
          <?php
            include('./connect.php');
            $sql = $conn -> query("SELECT * FROM add_products WHERE p_category_id = 2");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="products-grid">
                  <div>
                    <img src="./images/<?php echo $row['image']; ?>">
                    <div class="overlay">
                      <div>
                        <a href="products-details.php?id=<?php echo $row['id']; ?>">Details</a>
                      </div>
                    </div>
                  </div>
                  <div class="name"><?php echo $row['name']; ?></div>
                </div>
              <?php
            }
            $conn -> close();
            ?>
          </div>
        </div>
  
        <div class="desserts-nav">
          <div class="opt-buttons">
            <div class="desserts-buttons">
              <div class="opt-btn-active">Cake</div>
              <div class="food-thai">Ice Cream</div>
              <div class="dessert-pizza">Pizza</div>
              <div>Coffee</div>
            </div>
          </div>
  
          <div class="food-drink" id="dessert-cake">
            <?php
              include('./connect.php');
              $sql = $conn -> query("SELECT * FROM add_desserts WHERE d_category_id = 1");
              while($row = $sql -> fetch_assoc()){
                ?>
                  <div class="products-grid">
                    <div>
                      <img src="./images/<?php echo $row['image']; ?>">
                      <div class="overlay">
                        <div>
                          <a href="desserts-details.php?id=<?php echo $row['id']; ?>">Details</a>
                        </div>
                      </div>
                    </div>
                    <div class="name"><?php echo $row['name']; ?></div>
                  </div>
                <?php
              }
              $conn -> close();
            ?>
          </div>
  
          <div class="food-drink" id="dessert-ic">
          <?php
            include('./connect.php');
            $sql = $conn -> query("SELECT * FROM add_desserts WHERE d_category_id = 2");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="products-grid">
                  <div>
                    <img src="./images/<?php echo $row['image']; ?>">
                    <div class="overlay">
                      <div>
                        <a href="desserts-details.php?id=<?php echo $row['id']; ?>">Details</a>
                      </div>
                    </div>
                  </div>
                  <div class="name"><?php echo $row['name']; ?></div>
                </div>
              <?php
            }
            $conn -> close();
          ?>
        </div>
        <div class="food-drink" id="dessert-pizza">
          <?php
            include('./connect.php');
            $sql = $conn -> query("SELECT * FROM add_desserts WHERE d_category_id = 3");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="products-grid">
                  <div>
                    <img src="./images/<?php echo $row['image']; ?>">
                    <div class="overlay">
                      <div>
                        <a href="desserts-details.php?id=<?php echo $row['id']; ?>">Details</a>
                      </div>
                    </div>
                  </div>
                  <div class="name"><?php echo $row['name']; ?></div>
                </div>
              <?php
            }
            $conn -> close();
          ?>
        </div>

        <div class="food-drink" id="dessert-coffee">
          <?php
            include('./connect.php');
            $sql = $conn -> query("SELECT * FROM add_desserts WHERE d_category_id = 4");
            while($row = $sql -> fetch_assoc()){
              ?>
                <div class="products-grid">
                  <div>
                    <img src="./images/<?php echo $row['image']; ?>">
                    <div class="overlay">
                      <div>
                        <a href="desserts-details.php?id=<?php echo $row['id']; ?>">Details</a>
                        </div>
                    </div>
                  </div>
                  <div class="name"><?php echo $row['name']; ?></div>
                </div>
              <?php
            }
            $conn -> close();
          ?>
        </div>
      </div>

      <div class="tables-reservation">
        <div class="opt-buttons">
          <div class="tables-buttons">
            <div class="opt-btn-active">Ordinary</div>
            <div>Family</div>
          </div>
        </div>

        <div class="t-container ordinary">
          <div class="price-seat">
            <?php
              include('./connect.php');
              $sql = $conn -> query("SELECT * FROM tables_categories WHERE id = 1");
              $o_table = $sql -> fetch_assoc();
            ?>
            <div>Price: <?php echo $o_table['price']; ?> MMK</div>
            <div>Seats: <?php echo $o_table['seats']; ?></div>
          </div>

          <div class="t-grid">
            <?php
                include('./connect.php');
                $sql = $conn -> query("SELECT * FROM add_tables WHERE t_category_id = 1");
                while($row = $sql -> fetch_assoc()){
                  ?>
                    <?php if($row['status'] == 'active') : ?>
                      <div class="table">
                        <div class="t-id"><?php echo $row['t_id']; ?></div>
                        <a href="tables-form.php?id=<?php echo $row['id']; ?>" class="t-reserve">Reserve</a>
                    </div>
                    <?php elseif($row['status'] == 'occupied') : ?>
                      <div class="table occupied">
                        <div class="t-id"><?php echo $row['t_id']; ?></div>
                        <a href="tables-form.php?id=<?php echo $row['id']; ?>" class="t-reserve">Occupied</a>
                    </div>
                    <?php endif; ?>
                  <?php
                } 
              ?>
          </div>
        </div>

        <div class="t-container family">
          <div class="price-seat">
            <?php
              include('./connect.php');
              $sql = $conn -> query("SELECT * FROM tables_categories WHERE id = 2");
              $f_table = $sql -> fetch_assoc();
            ?>
            <div>Price: <?php echo $f_table['price']; ?> MMK</div>
            <div>Seats: <?php echo $f_table['seats']; ?></div>
          </div>
          <div class="t-grid">
            <?php
              include('./connect.php');
              $sql = $conn -> query("SELECT * FROM add_tables WHERE t_category_id = 2");
              while($row = $sql -> fetch_assoc()){
                ?>
                  <?php if($row['status'] == 'active') : ?>
                    <div class="table">
                      <div class="t-id"><?php echo $row['t_id']; ?></div>
                      <a href="tables-form.php?id=<?php echo $row['id']; ?>" class="t-reserve">Reserve</a>
                   </div>
                  <?php elseif($row['status'] == 'occupied') : ?>
                    <div class="table occupied">
                      <div class="t-id"><?php echo $row['t_id']; ?></div>
                      <a href="tables-form.php?id=<?php echo $row['id']; ?>" class="t-reserve">Occupied</a>
                    </div>
                  <?php endif; ?>
                <?php
              } 
            ?>
          </div>
        </div>
      </div>

      <div class="feedback">
        <div class="f-container">
          <div class="input">
            <input type="text" placeholder="We value your feedback...">
            <button>Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./user-scripts/main.js"></script>

<script>
  const urlParam = new URLSearchParams(window.location.search);
  if(urlParam.get('order') === 'submitted'){
    alert('Your order has been submitted.');
    reloadUrl();
  }

  if(urlParam.get('reserve') === 'submitted'){
    alert('Table reservation has been submitted.');
    reloadUrl();
  }

  function reloadUrl(){
    const newUrl = window.location.origin + window.location.pathname;
    window.history.replaceState({}, document.title, newUrl);
  }
</script>
</body>
</html>  