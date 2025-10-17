<?php
include '../config/db_connect.php';

if (isset($_POST['save'])) {
  $student_id = $_POST['student_id'];
  $section_id = $_POST['section_id'];
  $date_enrolled = $_POST['date_enrolled'];
  $status = $_POST['status'];
  $letter_grade = $_POST['letter_grade'];

  $query = "INSERT INTO tblenrollment (student_id, section_id, date_enrolled, 'status', letter_grade)
            VALUES ($student_id, $section_id, '$date_enrolled', '$status', '$letter_grade')";
  mysqli_query($conn, $query);
  header('Location: enrollment.php');
  exit;
}

?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">
<title>Add Enrollment</title>
<style>
/* same simple form style */

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
    color:white; 
    padding:8px 12px; 
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
  <h2>Add Enrollment</h2>
  <form method="POST">
    <label>Student ID</label>
    <input type="number" name="student_id" required>
    <label>Section ID</label>
    <input type="number" name="section_id" required>
    <label>Date Enrolled</label>
    <input type="date" name="date_enrolled" required>
    <label>Status</label>
    <input type="text" name="status" required>
    <label>Letter Grade</label>
    <input type="text" name="letter_grade">

    <button type="submit" name="save">Save</button>
    <a href="enrollment.php" class="btn">Cancel</a>
  </form>
</div>
</body>
</html>







