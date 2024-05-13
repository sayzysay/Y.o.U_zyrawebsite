<?php

include 'config.php';
session_start();

$login_failed = false; // Flag to track login failure
$login_success = false; // Flag to track login success

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password'])); // md5 for hashing the password

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         $login_success = true; // Set login success flag

      } elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         $login_success = true; // Set login success flag
      }

   } else {
      $login_failed = true; 
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- SweetAlert2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>Login</title>

   <style>
      .password-container {
         position: relative;
      }

      #togglePassword {
         position: absolute;
         top: 50%;
         right: 10px;
         transform: translateY(-50%);
         cursor: pointer;
      }
   </style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if($login_failed){
   // Display SweetAlert if login failed
   echo "<script>
            Swal.fire({
               title: 'Error!',
               text: 'Invalid username or password.',
               icon: 'error',
               confirmButtonText: 'OK'
            });
         </script>";
}

if($login_success){
   // Display SweetAlert if login successful
   if(isset($_SESSION['admin_name'])){
      // If the user is an admin, display a welcome message for admin
      echo "<script>
            Swal.fire({
               title: 'Welcome ".$_SESSION['admin_name']." (Admin)',
               text: 'Login successful.',
               icon: 'success',
               confirmButtonText: 'OK'
            }).then(() => {
               window.location.href = 'admin_page.php'; // Redirect to admin page after OK button is clicked
            });
         </script>";
   } else {
      // If the user is a regular user, display a generic welcome message
      echo "<script>
            Swal.fire({
               title: 'Success!',
               text: 'Login successful.',
               icon: 'success',
               confirmButtonText: 'OK'
            }).then(() => {
               window.location.href = 'home.php'; // Redirect to home.php after OK button is clicked
            });
         </script>";
   }
}
?>

<div class="form-container">
   <form action="" method="post">
      <img src="images/LOGO1.jpeg" alt="Logo" style="border-radius: 50%; height: 75px;">
      <h3>Login</h3>
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <div class="password-container">
         <input type="password" name="password" id="password" placeholder="Enter your password" required class="box">
         <i class="fas fa-eye" id="togglePassword"></i>
      </div>
      <input type="submit" name="submit" value="Log in" class="btn" style="background-color: violet;">
      <p>Don't have an account? <a href="register.php" style="color: skyblue;">Register</a></p>
   </form>
</div>

<script>
   const togglePassword = document.querySelector('#togglePassword');
   const password = document.querySelector('#password');

   togglePassword.addEventListener('click', function (e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
   });
</script>
 
</body>
</html>
