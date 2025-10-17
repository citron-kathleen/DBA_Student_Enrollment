<?php
include '../config/db_connect.php';

if (isset($_POST['save'])) {
  $section_code = $conn->real_escape_string($_POST['section_code']);
  $course_id = (int)$_POST['course_id'];
  $term_id = (int)$_POST['term_id'];
  $instructor_id = (int)$_POST['instructor_id'];
  $day = $conn->real_escape_string($_POST['day']);
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $room_id = (int)$_POST['room_id'];
  $max_capacity = (int)$_POST['max_capacity'];

  $query = "INSERT INTO tblsection (section_code, course_id, term_id, instructor_id, day, start_time, end_time, room_id, max_capacity)
            VALUES ('$section_code', $course_id, $term_id, $instructor_id, '$day', '$start_time', '$end_time', $room_id, $max_capacity)";
  mysqli_query($conn, $query);
  header('Location: section.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Section</title>
<style>
body { 
    font-family: Arial; 
    background:#f8f8f8; 
    padding:20px; 
}
.container {
     background:#fff; 
     padding:20px; 
     border-radius:10px; 
     box-shadow:0 2px 6px rgba(0,0,0,0.1); 
     max-width:500px;
      margin:auto; 
    }

h2 {
     color:#800000; 
     text-align:center; 
    }

input, select { 
    width:100%; 
    padding:8px; 
    margin:5px 0 10px; 
    border:1px solid #ccc; 
    border-radius:5px; 
}

button, a.btn { 
    background:#800000; 
    color:white; padding:8px 12px; 
    border-radius:5px; 
    border:none; 
    cursor:pointer; 
    text-decoration:none; 
}

button:hover, a.btn:hover { 
    background:#a52a2a; 
    }
</style>
</head>
<body>

<div class="container">
  <h2>Add Section</h2>
  <form method="POST">
    <label>Section Code</label>
    <input type="text" name="section_code" required>

    <label>Course ID</label>
    <input type="number" name="course_id" required>

    <label>Term ID</label>
    <input type="number" name="term_id" required>

    <label>Instructor ID</label>
    <input type="number" name="instructor_id" required>

    <label>Day</label>
    <input type="text" name="day" required>

    <label>Start Time</label>
    <input type="time" name="start_time" required>

    <label>End Time</label>
    <input type="time" name="end_time" required>

    <label>Room ID</label>
    <input type="number" name="room_id" required>

    <label>Max Capacity</label>
    <input type="number" name="max_capacity" required>

    <button type="submit" name="save">Save</button>
    <a href="section.php" class="btn">Cancel</a>
  </form>
</div>
</body>
</html>
