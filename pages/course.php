<?php
include '../config/db_connect.php';

// Soft delete
if (isset($_GET['delete'])) {
  $course_id = $_GET['delete'];
  mysqli_query($conn, "UPDATE tblcourse SET deleted_at = NOW() WHERE course_id = $course_id");
  header('Location: course.php');
  exit;
}

// Search
$search = '';
if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
  $query = "SELECT * FROM tblcourse 
            WHERE deleted_at IS NULL 
            AND (course_code LIKE '%$search%' OR course_title LIKE '%$search%' OR dept_id LIKE '%$search%')
            ORDER BY course_id DESC";
} else {
  $query = "SELECT * FROM tblcourse WHERE deleted_at IS NULL ORDER BY course_id DESC";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Records</title>
<style>

body {
  font-family: Arial, sans-serif;
  background-color: #f8f8f8;
  margin: 0;
  padding: 20px;
}

.container {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
}

h2 {
  color: #800000;
  margin-bottom: 15px;
  text-align: center;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.top-left {
  display: flex;
  align-items: center;
  gap: 8px;
}

.top-right {
  display: flex;
  gap: 8px;
}

input[type="text"] {
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 200px;
}

button, a.btn {
  background-color: #800000;
  color: white;
  text-decoration: none;
  padding: 6px 10px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}

button:hover, a.btn:hover {
  background-color: #a52a2a;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

th {
  background-color: #800000;
  color: white;
}

tr:hover { 
    background-color: #f2f2f2; 
}

a.action-btn {
  background-color: #800000;
  color: white;
  text-decoration: none;
  padding: 5px 8px;
  border-radius: 5px;
}

a.action-btn:hover {
  background-color: #a52a2a;
}

.back-btn {
  display: inline-block;
  margin-top: 15px;
  text-decoration: none;
  color: #800000;
  font-weight: bold;
}
</style>
</head>
<body>
<div class="container">
  <h2>Course Records</h2>

  <div class="top-bar">
    <div class="top-left">
      <form method="GET">
        <input type="text" name="search" placeholder="Search course..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
      </form>
      <a href="course_add.php" class="btn">+ Add</a>
    </div>
    <div class="top-right">
      <a href="course_export_pdf.php" class="btn">Export PDF</a>
      <a href="course_export_excel.php" class="btn">Export Excel</a>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Units</th>
        <th>Lecture Hours</th>
        <th>Lab Hours</th>
        <th>Department ID</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= htmlspecialchars($row['course_code']) ?></td>
            <td><?= htmlspecialchars($row['course_title']) ?></td>
            <td><?= htmlspecialchars($row['units']) ?></td>
            <td><?= htmlspecialchars($row['lecture_hours']) ?></td>
            <td><?= htmlspecialchars($row['lab_hours']) ?></td>
            <td><?= htmlspecialchars($row['dept_id']) ?></td>
            <td>
              <a href="course_edit.php?id=<?= $row['course_id'] ?>" class="action-btn">Edit</a>
              <a href="course.php?delete=<?= $row['course_id'] ?>" class="action-btn" onclick="return confirm('Soft delete this course?')">Delete</a>
            </td>
          </tr>
        <?php } ?>
      <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">No records found</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="../index.php" class="back-btn">Back to Main menu</a>
</div>
</body>
</html>
