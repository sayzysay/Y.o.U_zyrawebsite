<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

// Redirect if user is not logged in
if (!$user_id) {
   header('location:login.php');
   exit();
}

// Check if checkout is successful and update product quantities
if (isset($_SESSION['checkout_successful']) && $_SESSION['checkout_successful']) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Update product quantity in the database if it's greater than zero
        $fetch_quantity = mysqli_query($conn, "SELECT quantity FROM `products` WHERE id = $product_id") or die('Query failed');
        $quantity_data = mysqli_fetch_assoc($fetch_quantity);
        $current_quantity = $quantity_data['quantity'];
        
        if ($current_quantity > 0) {
            $new_quantity = $current_quantity - $quantity;
            $new_quantity = max(0, $new_quantity); // Ensure quantity doesn't go negative
            
            // Update product quantity
            mysqli_query($conn, "UPDATE products SET quantity = $new_quantity WHERE id = $product_id") or die('Query failed');
            
            // If quantity becomes zero, mark the product as sold out
            if ($new_quantity <= 0) {
                mysqli_query($conn, "UPDATE products SET status = 'soldout' WHERE id = $product_id") or die('Query failed');
            }
            
            // Insert order details into the orders table
            $order_date = date('Y-m-d H:i:s');
            mysqli_query($conn, "INSERT INTO orders (user_id, product_id, quantity, order_date) VALUES ($user_id, $product_id, $quantity, '$order_date')") or die('Query failed');
        }
    }
    // Update sold-out status for all products
    mysqli_query($conn, "UPDATE products SET status = 'soldout' WHERE quantity <= 0") or die('Query failed');
    
    unset($_SESSION['checkout_successful']); // Reset checkout flag
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="products">
   <h1 class="title">Our Products</h1>
   <div class="box-container">
   <?php  
$select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed');
if(mysqli_num_rows($select_products) > 0){
    while($fetch_products = mysqli_fetch_assoc($select_products)){
        // Fetch product quantity from database
        $product_id = $fetch_products['id'];
        $quantity = $fetch_products['quantity']; // Directly fetch quantity from the product row
        
        // Check if product is already in cart
        $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = $product_id AND user_id = $user_id") or die('Query failed');
        $is_in_cart = mysqli_num_rows($check_cart) > 0;

        // Check if quantity is zero to mark the product as "sold out"
        $sold_out_class = ($quantity <= 0) ? 'sold-out' : '';

?>
<div class="box <?php echo $sold_out_class; ?>">
    <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
    <div class="name"><?php echo $fetch_products['name']; ?></div>
    <div class="price">₱<?php echo $fetch_products['price']; ?></div>
    <?php if($quantity <= 0): ?>
        <button class="btn btn-disabled" disabled>Sold Out</button>
    <?php elseif($is_in_cart): ?>
        <button class="btn btn-disabled" disabled>Already in Cart</button>
    <?php else: ?>
        <form action="action/add-cart.php" method="post">
            <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
            <input type="hidden" value="<?php echo $product_id; ?>" name="product_id">
            <input type="submit" value="Add to Cart" name="add_to_cart" class="btn" style="background-color: skyblue; color: black;">
        </form>
    <?php endif; ?>
</div>
<?php
    }
} else {
    echo '<p class="empty">No products added yet!</p>';
}
?>

</div> <!-- .box-container -->
</section> <!-- .products -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
<?php include 'footer.php'; ?>

</body>
</html>
