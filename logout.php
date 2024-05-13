<?php

include 'config.php';

session_start();
session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Add SweetAlert2 CDN link -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>Logout</title>
</head>
<body>
   <!-- Script for displaying SweetAlert on page load -->
   <script>
      // Wait for the DOM to be fully loaded
      document.addEventListener('DOMContentLoaded', function() {
         // Display SweetAlert
         Swal.fire({
            title: 'Logged Out',
            text: 'You have been successfully logged out.',
            icon: 'success',
            confirmButtonText: 'OK'
         }).then((result) => {
            if (result.isConfirmed) {
               // Redirect to login page
               window.location.href = 'login.php';
            }
         });
      });
   </script>
</body>
</html>
