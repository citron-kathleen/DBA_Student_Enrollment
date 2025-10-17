<?php
include '../config/db_connect.php';

if (isset($_POST['save'])) {
  $code = $_POST['course_code'];
  $title = $_POST['course_title'];
  $units = $_POST['units'];
  $lec = $_POST['lecture_hours'];
  $lab = $_POST['lab_hours'];
  $dept = $_POST['dept_id'];

  $query = "INSERT INTO tblcourse (course_code, course_title, units, lecture_hours, lab_hours, dept_id)
            VALUES ('$code', '$title', '$units', '$lec', '$lab', '$dept')";
  mysqli_query($conn, $query);
  header('Location: course.php');
  exit;
}
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><title>Add Course</title>
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

input[type=text], input[type=number] {
  width:100%; 
  padding:8px; 
  margin:5px 0 10px;
  border:1px solid #ccc; 
  border-radius:5px;
}

button, a.btn {
  background:#800000; 
  color:white; 
  border:none;
  padding:8px 12px; 
  border-radius:5px; 
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
  <h2>Add Course</h2>
  <form method="POST">
    <label>Course Code</label>
    <input type="text" name="course_code" required>

    <label>Course Title</label>
    <input type="text" name="course_title" required>

    <label>Units</label>
    <input type="number" name="units" required>

    <label>Lecture Hours</label>
    <input type="number" name="lecture_hours" required>

    <label>Lab Hours</label>
    <input type="number" name="lab_hours" required>

    <label>Department ID</label>
    <input type="text" name="dept_id" required>

    <button type="submit" name="save">Save</button>
    <a href="course.php" class="btn">Cancel</a>
  </form>
</div>
</body>
</html>
