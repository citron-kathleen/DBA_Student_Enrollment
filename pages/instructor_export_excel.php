
<?php
// Connect to database
include '../config/db_connect.php';

// Set headers para ma-download as Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Student_Records.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Get all active instructor (not deleted)
$result = mysqli_query($conn, "SELECT * FROM tblinstructor WHERE deleted_at IS NULL ORDER BY instructor_id ASC");

// Start HTML table structure
echo "<table border='1' style='border-collapse:collapse; text-align:center; width:100%;'>";

// ====== Table Header / Title ======
echo "
<tr>
  <th colspan='5' style='font-size:16px; text-align:center; padding:8px;'>
    Polytechnic University of the Philippines - Taguig Campus
  </th>
</tr>
<tr>
  <th colspan='5' style='text-align:center; padding:6px;'>
    Instructor Records
  </th>
</tr>
<tr><td colspan='5' style='height:10px;'></td></tr> <!-- Blank row -->
";

// ====== Column Headers ======
echo "
<tr style='background-color:#f2f2f2; font-weight:bold;'>
  <th>Instructor ID</th>
  <th>Last Name</th>
  <th>First Name</th>
  <th>Email</th>
  <th>Department ID</th>
</tr>
";

// ====== Data Rows ======
while ($row = mysqli_fetch_assoc($result)) {
  echo "
  <tr>
    <td>{$row['instructor_id']}</td>
    <td>{$row['last_name']}</td>
    <td>{$row['first_name']}</td>
    <td>{$row['email']}</td>
    <td>{$row['dept_id']}</td>
  </tr>
  ";
}

// ====== End of Table ======
echo "</table>";

// Stop PHP execution
exit;
?>

