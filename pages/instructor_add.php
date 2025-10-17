<?php
include '../config/db_connect.php';
if (isset($_POST['save'])) {
  $last = $conn->real_escape_string($_POST['last_name']);
  $first = $conn->real_escape_string($_POST['first_name']);
  $email = $conn->real_escape_string($_POST['email']);
  $dept = $conn->real_escape_string($_POST['dept_id']);
  mysqli_query($conn, "INSERT INTO tblinstructor 
  (last_name, first_name, email, dept_id) 
  VALUES ('$last','$first','$email','$dept')");
  header('Location: instructor.php'); exit;
}
?>

<!DOCTYPE html><html lang="en">
    <head><meta charset="UTF-8"><title>Add Instructor</title>
<style>

body {
    font-family:Arial;
    background:#f8f8f8;
    padding:20px
} 

.container {
    background:#fff;
    padding:20px;
    border-radius:10px;
    max-width:500px;
    margin:auto;
    box-shadow:0 2px 6px rgba(0,0,0,0.1)
} 

h2 {
    color:#800000;
    text-align:center
} 

input {
    width:100%;
    padding:8px;
    margin:5px 0 10px;
    border:1px solid #ccc;
    border-radius:5px
} 

button,a.btn {
    background:#800000;
    color:white;
    padding:8px 12px;
    border-radius:5px;
    border:none;
    cursor:pointer;
    text-decoration:none
} 

button:hover,a.btn:hover {
    background:#a52a2a
}

</style>
    </head>
<body>
    <div class="container"><h2>Add Instructor</h2>
<form method="POST">
<label>Last Name</label><input type="text" name="last_name" required>
<label>First Name</label><input type="text" name="first_name" required>
<label>Email</label><input type="email" name="email" required>
<label>Department ID</label><input type="text" name="dept_id" required>
<button type="submit" name="save">Save</button>
<a href="instructor.php" class="btn">Cancel</a>
</form></div></body></html>
