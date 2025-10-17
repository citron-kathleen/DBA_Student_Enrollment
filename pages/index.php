<?php
include 'config/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enrollment System</title>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
    }

    /* SIDEBAR */
    .sidebar {
      height: 100vh;
      width: 230px;
      background-color: #800000; /* PUP maroon */
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      padding: 20px 10px;
    }

    .sidebar h2 {
      text-align: center;
      font-size: 22px;
      margin-bottom: 10px;
    }

    .sidebar small {
      display: block;
      text-align: center;
      font-size: 13px;
      margin-bottom: 25px;
      color: #ffcccc;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 15px 0;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .sidebar ul li a:hover {
      background-color: #a52a2a;
    }

    /* MAIN CONTENT */
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    .header {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
    }

    .header h1 {
      color: #800000;
      margin: 0;
      font-size: 20px;
    }

    .card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
    }

    .card h2 {
      color: #800000;
    }

  </style>
</head>
<body>

  <div class="sidebar">
    <h2>Enrollment<br>System</h2>
    <small>Database Tables</small>
    <ul>
      <li><a href="pages/course.php">Courses</a></li>
      <li><a href="pages/enrollment.php">Enrollments</a></li>
      <li><a href="pages/instructor.php">Instructors</a></li>
      <li><a href="pages/room.php">Rooms</a></li>
      <li><a href="pages/section.php">Sections</a></li>
      <li><a href="pages/student.php">Students</a></li>
      <li><a href="pages/term.php">Terms</a></li>
      <li><a href="pages/department.php">Departments</a></li>
      <li><a href="pages/program.php">Programs</a></li>
      <li><a href="pages/course_prerequisite.php">Course Prerequisites</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="header">
      <h1>Polytechnic University of the Philippines - Taguig Campus</h1>
    </div>

    <div class="card">
      <h2>Welcome to the Enrollment System</h2>
      <p>Select a table from the left menu to manage its records.</p>
    </div>

  </div>

</body>
</html>