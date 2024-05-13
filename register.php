<?php

include 'config.php';

$message = array(); 

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `users`(name, email, address,phone , password, user_type) VALUES('$name', '$email', '$address ', '$phone', '$cpass', '$user_type')") or die('query failed');
         if($insert){
             echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Registration Successful.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'login.php';
                            }
                        });
                    };
                </script>";
         }
      }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <?php
if(!empty($message)) {
    foreach($message as $msg) {
        echo "<div class='message'>$msg</div>"; 
    }
}
?>
    
   <style>
      .password-container {
   position: relative;
 }
 .password-container .toggle-password {
   position: absolute;
   top: 50%;
   right: 10px;
   transform: translateY(-50%);
   cursor: pointer;
 }
 
 .password-container input[type="password"] {
   padding-right: 30px; 
 }
   </style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
   <div class="form-container">

<form action="" method="post">
<img src="images/LOGO1.jpeg" alt="Logo" style="border-radius: 50%; height: 75px;">
   <h3>register</h3>
   
   <input type="text" name="name" placeholder="enter your name" required class="box">
   <input type="email" name="email" placeholder="enter your email" required class="box">
   <input type="text" name="address" placeholder="enter your address" required class="box">
   <input type="number" name="phone" placeholder="enter your number" required class="box">
   <div class="password-container">
      <input type="password" name="password" id="password" placeholder="enter your password" required class="box">
      <span class="toggle-password fas fa-eye" onclick="togglePasswordVisibility('password')"></span>
   </div> 
   <div class="password-container">
    <input type="password" name="cpassword" placeholder="confirm your password" required class="box" id="cpassword">
<span class="toggle-password fas fa-eye" onclick="togglePasswordVisibility('cpassword')"></span>
</div>
   <select name="user_type" class="box">
      <option value="user">user</option>
      <option value="admin">admin</option>
   </select>
   <input type="submit" name="submit" value="register" class="btn" style="background-color: violet;">
   <p>already have an account? <a href="login.php" style="color: skyblue;">login</a></p>
</form>

</div>
   <script>
   const togglePassword = document.querySelector('#togglePassword');
   const password = document.querySelector('#password');

   togglePassword.addEventListener('click', function (e) {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
   });

function togglePasswordVisibility(inputId) {
  const input = document.getElementById(inputId);
  const icon = input.nextElementSibling;
  
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    input.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}
</script>

</div>

</body>
</html>