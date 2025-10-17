<?php
include '../config/db_connect.php';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Enrollment_Records.xls");
header("Pragma: no-cache");
header("Expires: 0");

$result = mysqli_query($conn, "SELECT * FROM tblenrollment WHERE deleted_at IS NULL ORDER BY enrollment_id ASC");

echo "<table border='1' style='border-collapse:collapse; text-align:center; width:100%;'>";
echo "
<tr><th colspan='6' style='font-size:16px; text-align:center; padding:8px;'>
  Polytechnic University of the Philippines - Taguig Campus
</th></tr>
<tr><th colspan='6' style='text-align:center; padding:6px;'>Enrollment Records</th></tr>
<tr><td colspan='6' style='height:10px;'></td></tr>
<tr style='background-color:#f2f2f2; font-weight:bold;'>
  <th>Enrollment ID</th>
  <th>Student ID</th>
  <th>Section ID</th>
  <th>Date Enrolled</th>
  <th>Status</th>
  <th>Letter Grade</th>
</tr>
";
while($row = mysqli_fetch_assoc($result)){
  echo "<tr>
    <td>{$row['enrollment_id']}</td>
    <td>{$row['student_id']}</td>
    <td>{$row['section_id']}</td>
    <td>{$row['date_enrolled']}</td>
    <td>{$row['status']}</td>
    <td>{$row['letter_grade']}</td>
  </tr>";
}
echo "</table>";
exit;
?>
