<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};
   
if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];   
    // Fetch the available quantity of the product from the database
    $fetch_cart = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `cart` WHERE id = '$cart_id'"));
    $product_id = $fetch_cart['product_id'];
    $product_query = mysqli_query($conn, "SELECT quantity FROM `products` WHERE id = '$product_id'");
    $product_data = mysqli_fetch_assoc($product_query);
    $available_quantity = $product_data['quantity'];
    // Check if the updated quantity exceeds the available quantity
    if($cart_quantity <= $available_quantity) {
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
        
        // Update grand total if the updated quantity is correct
        $sub_total = $product_data['price'] * $cart_quantity;
        $grand_total += $sub_total;

        header('location:cart.php');
    } else {
        // If updated quantity exceeds available quantity, show an alert message
        echo "<script>alert('Quantity exceeds available quantity!');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>
   <!--Sweet Alert -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
   <!--Sweet Alert JS-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
   <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
                $product_id = $fetch_cart['product_id'];
                $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'");
                $product_data = mysqli_fetch_assoc($product_query);
                $sub_total = $product_data['price'] * $fetch_cart['quantity'];
                // Check if the product quantity exceeds the limit
                $max_quantity = 35; // Adjust this according to your requirement
                if ($fetch_cart['quantity'] <= $max_quantity) {
                    $grand_total += $sub_total;
                }
      ?>
      <div class="box">
         <form action="cart.php" method="GET">
            <input type="hidden" name="delete" value="<?php echo $fetch_cart['id']; ?>">
            <button type="submit" class="fas fa-times delete-button" onclick="return confirm('Delete this from cart?');"></button>
         </form>
         <img src="uploaded_img/<?php echo $product_data['image']; ?>" alt="">
         <div class="name"><?php echo $product_data['name']; ?></div>
         <div class="price">₱<?php echo $product_data['price']; ?></div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" max="<?php echo $product_data['quantity']; ?>" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <button type="submit" name="update_cart" value="update" class="option-btn">Update</button>
         </form>
         <div class="sub-total"> sub total : <span>₱<?php echo $sub_total; ?></span> </div>
      </div>
      <?php
            } // Closing curly brace for the while loop
         }else{
            echo '<p class="empty">your cart is empty</p>';
         }
      ?>
</div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>₱<?php echo $grand_total; ?></span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">continue shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>">proceed to checkout</a>
         <style>
            .btn {
                background-color: green;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
            }
            .option-btn {
                background-color: lightblue;
                color: black; /* Optionally adjust text color */
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
            }
         </style>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
