<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<?php
include "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $user_id = $_POST["user_id"];
    $fund_amount = $_POST["fund_amount"];
    
    // Update fund_balance in the database
    $sql = "UPDATE users SET fund_balance = fund_balance + $fund_amount WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'fund added successfully!',
        }).then(() => {
            // Redirect to shop.php
            window.location.href = 'home.php';
        });
      </script>";
    } else {
        echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Insufficient funds!',
            }).then(() => {
                // Redirect to shop.php
                window.location.href = 'cart.php';
            });
          </script>"; 
    }
}

// Close MySQL connection
$conn->close();
?>
</body>
</html>
