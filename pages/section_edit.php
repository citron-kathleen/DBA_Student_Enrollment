<?php
include '../config/db_connect.php';

// Check if ID is provided and fetch record
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tblroom WHERE room_id = $id");
    $room = mysqli_fetch_assoc($query);
} else {
    header('Location: room.php');
    exit;
}

// Handle update
if (isset($_POST['update'])) {
    $section_code = $conn->real_escape_string($_POST['section_code']);
    $room_code = $conn->real_escape_string($_POST['room_code']);
    $capacity = (int)$_POST['capacity'];

    $update = "UPDATE tblroom SET 
        section_code = '$section_code',
        room_code = '$room_code',
        capacity = $capacity
        WHERE room_id = $id";

    if (mysqli_query($conn, $update)) {
        header('Location: room.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Room</title>
<style>
body {
     font-family: Arial, sans-serif; 
     background:#f8f8f8; 
     margin:0; 
     padding:0; 
    }

.container { 
    width: 500px; 
    margin: 60px auto; 
    background:#fff; 
    border-radius:10px; 
    box-shadow:0 2px 5px rgba(0,0,0,0.2); 
    padding:20px; 
}

h2 { 
    text-align:center; 
    color:#800000; 
    margin-bottom:15px; 
}

form { 
    display:flex; 
    flex-direction:column; 
    gap:10px; 
}

label { 
    font-weight:bold; 
    color:#333; 
    font-size:14px; 
}

input { 
    padding:6px; 
    border:1px solid #ccc; 
    border-radius:5px; 
    font-size:13px; 
    width:100%; 
    box-sizing:border-box; 
}

button { 
    background-color:#800000; 
    color:white; 
    border:none; 
    padding:10px; 
    border-radius:5px; 
    cursor:pointer; 
    font-size:14px; 
    margin-top:10px; 
}

button:hover { 
    background-color:#a52a2a; 
}

.back { 
    display:inline-block; 
    margin-top:10px; 
    text-decoration:none; 
    color:#800000; 
    font-size:14px; 
}

.back:hover { 
    text-decoration:underline; 
}

.message { 
    text-align:center; 
    color:#800000; 
    font-size:16px; 
    margin-top:20px; 
    }
</style>
</head>
<body>

<div class="container">
<?php if (!$room): ?>
    <p class="message">Room not found.</p>
    <a href="room.php" class="back">Back to Rooms</a>
<?php else: ?>
    <h2>Edit Room</h2>
    <form method="POST">
        <label>Section Code:</label>
        <input type="number" name="section_code" value="<?= htmlspecialchars($room['section_code']) ?>" required>

        <label>Room Code:</label>
        <input type="text" name="room_code" value="<?= htmlspecialchars($room['room_code']) ?>" required>

        <label>Capacity:</label>
        <input type="number" name="capacity" value="<?= htmlspecialchars($room['capacity']) ?>" required>

        <button type="submit" name="update">Update</button>
        <a href="room.php" class="back">Back to Rooms</a>
    </form>
<?php endif; ?>
</div>
</body>
</html>
