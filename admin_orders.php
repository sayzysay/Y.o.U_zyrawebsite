<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit(); // Add an exit statement to prevent further execution
}

if (isset($_POST['update_order'])) {
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('Query failed');
   $message[] = 'Payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Query failed');
   header('location:admin_orders.php');
   exit(); // Add an exit statement to prevent further execution
}

if (isset($_GET['approved'])) {
   $approved_id = $_GET['approved'];
   mysqli_query($conn, "UPDATE `orders` SET order_status = 'approved' WHERE id = '$approved_id'") or die('Query failed');
   header('location:admin_orders.php');
   exit(); // Add an exit statement to prevent further execution
}

if (isset($_GET['cancel'])) {
   $cancel_id = $_GET['cancel'];
   mysqli_query($conn, "UPDATE `orders` SET order_status = 'cancelled' WHERE id = '$cancel_id'") or die('Query failed');
   header('location:admin_orders.php');
   exit(); // Add an exit statement to prevent further execution
}
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

   <!-- Custom admin CSS file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<style>
    .table-container {
        overflow-x: auto;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-table th,
    .order-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    .order-table th {
        background-color: #f2f2f2;
    }

    .order-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .order-table tr:hover {
        background-color: #dddddd;
    }
</style>

<?php include 'admin_header.php'; ?>

<section class="orders">
    <h1 class="title">Placed Orders</h1>

    <div class="table-container">
        <table class="order-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Placed On</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Payment Status</th>
                    <th>Total Products</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // Assuming $conn is your database connection
            $select_orders = mysqli_query($conn,"SELECT * FROM `orders`") or die('Query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <tr>
                <td><?php echo $fetch_orders['user_id'];?></td>
                <td><?php echo $fetch_orders['placed_on'];?></td>
                <td><?php echo $fetch_orders['name'];?></td>
                <td><?php echo $fetch_orders['number'];?></td>
                <td><?php echo $fetch_orders['email'];?></td>
                <td><?php echo $fetch_orders['address'];?></td>
                <td><?php echo $fetch_orders['payment_status'];?></td>
                <td><?php echo $fetch_orders['total_price'];?></td>
                <td>
    <a href="action/approved-order.php?id=<?php echo $fetch_orders['id']; ?>&total=<?php echo $fetch_orders['total_price']; ?>" class="btn btn-sm" style="background-color:green;">Approved</a>
    <a href="action/cancel-order.php?id=<?php echo $fetch_orders['id']; ?>" class="btn btn-sm" style="background-color:red;">Cancel</a>
</td>


                
            </tr>
            <?php
                }}
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Custom admin JS file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
