<?php
// student_export_pdf.php

require_once __DIR__ . '/../config/db_connect.php';
define('FPDF_FONTPATH', __DIR__ . '/../lib/fpdf/font/');
require_once __DIR__ . '/../lib/fpdf/fpdf.php';

// Fetch rows
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$search_sql = '';
if ($search !== '') {
    $s = '%' . $conn->real_escape_string($search) . '%';
    $search_sql = " AND (course_id LIKE '$s' OR course_code LIKE '$s' OR course_title LIKE '$s' OR dept_id LIKE '$s')";
}
$sql = "SELECT * FROM tblcourse WHERE deleted_at IS NULL $search_sql ORDER BY course_id DESC";
$res = $conn->query($sql);

// FPDF setup
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->SetTextColor(128,0,0);
        $this->Cell(0,6,'Polytechnic University of the Philippines - Taguig Campus',0,1,'C');
        $this->Ln(2);

        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(200,200,200);

        // Adjusted column widths to fit A4
        $this->Cell(25,8,'Course ID',1,0,'C',true);
        $this->Cell(35,8,'Course Code',1,0,'C',true);
        $this->Cell(50,8,'Course Title',1,0,'C',true);
        $this->Cell(15,8,'Units',1,0,'C',true);
        $this->Cell(20,8,'Lecture Hrs',1,0,'C',true);
        $this->Cell(20,8,'Lab Hrs',1,0,'C',true);
        $this->Cell(25,8,'Dept ID',1,1,'C',true);
    }

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
$pdf->SetFont('Arial','',9);

if ($res && $res->num_rows > 0) {
    while ($r = $res->fetch_assoc()) {
        $pdf->Cell(25,7,$r['course_id'],1,0,'C');
        $pdf->Cell(35,7,$r['course_code'],1,0,'C');
        $pdf->Cell(50,7,$r['course_title'],1,0,'L'); // left-align long text
        $pdf->Cell(15,7,$r['units'],1,0,'C');
        $pdf->Cell(20,7,$r['lecture_hours'],1,0,'C');
        $pdf->Cell(20,7,$r['lab_hours'],1,0,'C');
        $pdf->Cell(25,7,$r['dept_id'],1,1,'C');
    }
} else {
    $pdf->Cell(0,8,'No records found.',1,1,'C');
}

$filename = 'course_' . date('Ymd_His') . '.pdf';
$pdf->Output('D', $filename);
exit;
