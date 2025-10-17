<?php
include '../config/db_connect.php';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Room_Records.xls");
header("Pragma: no-cache"); header("Expires: 0");
$result = mysqli_query($conn, "SELECT * FROM tblroom WHERE deleted_at IS NULL ORDER BY room_id ASC");
echo "<table border='1' style='border-collapse:collapse; text-align:center; width:100%;'>";
echo "<tr><th colspan='4' style='font-size:16px; text-align:center; padding:8px;'>Polytechnic University of the Philippines - Taguig Campus</th></tr>";
echo "<tr><th colspan='4' style='text-align:center; padding:6px;'>Room Records</th></tr>";
echo "<tr><td colspan='4' style='height:10px;'></td></tr>";
echo "<tr style='background-color:#f2f2f2; font-weight:bold;'><th>Room ID</th><th>Building</th><th>Room Code</th><th>Capacity</th></tr>";
while($row=mysqli_fetch_assoc($result)) { 
    echo "<tr><td>{$row['room_id']}</td><td>{$row['building']}</td><td>{$row['room_code']}</td><td>{$row['capacity']}</td></tr>"; }
echo "</table>"; exit;
?>
