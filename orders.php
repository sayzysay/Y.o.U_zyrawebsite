<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

// Check if the checkout was approved
if (isset($_SESSION['checkout_successful']) && $_SESSION['checkout_successful']) {
    // Loop through each item in the cart
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch the current product quantity from the database
        $fetch_quantity = mysqli_query($conn, "SELECT quantity FROM `products` WHERE id = $product_id") or die('Query failed');
        $quantity_data = mysqli_fetch_assoc($fetch_quantity);
        $current_quantity = $quantity_data['quantity'];
        
        // Calculate the new quantity after checkout
        $new_quantity = max(0, $current_quantity - $quantity);
        
        // Update the product quantity in the database
        mysqli_query($conn, "UPDATE products SET quantity = $new_quantity WHERE id = $product_id") or die('Query failed');
    }
    
    // Reset the checkout flag
    unset($_SESSION['checkout_successful']);
}

// Fetch orders query
$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user_id") or die('Query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>


<section class="placed-orders">
   <h1 class="title">Placed Orders</h1>
   <div class="box-container">
      <?php
      // Check if there are any orders
      if(mysqli_num_rows($order_query) > 0){
         // Loop through each order
         while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p>Placed On: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
         <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
         <p>Number: <span><?php echo $fetch_orders['number']; ?></span></p>
         <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
         <p>Method: <span><?php echo $fetch_orders['method']; ?></span></p>
         <p>Total Products: <span><?php echo $fetch_orders['total_products']; ?></span></p>
         <p>Total Price: <span>₱<?php echo $fetch_orders['total_price']; ?>/-</span></p>
         <p>Payment Status: <span style="color:<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'red' : 'green'; ?>"><?php echo $fetch_orders['payment_status']; ?></span></p>
      </div>
      <?php
         }
      }else{
         // Display message if no orders are found
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>
