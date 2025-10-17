<?php
include '../config/db_connect.php';
if (!isset($_GET['id'])) { header('Location: room.php'); exit; }
$id = (int)$_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tblroom WHERE room_id = $id"));
if (isset($_POST['update'])) {
  $building = $conn->real_escape_string($_POST['building']);
  $room_code = $conn->real_escape_string($_POST['room_code']);
  $capacity = (int)$_POST['capacity'];
  mysqli_query($conn, "UPDATE tblroom SET building='$building', 
  room_code='$room_code', 
  capacity=$capacity WHERE room_id = $id");
  header('Location: room.php'); exit;
}
?>

<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8">
<title>Edit Room</title>
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
    padding:8px;margin:5px 0 10px;
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
    
<div class="container"><h2>Edit Room</h2>
<form method="POST">
<label>Building</label><input type="text" name="building" value="<?= htmlspecialchars($row['building']) ?>" required>
<label>Room Code</label><input type="text" name="room_code" value="<?= htmlspecialchars($row['room_code']) ?>" required>
<label>Capacity</label><input type="number" name="capacity" value="<?= htmlspecialchars($row['capacity']) ?>" required>
<button type="submit" name="update">Update</button><a href="room.php" class="btn">Cancel</a>
</form></div></body></html>
