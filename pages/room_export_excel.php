<?php
require_once __DIR__ . '/../config/db_connect.php';
define('FPDF_FONTPATH', __DIR__ . '/../lib/fpdf/font/');
require_once __DIR__ . '/../lib/fpdf/fpdf.php';

// Fetch rows
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$search_sql = '';
if ($search !== '') {
    $s = '%' . $conn->real_escape_string($search) . '%';
    $search_sql = " AND (room_id LIKE '$s' OR building LIKE '$s' OR room_code LIKE '$s' OR capacity LIKE '$s')";
}
$sql = "SELECT * FROM tblroom WHERE deleted_at IS NULL $search_sql ORDER BY room_id DESC";
$res = $conn->query($sql);

// FPDF setup
class PDF extends FPDF {

    // Header
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->SetTextColor(128,0,0);
        $this->Cell(0,6,'Polytechnic University of the Philippines - Taguig Campus',0,1,'C');
        $this->Ln(2);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(200,200,200);
        // Column headings
        $this->Cell(40,8,'Room ID',1,0,'C',true);
        $this->Cell(35,8,'Building',1,0,'C',true);
        $this->Cell(35,8,'Room Code',1,0,'C',true);
        $this->Cell(50,8,'Capacity',1,1,'C',true); // note the last cell ends line
    }

    // Footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,6,'Printed: '.date('Y-m-d H:i').'    Page '.$this->PageNo().'/{nb}',0,0,'R');
    }
}

// Create PDF
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,20);
$pdf->AddPage();
$pdf->SetFont('Arial','',9); // smaller font to fit longer text

if ($res && $res->num_rows > 0) {
    while ($r = $res->fetch_assoc()) {
        $pdf->Cell(40,7,$r['room_id'],1,0); 
        $pdf->Cell(35,7,$r['building'],1,0);      
        $pdf->Cell(35,7,$r['room_code'],1,0);      
        $pdf->Cell(50,7,$r['capacity'],1,1); // end line
    }
} else {
    $pdf->Cell(0,8,'No records found.',1,1,'C');
}

// Output as download
$filename = 'room_' . date('Ymd_His') . '.pdf';
$pdf->Output('D', $filename);
exit;
