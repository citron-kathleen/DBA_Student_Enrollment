<?php
include '../config/db_connect.php';

// Soft delete
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "UPDATE tblenrollment SET deleted_at = NOW() WHERE enrollment_id = $id");
  header('Location: enrollment.php');
  exit;
}

// Search
$search = '';
if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
  $query = "SELECT * FROM tblenrollment
            WHERE deleted_at IS NULL
            AND (enrollment_id LIKE '%$search%' OR student_id LIKE '%$search%' OR section_id LIKE '%$search%' OR status LIKE '%$search%')
            ORDER BY enrollment_id DESC";
} else {
  $query = "SELECT * FROM tblenrollment WHERE deleted_at IS NULL ORDER BY enrollment_id DESC";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><title>Enrollment Records</title>
<style>
/* reuse same styles as student.php */

body { 
    font-family: Arial, sans-serif; 
    background-color:#f8f8f8; 
    margin:0; 
    padding:20px; 
}

.container { 
    background:#fff; 
    padding:20px; 
    border-radius:10px; 
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

h2 { 
    color:#800000; 
    margin-bottom:15px; 
    text-align:center; 
}

.top-bar { 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    margin-bottom:15px; 
}

.top-left { 
    display:flex; 
    align-items:center; 
    gap:8px; 
}

.top-right { 
    display:flex; 
    gap:8px; 
}

input[type="text"] { 
    padding:6px; 
    border:1px solid #ccc; 
    border-radius:5px; 
    width:200px; 
}

button, a.btn { 
    background-color:#800000; 
    color:white; 
    text-decoration:none; 
    padding:6px 10px; 
    border-radius:5px; 
    border:none; 
    cursor:pointer; 
}

button:hover, a.btn:hover { 
    background-color:#a52a2a; 
}

table { 
    width:100%; 
    border-collapse:collapse; 
}

th, td { 
    padding:8px; 
    border-bottom:1px solid #ddd; 
    text-align:left; 
}

th { 
    background-color:#800000; 
    color:white;
}

tr:hover { 
    background-color:#f2f2f2; 
}

a.action-btn { 
    background-color:#800000; 
    color:white; 
    text-decoration:none; 
    padding:5px 8px; 
    border-radius:5px; 
}

a.action-btn:hover { 
    background-color:#a52a2a; 
}

.back-btn {
     display:inline-block; 
     margin-top:15px; 
     text-decoration:none; 
     color:#800000; 
     font-weight:bold; 
}
</style>
</head>
<body>

<div class="container">
  <h2>Enrollment Records</h2>

  <div class="top-bar">
    <div class="top-left">
      <form method="GET">
        <input type="text" name="search" placeholder="Search enrollment..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
      </form>
      <a href="enrollment_add.php" class="btn">+ Add</a>
    </div>
    <div class="top-right">
      <a href="enrollment_export_pdf.php" class="btn">Export PDF</a>
      <a href="enrollment_export_excel.php" class="btn">Export Excel</a>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Section ID</th>
        <th>Date Enrolled</th>
        <th>Status</th>
        <th>Letter Grade</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= htmlspecialchars($row['enrollment_id']) ?></td>
            <td><?= htmlspecialchars($row['student_id']) ?></td>
            <td><?= htmlspecialchars($row['section_id']) ?></td>
            <td><?= htmlspecialchars($row['date_enrolled']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= htmlspecialchars($row['letter_grade']) ?></td>
            <td>
              <a href="enrollment_edit.php?id=<?= $row['enrollment_id'] ?>" class="action-btn">Edit</a>
              <a href="enrollment.php?delete=<?= $row['enrollment_id'] ?>" class="action-btn" onclick="return confirm('Soft delete this enrollment?')">Delete</a>
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
