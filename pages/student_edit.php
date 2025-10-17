<?php
include '../config/db_connect.php';

// Fetch data
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = mysqli_query($conn, "SELECT * FROM tblstudent WHERE student_id = $id");
  $student = mysqli_fetch_assoc($query);
}

// Update logic
if (isset($_POST['update'])) {
  $id = $_POST['student_id'];
  $student_no = $_POST['student_no'];
  $last_name = $_POST['last_name'];
  $first_name = $_POST['first_name'];
  $email = $_POST['email'];
  $birthdate = $_POST['birthdate'];
  $year_level = $_POST['year_level'];
  $program_id = $_POST['program_id'];

  $update = "UPDATE tblstudent SET 
    student_no='$student_no',
    last_name='$last_name',
    first_name='$first_name',
    email='$email',
    birthdate='$birthdate',
    year_level='$year_level',
    program_id='$program_id'
    WHERE student_id=$id";

  if (mysqli_query($conn, $update)) {
    header('Location: student.php');
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
      <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">

      <label>Student No:</label>
      <input type="text" name="student_no" value="<?= $student['student_no'] ?>" required>

      <label>Last Name:</label>
      <input type="text" name="last_name" value="<?= $student['last_name'] ?>" required>

      <label>First Name:</label>
      <input type="text" name="first_name" value="<?= $student['first_name'] ?>" required>

      <label>Email:</label>
      <input type="email" name="email" value="<?= $student['email'] ?>" required>

      <label>Birthdate:</label>
      <input type="date" name="birthdate" value="<?= $student['birthdate'] ?>" required>

      <label>Year Level:</label>
      <input type="number" name="year_level" value="<?= $student['year_level'] ?>" min="1" max="5" required>

      <label>Program Id:</label>
      <input type="number" name="program_id" value="<?= $student['program_id'] ?>" min="1" max="12" required>
        
</input>

      <button type="submit" name="update">Update</button>
      <a href="student.php" class="back">Back to Students</a>
    </form>
  </div>
</body>
</html>