<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $query = mysqli_query($conn, "SELECT * FROM tblenrollment WHERE enrollment_id = $id");
  $enrollment = mysqli_fetch_assoc($query);
  if (!$enrollment) {
      die("Enrollment not found.");
  }
}

if (isset($_POST['update'])) {
  $stud_id = $_POST['student_id'];
  $sec_id = $_POST['section_id'];
  $date = $_POST['date_enrolled'];
  $status = $_POST['status'];
  $letter = $_POST['letter_grade'];

  $update = "UPDATE tblenrollment SET 
    student_id = '$stud_id',
    section_id = '$sec_id',
    date_enrolled = '$date',
    `status` = '$status',
    letter_grade = '$letter'
    WHERE enrollment_id = $id";

  if (mysqli_query($conn, $update)) {
    header('Location: enrollment.php');
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
<title>Edit Student</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
  }
  .container {
    width: 500px;
    margin: 60px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
    padding: 20px;
  }
  h2 {
    text-align: center;
    color: #800000;
    margin-bottom: 15px;
  }
  form {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  label {
    font-weight: bold;
    color: #333;
    font-size: 14px;
  }
  input, select {
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 13px;
    width: 100%;
    box-sizing: border-box;
  }
  button {
    background-color: #800000;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    margin-top: 10px;
  }
  button:hover {
    background-color: #a52a2a;
  }
  .back {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    color: #800000;
    font-size: 14px;
  }
  .back:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>
  <div class="container">
    <h2>Edit Student Information</h2>
    <form method="POST">
      <label>Student Id: </label> 
      <input type="number" name="student_id" value="<?= $enrollment['student_id'] ?>">

      <label>Section Id:</label>
      <input type="number" name="section_id" value="<?= $enrollment['section_id'] ?>" required>

      <label>Date enrolled:</label>
      <input type="date" name="date_enrolled" value="<?= $enrollment['date_enrolled'] ?>" required>

      <label>Status:</label>
      <input type="text" name="status" value="<?= $enrollment['status'] ?>" required>

      <label>Letter grade:</label>
      <input type="text" name="letter_grade" value="<?= $enrollment['letter_grade'] ?>" required>
        
</input>

      <button type="submit" name="update">Update</button>
      <a href="enrollment.php" class="back">Back to Students</a>
    </form>
  </div>
</body>
</html>