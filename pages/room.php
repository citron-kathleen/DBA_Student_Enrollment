<?php
include '../config/db_connect.php';
if (isset($_GET['delete'])) { 
    $id=(int)$_GET['delete']; mysqli_query
    ($conn,"UPDATE tblroom SET deleted_at=NOW() WHERE room_id=$id"); 
    header('Location: room.php'); exit; }
$search=''; if (isset($_GET['search'])) { 
    $search = mysqli_real_escape_string($conn,$_GET['search']); 
    $q="SELECT * FROM tblroom WHERE deleted_at IS NULL AND (building LIKE 
    '%$search%' OR room_code LIKE '%$search%') ORDER BY room_id DESC"; 
} 
else { 
    $q="SELECT * FROM tblroom WHERE deleted_at IS NULL ORDER BY room_id DESC"; 
}
$result = mysqli_query($conn,$q);
?>

<!DOCTYPE html><html lang="en">
    <head><meta charset="UTF-8"><title>Room Records</title>
<style>
body {
    font-family:Arial;
    background:#f8f8f8;
    margin:0;
    padding:20px
    }

    .container {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1)
    } 

    h2 {
        color:#800000;
        text-align:
        center;margin-bottom:15px
    }
    
    .top-bar { 
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:15px
    }
    
    .top-left {
        display:flex;
        align-items:center;
        gap:8px
    }
    
    .top-right {
        display:flex;
        gap:8px
    } 
    
    input[type="text"] { 
        padding:6px;
        border:1px solid #ccc;
        border-radius:5px;
        width:200px
    } 
    
    button,a.btn { 
        background:#800000;
        color:white;
        padding:6px 10px;
        border-radius:5px;
        border:none;
        cursor:pointer;
        text-decoration:none
    } 
    
    button:hover,a.btn:hover {
        background:#a52a2a
    } 
    
    table {
        width:100%;
        border-collapse:collapse
    } 
    
    th,td { 
        padding:8px;
        border-bottom:1px solid #ddd;
        text-align:left
    } 
    
    th {
        background:#800000;
        color:#fff
    } 
    
    tr:hover {
        background:#f2f2f2
    } 
    
    a.action-btn {
        background:#800000;
        color:#fff;padding:5px 8px;
        border-radius:5px;
        text-decoration:none
    } 
    
    a.action-btn:hover {
        background:#a52a2a
    } 
    
    .back-btn {
        display:inline-block;
        margin-top:15px;
        text-decoration:none;
        color:#800000;
        font-weight:bold
    }
</style>
</head><body>

<div class="container">
  <h2>Room Records</h2>
  <div class="top-bar">
    <div class="top-left">
      <form method="GET"><input type="text" name="search" placeholder="Search room..." value="<?= htmlspecialchars($search) ?>"><button type="submit">Search</button></form>
      <a href="room_add.php" class="btn">+ Add</a>
    </div>
    <div class="top-right"><a href="room_export_pdf.php" class="btn">Export PDF</a><a href="room_export_excel.php" class="btn">Export Excel</a></div>
  </div>

  <table><thead><tr><th>Room ID</th><th>Building</th><th>Room Code</th><th>Capacity</th><th>Actions</th></tr></thead><tbody>
    <?php if(mysqli_num_rows($result)>0): while($row=mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?= htmlspecialchars($row['room_id']) ?></td>
        <td><?= htmlspecialchars($row['building']) ?></td>
        <td><?= htmlspecialchars($row['room_code']) ?></td>
        <td><?= htmlspecialchars($row['capacity']) ?></td>
        <td>
          <a href="room_edit.php?id=<?= $row['room_id'] ?>" class="action-btn">Edit</a>
          <a href="room.php?delete=<?= $row['room_id'] ?>" class="action-btn" onclick="return confirm('Soft delete this room?')">Delete</a>
        </td>
      </tr>
    <?php } else: ?>
      <tr><td colspan="5" style="text-align:center;">No records found</td></tr>
    <?php endif; ?>
  </tbody></table>
  <a href="../index.php" class="back-btn">Back to Main menu</a>
</div>
</body></html>
