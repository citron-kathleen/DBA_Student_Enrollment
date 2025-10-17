<?php
include '../config/db_connect.php';
if (isset($_POST['save'])) {
  $building = $conn->real_escape_string($_POST['building']);
  $room_code = $conn->real_escape_string($_POST['room_code']);
  $capacity = (int)$_POST['capacity'];
  mysqli_query($conn, "INSERT INTO tblroom (building, room_code, capacity) 
  VALUES ('$building','$room_code',$capacity)");
  header('Location: room.php'); exit;
}
?>

<!DOCTYPE html><html lang="en">
    <head><meta charset="UTF-8">
    <title>Add Room</title>
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
    
<div class="container"><h2>Add Room</h2>
<form method="POST">
<label>Building</label><input type="text" name="building" required>
<label>Room Code</label><input type="text" name="room_code" required>
<label>Capacity</label><input type="number" name="capacity" required>
<button type="submit" name="save">Save</button><a href="room.php" class="btn">Cancel</a>
</form></div></body></html>
