<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = array();

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select_cart) > 0){
      while($cart_item = mysqli_fetch_assoc($select_cart)){
         $product_id = $cart_item['product_id'];
         $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'");
         $product_data = mysqli_fetch_assoc($product_query);
         $cart_products[] = $product_data['name'].' ('.$cart_item['quantity'].')';
         $sub_total = ($product_data['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;

         // Decrease the product quantity in the database
         $new_quantity = $product_data['quantity'] - $cart_item['quantity'];
         mysqli_query($conn, "UPDATE `products` SET `quantity` = $new_quantity WHERE `id` = $product_id") or die('query failed');
      }
   }

   $total_products = implode(', ', $cart_products);

   // Insert the order into the database
   mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');

   // Clear the cart after successful checkout
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

   // Display success message
   $message = "<script>
            window.onload = function() {
               Swal.fire({
                  title: 'Success!',
                  text: 'Order placed successfully!',
                  icon: 'success',
                  confirmButtonText: 'OK'
               });
            };
         </script>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style.css">
   <!--Sweet Alert CSS-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-order">

<?php  
$grand_total = 0;
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
if(mysqli_num_rows($select_cart) > 0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
        $product_id = $fetch_cart['product_id'];
        $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'");
        $product_data = mysqli_fetch_assoc($product_query);
        $sub_total = $product_data['price'] * $fetch_cart['quantity'];
        $grand_total += $sub_total;
?>
<p><?php echo $product_data['name']; ?> <span>(<?php echo '₱'.$product_data['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span></p>
<?php
    }
}else{
    echo '<p class="empty">your cart is empty</p>';
}
?>

   <div class="grand-total"> grand total : <span>₱<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. Manila">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. Place ">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. Philippines">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn" style="background-color: green;">

   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
 <!-- SweetAlert JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <?php
      if(isset($message)){
         echo $message;
      }
   ?>

</body>
</html>
