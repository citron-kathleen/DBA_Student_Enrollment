<?php
include '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_no = $_POST['student_no'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $year_level = $_POST['year_level'];
    $program_id = $_POST['program_id'];

    $sql = "INSERT INTO tblstudent (student_no, last_name, first_name, email, birthdate, year_level, program_id) 
            VALUES ('$student_no', '$last_name', '$first_name', '$email', '$birthdate', '$year_level', '$program_id')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: student.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 500px;
      margin: 50px auto;
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

  </style>
</head>
<body>
  <div class="container">
    <h2>Add New Student</h2>
    <form method="POST" action="">
      <label>Student No:</label>
      <input type="text" name="student_no" required>

      <label>Last Name:</label>
      <input type="text" name="last_name" required>

      <label>First Name:</label>
      <input type="text" name="first_name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Birthdate:</label>
      <input type="date" name="birthdate" required>

      <label>Year Level:</label>
      <input type="number" name="year_level" min="1" max="5" required>

      <label>Program ID:</label>
      <input type="number" name="program_id" min="1" max="12" required>

</input>

      <button type="submit">Add Student</button>
      <a href="student.php" class="back">Back to Students</a>
    </form>
  </div>
</body>
</html>