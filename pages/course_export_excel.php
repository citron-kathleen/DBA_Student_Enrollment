<?php
// Connect to database
include '../config/db_connect.php';

// Set headers para ma-download as Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Course_Records.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Get all active courses (not deleted)
$result = mysqli_query($conn, "SELECT * FROM tblcourse WHERE deleted_at IS NULL ORDER BY course_id ASC");

// Start HTML table structure
echo "<table border='1' style='border-collapse:collapse; text-align:center; width:100%;'>";

// ====== Table Header / Title ======
echo "
<tr>
  <th colspan='6' style='font-size:16px; text-align:center; padding:8px;'>
    Polytechnic University of the Philippines - Taguig Campus
  </th>
</tr>
<tr>
  <th colspan='6' style='text-align:center; padding:6px;'>
    Course Records
  </th>
</tr>
<tr><td colspan='6' style='height:10px;'></td></tr> <!-- Blank row -->
";

// ====== Column Headers ======
echo "
<tr style='background-color:#f2f2f2; font-weight:bold;'>
  <th>Course Code</th>
  <th>Course Title</th>
  <th>Units</th>
  <th>Lecture Hours</th>
  <th>Lab Hours</th>
  <th>Department ID</th>
</tr>
";

// ====== Data Rows ======
while ($row = mysqli_fetch_assoc($result)) {
  echo "
  <tr>
    <td>{$row['course_code']}</td>
    <td>{$row['course_title']}</td>
    <td>{$row['units']}</td>
    <td>{$row['lecture_hours']}</td>
    <td>{$row['lab_hours']}</td>
    <td>{$row['dept_id']}</td>
  </tr>
  ";
}

// ====== End of Table ======
echo "</table>";

// Stop PHP execution
exit;
?>
