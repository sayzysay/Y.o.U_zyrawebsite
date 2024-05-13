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
   <title>home</title>

   

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
   <body>
<?php include 'header.php'; ?>


<!-- Carousel -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/c6.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/c5.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/c4.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/c3.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/c2.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/c1.webp" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleAutoplaying" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleAutoplaying" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div><br><br>

<div class="d-flex justify-content-around">
  <div class="card mb-3" style="width: 18rem;">
    <img src="./images/bc1.webp" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><b>MAKEUP COLLECTION</b></h5>
      <p class="card-text">Get ready for all-day excellence with advanced skin-loving formula in our widest shade range ever. Power up your healthy look!</p>
      <p class="text-center"><a href="shop.php">Shop Now</a></p>
    </div>
  </div>
  <div class="card mb-3" style="width: 18rem;">
    <img src="./images/bc2.webp" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><b>SKINCARE COLLECTION</b></h5>
      <p class="card-text">Backed by beauty technology and innovation, perfect skincare solution for different types of skin. Beautiful skin starts from here.</p>
      <p class="text-center"><a href="shop.php">Shop Now</a></p>
    </div>
  </div>
  <div class="card mb-3" style="width: 18rem;">
    <img src="./images/bc3.webp" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><b>BEAUTY TOOLS</b></h5>
      <p class="card-text">Fix your beauty with ultimate pro brushes and accessories. Ready to buff to perfection.</p><br>
      <p class="text-center"><a href="shop.php">Shop Now</a></p>
    </div>
  </div>
</div>



<!-- Page Content -->
<div class="container mt-4">
  <!-- Main content goes here -->
</div>



<!-- Bootstrap JS and jQuery (optional, if needed) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript code -->
<script>
  $(document).ready(function(){
    // Activate the carousel
    $('#carouselExampleAutoplaying').carousel();

    // Enable carousel autoplay
    $('#carouselExampleAutoplaying').carousel({
      interval: 2000 // Change the interval as needed (in milliseconds)
    });
  });
</script>
<?php include 'footer.php'; ?>
</body>
</html>