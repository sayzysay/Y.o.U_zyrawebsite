<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Include SweetAlert CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!-- Font Awesome JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


<link rel="stylesheet" href="css/admin_style.css">
<style>
      .dt-buttons button {
         padding: 0.2rem 0.5rem;
         font-size: 0.7rem;
      }
      .dt-buttons button {
         padding: 0.2rem 0.5rem;
         font-size: 0.7rem;
      }
      .table-container {
         margin: auto;
         width: 80%; /* Adjust width as needed */
      }
   </style>
</head>
<body>
   <?php include 'admin_header.php'; ?>
   <section class="users">
      <h1 class="title">User Accounts</h1>
      <div class="table-container">
         <table id="userTable" class="user-table">
            <thead>
               <tr>
                  <th>User ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>User Type</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php
               include 'config.php';
               $admin_id = $_SESSION['admin_id'];
               if(!isset($admin_id)){
                  header('location:login.php');
               }
               if(isset($_GET['delete'])){
                  $delete_id = $_GET['delete'];
                  mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
                  header('location:admin_users.php');
               }
               // Check if sorting parameter is set
               $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default sorting by user id
               // Define valid sorting options to prevent SQL injection
               $valid_sorting_columns = ['id', 'name', 'email', 'address', 'phone', 'user_type'];
               if (!in_array($sort, $valid_sorting_columns)) {
                  $sort = 'id'; // Set default sorting if invalid column is provided
               }
               $select_users = mysqli_query($conn, "SELECT * FROM `users` ORDER BY $sort") or die('Query failed');
               while ($fetch_users = mysqli_fetch_assoc($select_users)) {
                  ?>
             <tr>
    <td><?php echo $fetch_users['id']; ?></td>
    <td><?php echo $fetch_users['name']; ?></td>
    <td><?php echo $fetch_users['email']; ?></td>
    <td><?php echo $fetch_users['address']; ?></td>
    <td><?php echo $fetch_users['phone']; ?></td>
    <td style="color:<?php echo ($fetch_users['user_type'] == 'admin') ? 'var(--orange)' : ''; ?>"><?php echo $fetch_users['user_type']; ?></td>
    <td>
        <a href="#" onclick="updateUser(<?php echo $fetch_users['id']; ?>);" class="option-btn">Update</a>
        <a href="#" onclick="deleteUser(<?php echo $fetch_users['id']; ?>);" class="delete-btn">Delete</a>
    </td>
</tr>

<script>
    function updateUser(userId) {
        Swal.fire({
            title: 'Update User',
            text: 'Are you sure you want to update this user?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to update user page
                window.location.href = 'admin_update.php?update=' + userId;
            }
        });
    }

    function deleteUser(userId) {
        Swal.fire({
            title: 'Delete User',
            text: 'Are you sure you want to delete this user?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete user script
                window.location.href = 'admin_users.php?delete=' + userId;
            }
        });
    }
</script>


                  <?php
               };
               ?>
            </tbody>
         </table>
      </div>
   </section>

   <!-- jQuery CDN - Slim version (=without AJAX) -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Include DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>



<script type="text/javascript">
    
        $(document).ready(function() {
            $('#userTable').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: '<i class="fas fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-outline-primary',
                        text: '<i class="fas fa-file-csv"></i> CSV'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-outline-info',
                        text: '<i class="fas fa-print"></i> Print'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-outline-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    }
                ],
            
                lengthMenu: [10, 25, 50, 100],
                order: [],
                initComplete: function () {
                    // Adjust length dropdown width
                    $('.dataTables_length select').css('width', '100px'); // Adjust width as needed
                }
            });
        });



     
    </script>
</body>
</html>
