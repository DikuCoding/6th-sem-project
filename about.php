<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<!-- <div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div> -->

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="https://img.freepik.com/free-vector/cartoon-people-taking-photos-with-smartphone_52683-66593.jpg?w=996&t=st=1697128515~exp=1697129115~hmac=a75408c795eb63f8aa5139cb679259324856b0853502a7278ccfbe109f3795a9" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At EasyBloom, we believe in the power of greenery to enhance our lives, homes, and environment. when a group of passionate plant lovers came together to share their love for all things green. What started as a humble collection of houseplants in our living rooms soon blossomed into a thriving online marketplace.</p>
         <p>Our mission is simple yet profound: to bring the joy of gardening and the magic of nature to your doorstep. We aim to make the experience of buying and caring for plants as delightful and rewarding as possible. Whether you're a seasoned gardener or just starting your plant journey, EasyBloom is here to guide you every step of the way.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>











<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>