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
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
   body {
    font-family: Arial, sans-serif;
  }
  .container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
  }
  .logo {
    width: 100px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */
    margin-right: 20px; /* Add margin to create space between the logo and other elements */
    /* Add any additional styles here */
  }
  /* CSS for navbar text */
  .navbar-text {
    font-size: 18px;
    font-weight: bold;
    color: black; /* Set text color to black */
    padding: 10px 20px; /* Add padding for better appearance */
  }
  /* CSS for navbar background */

  .navbar-toggler {
    color: black !important; /* Set toggler color to black */
  }
  /* Resetting styles for navbar toggler icon */
  .navbar-toggler-icon {
    /* Remove any custom styles applied */
  }
  .navbar-nav .nav-link {
    color: black; /* Set text color to black */
  }
  .navbar-nav .nav-link.active {
    font-weight: bold; /* Make the font bold */
  }
  /* Custom CSS */
.card-title {
    font-size: 4.5rem; /* Adjust the font size as needed */
    color: yellow; /* Set the font color */
}

.card-text {
    font-size: 2.5rem; /* Adjust the font size as needed */
    color: black; /* Set the font color */
}
.text1{
  color:"white"
}
</style>
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="container mt-4 px-5">
<h1>ABOUT US</h1><br>
<p class="text-center">Y.O.U Beauty is an international beauty brand from HEBE Beauty Group. Upholding the brand philosophy of “Long-Lasting Beauty”, Y.O.U Beauty is committed to providing all women accessible beauty with innovative technology and fashionable design, inspiring them to keep exquisite attitude and blooming the everlasting beauty. With presence in Indonesia, Malaysia, Thailand, Philippines and other markets across the world, Y.O.U Beauty understands the needs of consumers from different markets and provides them across a product portfolio featuring makeup, skincare, body care and cosmetics accessories.</p>
</div>

<div class="container mt-4 px-5">
<br><br>
<h1>Brand Story</h1><br>
<div class="card mb-3" style="max-width: 1300px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./images/2.webp" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body"><br>
        <h5 class="card-title">Upholding the brand philosophy of</h5>
        <h3 class="card-text"><b>“LONG-LASTING BEAUTY”</b></h3><br><br>
        <p>Y.O.U Beauty is committed to providing all women accessible beauty with innovative technology and fashionable design, inspiring them to keep exquisite attitude and blooming the everlasting beauty. With presence in Indonesia, Malaysia, Thailand, Philippines and other markets across the world, Y.O.U Beauty understands the needs of consumers from different markets and provides them across a product portfolio featuring makeup, skincare, body care and cosmetics accessories.</p>
      </div>
    </div>
  </div>
</div><br>

<div class="card mb-3" style="max-width: 1300px;">
  <div class="row g-0">
    <div class="col-md-8"> <!-- Changed from col-md-4 -->
      <div class="card-body"><br>
        <h3 class="card-title"><b>BRAND STORY</b></h3><br>
        <p class="card-text">We created an exclusive R&D system [Open Lab], technology partners with world-leading raw material supplier, manufactures, testing and certification company, as infused throughout our products with creativity and innovation. We provide the perfect formulation for each product by sourcing data, analyzing information, and connecting with our consumers to satisfy all beauty needs.</p>
      </div>
    </div>
    <div class="col-md-4"> <!-- Changed from col-md-8 -->
      <img src="./images/4.webp" class="img-fluid rounded-start" alt="...">
    </div>
  </div>
</div><br>

<div class="card mb-3" style="max-width: 1300px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./images/5.webp" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title"><b>FASHION WITH SOUL</b></h3><br>
        <p class="card-text">Inspired by the latest fashion trend and beauty art, our products underscore a modern woman’s style and personality. We believe our products bring love and care towards all women and empower them to embrace their individual beauty and explore possibilities.</p>
      </div>
    </div>
  </div>
</div><br>

<div class="card mb-3" style="max-width: 1300px;">
  <div class="row g-0">
    <div class="col-md-8"> <!-- Changed from col-md-4 -->
      <div class="card-body"><br>
        <h3 class="card-title"><b>EXQUISITE INSIDE OUT</b></h3><br>
        <p class="card-text">Always stay chic and love yourself. We evoke desire for the truly modern women with a Multi-faced lifestyle and enhance a standard of grace and life quality through our fine beauty products.  We create the same glow from the inside as the one that emanates to the outside</p>
      </div>
    </div>
    <div class="col-md-4"> <!-- Changed from col-md-8 -->
      <img src="./images/6.webp" class="img-fluid rounded-start" alt="...">
    </div>
  </div>
</div><br>
</div>
<div class="container mt-4 px-5">
  <div class="card text-dark">
    <img src="./images/lab10.jpg" class="card-img" alt="...">
    <div class="card-img-overlay"><br><br><br><br><br><br><br><br>
      <h1 class="card-title text-center"><b>OPEN LAB</b></h1>
      <p class="text1 center"><b>Our exclusive R&D system [Open Lab], technology partners with world-leading suppliers, manufactures, quality certification organizations, as infused throughout our products with creativity and innovation. All of our products are formulated to revitalize your skin's self-repair ability, solve skin problems from origin, and create a real healthy skin look.</b></p>
    </div>
  </div>
  <div class="container mt-4 px-5">
  <div class="card mb-3" style="max-width: 1500px;">
    <div class="row g-0">
      <div class="col-md-4">
         <img src="./images/lab4.webp" class="img-fluid rounded-start" alt="Image">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h1 class="card-title"><b>FRONT-END</b></h1>
          <h3 class="title">Perfect Supply Chain System</h3>
          <p class="text">Suppliers cover the entire source supply of skin care, color cosmetics, beauty tools, maternal and child products, personal care, etc., to meet all market needs. The 100,000-grade clean workshop is strictly controlled. The daily production capacity of a single factory in the cosmetics category can reach up to 400,000 PCS; the daily production capacity of a single factory in the skin care category can reach up to 700,000 PCS.</p>
          <br>
          <h3 class="title">International Top Raw Material Suppliers</h3>
          <p class="text">We cooperate with the world’s top raw material suppliers to ensure product quality from the original source, long-term stability for our products, and provide the best raw materials.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container mt-4 px-5">
<div class="card mb-3" style="max-width: 1500px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./images/lab6.webp" class="img-fluid rounded-start" alt="Professional Makeup Trendy">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><b>PROCESS</b></h1>
        <h5 class="title"><b>Professional Makeup Trendy</b></h5>
        <p class="text">Deep cooperation with professional beauty agency Beauty Stream, combined with the latest international makeup trendy to provide suitable makeups for Southeast Asian women.</p>
        <br>
        <h5 class="text"><b>International Open Labs</b></h5>
        <p class="text">Hebe makes full use of its advantages , cooperate with labs in the field of raw material research and development of profound accumulation, to provide the world’s premium quality products.</p>
      </div>
    </div>
  </div>
</div>
<div class="card mb-3" style="max-width: 1500px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><b>All-Around Quality Control</b></h1>
        <h5 class="title"><b>Professional Makeup Trendy</b></h5>
        <p class="text">International Quality Control Organization：SGS，INTEREK</p>
        <p>Skin makeup effect testing institutions ：SKINPROOF</p>
        <p>FDA certification：Indonesia BPOM, Malaysia NPCB</p>
        <p>Halal certification： Indonesia Halal, Malaysia Halal</p>
      </div>
    </div>
    <div class="col-md-4">
      <img src="./images/lab9.webp" class="img-fluid rounded-start" alt="Professional Makeup Trendy">
    </div>
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
<script>
  $(document).ready(function(){
    // Add click event listener to About us link
    $(".nav-link[href='aboutus.php']").click(function(){
      // Remove active class from all nav links
      $(".nav-link").removeClass("active");
      // Add active class to clicked nav link
      $(this).addClass("active");
    });
  });
</script>
<?php include 'footer.php'; ?>
</body>
</html>