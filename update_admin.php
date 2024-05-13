<?php

// Connect to the database
include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Retrieve the form data from the $_POST array
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare the SQL statement
$stmt = $conn->prepare("UPDATE users SET name =?, email =?, password =? WHERE id =?");

// Bind the parameters to the SQL statement
$stmt->bind_param("sssi", $name, $email, $password, $id);

// Execute the SQL statement
$stmt->execute();

// Check for errors
if ($stmt->errno) {
    // Handle the error
    echo "Error: ". $stmt->error;
} else {
    // Redirect to the admin page
    header("Location: admin_page.php");
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

?>