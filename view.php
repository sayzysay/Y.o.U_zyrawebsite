<?php
// Include database connection
$config_path = 'config.php';
if (file_exists($config_path) && is_readable($config_path)) {
    include($config_path);
} else {
    die("Unable to include '$config_path'");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
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
<?php 
    $request_id  = $_GET['id'];
    $total = $_GET['total'];
?>

<section class="orders">
    <h1 class="title">View Orders</h1>
    <h4 class="title">Request ID: <?php echo $request_id; ?></h4>

    <div class="table-container">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                ?>
                <tr>
                    <td><img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" style="height:200px;width:200px;"></td>
                    <td><?php echo $fetch_order['name']; ?></td>
                    <td><?php echo $fetch_orders['total_price']; ?></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total Price:</td>
                    <td><?php echo $total; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
