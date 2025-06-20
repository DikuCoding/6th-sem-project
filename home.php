<?php
include 'config.php';
// Only start session if it hasn't already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id && isset($_POST['add_to_cart'])) {
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product added to cart!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/recommend.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="home">
   <div class="content">
      <h3>Hand Picked Plant to Your Door.</h3>
      <p>Connecting People with the Beauty of Nature, One Plant at a Time</p>
      <a href="about.php" class="white-btn">Discover More</a>
   </div>
</section>

<section class="products">
   <h1 class="title">Latest Products</h1>
   <div class="box-container">
      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
         <input type="number" min="1" max="15" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <?php if($user_id): ?>
            <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
         <?php else: ?>
            <a href="login.php" class="btn">Login to Add</a>
         <?php endif; ?>
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">Load More</a>
   </div>
</section>

<h1 class="title">Recommended Products</h1>
<div class="row">
   <?php
      $sqlQuery = "SELECT name, image, price, SUM(quantity) AS total_quantity 
                   FROM cart 
                   GROUP BY name 
                   ORDER BY total_quantity DESC 
                   LIMIT 4";
      $results = mysqli_query($conn, $sqlQuery);
      if (mysqli_num_rows($results) > 0) {
         while ($data = mysqli_fetch_assoc($results)) {
   ?>
   <div class="card">
      <img src="uploaded_img/<?php echo $data['image']; ?>" height="100" width="100" alt="">
      <div class="name"><?php echo $data['name']; ?></div>
      <div class="price">Rs. <?php echo $data['price']; ?>/-</div>
   </div>
   <?php 
         }
      } 
   ?>
</div>

<section class="about">
   <div class="flex">
      <div class="image">
         <img src="https://img.freepik.com/free-vector/scene-with-kid-planting-trees-garden_1308-43277.jpg?w=740" alt="">
      </div>
      <div class="content">
         <h3>About Us</h3>
         <p>At EcoBloom, we believe in the power of greenery to enhance our lives, homes, and environment. What started as a humble collection of houseplants has blossomed into a thriving online marketplace.</p>
         <a href="about.php" class="btn">Read More</a>
      </div>
   </div>
</section>

<section class="home-contact">
   <div class="content">
      <h3>Have any questions?</h3>
      <p>Need help choosing or caring for your plant? Our team is here to help!</p>
      <a href="contact.php" class="white-btn">Contact Us</a>
   </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
