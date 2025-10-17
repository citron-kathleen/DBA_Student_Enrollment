<?php
include '../config/db_connect.php';

// Soft delete
if (isset($_GET['delete'])) {
  $student_id = $_GET['delete'];
  mysqli_query($conn, "UPDATE tblstudent SET deleted_at = NOW() WHERE student_id = $student_id");
  header('Location: student.php');
  exit;
}

// Search
$search = '';
if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
  $query = "SELECT * FROM tblstudent 
            WHERE deleted_at IS NULL 
            AND (student_no LIKE '%$search%' OR last_name LIKE '%$search%' OR first_name LIKE '%$search%' OR email LIKE '%$search%') 
            ORDER BY student_id DESC";
} else {
  $query = "SELECT * FROM tblstudent WHERE deleted_at IS NULL ORDER BY student_id DESC";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Records</title>
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
tr:hover { background-color: #f2f2f2; }
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
  <h2>Student Records</h2>

  <div class="top-bar">
    <div class="top-left">
      <form method="GET">
        <input type="text" name="search" placeholder="Search student..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
      </form>
      <a href="student_add.php" class="btn">+ Add</a>
    </div>
    <div class="top-right">
      <a href="student_export_pdf.php" class="btn">Export PDF</a>
      <a href="student_export_excel.php" class="btn">Export Excel</a>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Student No</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Birthdate</th>
        <th>Year Level</th>
        <th>Program ID</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= htmlspecialchars($row['student_no']) ?></td>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['birthdate']) ?></td>
            <td><?= htmlspecialchars($row['year_level']) ?></td>
            <td><?= htmlspecialchars($row['program_id']) ?></td>
            <td>
              <a href="student_edit.php?id=<?= $row['student_id'] ?>" class="action-btn">Edit</a>
              <a href="student.php?delete=<?= $row['student_id'] ?>" class="action-btn" onclick="return confirm('Soft delete this student?')">Delete</a>
            </td>
          </tr>
        <?php } ?>
      <?php else: ?>
        <tr><td colspan="8" style="text-align:center;">No records found</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="../index.php" class="back-btn">Back to Main menu</a>
</div>
</body>
</html>