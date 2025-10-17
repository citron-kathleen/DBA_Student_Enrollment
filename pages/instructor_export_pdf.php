<?php
// student_export_pdf.php
// Generates PDF of tblstudent with header "Polytechnic University of the Philippines - Taguig Campus"

require_once __DIR__ . '/../config/db_connect.php';
define('FPDF_FONTPATH', __DIR__ . '/../lib/fpdf/font/');
require_once __DIR__ . '/../lib/fpdf/fpdf.php';
 // make sure FPDF is here

// Fetch rows
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$search_sql = '';
if ($search !== '') {
    $s = '%' . $conn->real_escape_string($search) . '%';
    $search_sql = " AND (instructor_id LIKE '$s' OR last_name LIKE '$s' OR first_name LIKE '$s' OR email LIKE '$s')";
}
$sql = "SELECT * FROM tblinstructor WHERE deleted_at IS NULL $search_sql ORDER BY instructor_id DESC";
$res = $conn->query($sql);

// FPDF setup
class PDF extends FPDF {
    // header
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->SetTextColor(128,0,0);
        $this->Cell(0,6,'Polytechnic University of the Philippines - Taguig Campus',0,1,'C');
        $this->Ln(2);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(200,200,200);
        // Column headings with adjusted widths
        $this->Cell(40,8,'Instructor ID',1,0,'C',true);
        $this->Cell(35,8,'Last Name',1,0,'C',true);
        $this->Cell(35,8,'First Name',1,0,'C',true);
        $this->Cell(50,8,'Email',1,0,'C',true);
        $this->Cell(30,8,'Dept ID',1,1,'C',true);
    }

    // footer with page number
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,6,'Printed: '.date('Y-m-d H:i').'    Page '.$this->PageNo().'/{nb}',0,1,'R');
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,20);
$pdf->AddPage();
$pdf->SetFont('Arial','',9); // smaller font to fit longer text

if ($res && $res->num_rows > 0) {
    while ($r = $res->fetch_assoc()) {
        $instructor_id = $r['instructor_id'];
        $last = $r['last_name'];
        $first = $r['first_name'];
        $email = $r['email'];
        $dept_id = $r['dept_id'];

        // Adjusted column widths to prevent overflow
        $pdf->Cell(40,7,$instructor_id,1,0); // instructor No wider
        $pdf->Cell(35,7,$last,1,0);       // Last Name slightly smaller
        $pdf->Cell(35,7,$first,1,0);      // First Name slightly smaller
        $pdf->Cell(50,7,$email,1,0);      // Email
        $pdf->Cell(30,7,$dept_id,1,1);      // dept_id
    }
} else {
    $pdf->Cell(0,8,'No records found.',1,1,'C');
}

// Output as download
$filename = 'instructors_' . date('Ymd_His') . '.pdf';
$pdf->Output('D', $filename);
exit;