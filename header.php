<?php
// Define the current page URL
$current_page = basename($_SERVER['PHP_SELF']);

// Function to check if a given page is active
function isActive($page, $current_page) {
    return ($page == $current_page) ? 'active' : '';
}

// Function to check if a dropdown or its item is active
function isDropdownActive($pages, $current_page) {
    foreach ($pages as $page) {
        if ($page == $current_page) {
            return 'active';
        }
    }
    return '';
}
?>
<header class="header">
   <?php if (!isset($_SESSION['user_id'])) : ?>
   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://web.facebook.com/youbeautyph" class="fab fa-facebook-f"></a>
         </div>
         <p> New <a href="login.php" style="color: violet;">Login</a> | <a href="register.php" style="color: violet;">Register</a> </p>
      </div>
   </div>
   <?php endif; ?>

   <div class="header-2">
      <div class="flex">
         <a href="home.php"><img src="images/LOGO1.jpeg" alt="Logo" height="75px" style="border-radius:100%;"></a>
         <nav class="navbar">
            <a href="home.php" class="<?php echo isActive('home.php', $current_page); ?>">Home</a>
            <a href="shop.php" class="<?php echo isActive('shop.php', $current_page); ?>">Product</a>
            <a href="contact.php" class="<?php echo isActive('contact.php', $current_page); ?>">Contact</a>
            <a href="orders.php" class="<?php echo isActive('orders.php', $current_page); ?>">Orders</a>
            <a href="about.php" class="<?php echo isActive('about.php', $current_page); ?>">About</a>
         </nav>
         <style>
            /* Dropdown container (div) */
            .dropdown {
            position: relative;
            display: inline-block;
            }
            .navbar a.active,
            .dropdown button.active {
            background-color: lightblue; /* Background color for active link */
            color: yellow; /* Text color for active link */
            }

            /* Dropdown button (button) */
            .dropbtn {
            background-color: white;
            color: black;
            padding: 0;
            font-size: 16px;
            border: none;
            cursor: pointer;
            }

            /* Dropdown content (div) */
            .dropdown-content {
            display: none;
            position: absolute;
            background-color: lightblue;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            /* Links inside the dropdown content (a) */
            .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {
            background-color: orange;
            }

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {
            display: block;
            }

            /* Style the dropdown button */
            .dropdown:hover .dropbtn {
            /* Remove background-color property */
            color: orange; /* Change text color when dropdown is shown */
            }
         </style>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <?php

            $query = $conn->prepare("SELECT COUNT(*) AS total_cart_items FROM cart WHERE user_id = ? AND status = 'np'");
            $query->bind_param("i", $user_id);
            $query->execute();
            $query->bind_result($cart_rows_number);
            $query->fetch();
            $query->close();
            ?>
            <a href="cart.php">
               <i class="fas fa-shopping-cart"></i>
               <span>(<?php echo $cart_rows_number; ?>)</span>
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: violet;">
               <i class="fa fa-credit-card"></i>Deposit
            </button>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deposit Money </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="fund.php" method="post">
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
        <div class="form-floating mb-3 form-group" >
        <input type="number" class="form-control" id="floatingInput" placeholder="" name="fund_amount">
        <label for="floatingInput">Add funds</label>
        </div>
    <div class="modal-footer">
      
    <?php
// Include config.php to connect to the database
include "config.php";

// Check if the user is logged in and has a session

if (isset($_SESSION['user_id'])) {
    // Retrieve the user's fund balance
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT fund_balance FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    
    // Check if the query was successful
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fund_balance = $row['fund_balance'];
        // Display the fund balance in the header
        echo "You have ₱".$fund_balance." in your account.";
    } else {
        // If no funds found, display a message or handle as needed
        echo "No funds found.";
    }
} else {
    // If user is not logged in, display login/register links or handle as needed
    echo "Please log in to view your funds.";
}
?>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Deposit</button>
      </div>
    </form>
      </div>
     
    </div>
  </div>
</div>
