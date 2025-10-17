<?php
require_once __DIR__ . '/../lib/fpdf/fpdf.php';
include '../config/db_connect.php';

class PDF extends FPDF {
  function Header(){
    $this->SetFont('Arial','B',12);
    $this->SetTextColor(128,0,0);
    $this->Cell(0,6,'Polytechnic University of the Philippines - Taguig Campus',0,1,'C');
    $this->Ln(2);
    $this->SetFont('Arial','B',10);
    $this->SetTextColor(0,0,0);
    $this->SetFillColor(200,200,200);
    $this->Cell(30,8,'Enrollment ID',1,0,'C',true);
    $this->Cell(30,8,'Student ID',1,0,'C',true);
    $this->Cell(30,8,'Section ID',1,0,'C',true);
    $this->Cell(35,8,'Date Enrolled',1,0,'C',true);
    $this->Cell(25,8,'Status',1,0,'C',true);
    $this->Cell(30,8,'Letter Grade',1,1,'C',true);
  }
  function Footer(){
    $this->SetY(-15); $this->SetFont('Arial','I',8);
    $this->Cell(0,6,'Printed: '.date('Y-m-d H:i').'    Page '.$this->PageNo().'/{nb}',0,1,'R');
  }
}

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);

$res = mysqli_query($conn, "SELECT * FROM tblenrollment WHERE deleted_at IS NULL ORDER BY enrollment_id ASC");
while($r = mysqli_fetch_assoc($res)){
  $pdf->Cell(30,7,$r['enrollment_id'],1,0,'C');
  $pdf->Cell(30,7,$r['student_id'],1,0,'C');
  $pdf->Cell(30,7,$r['section_id'],1,0,'C');
  $pdf->Cell(35,7,$r['date_enrolled'],1,0,'C');
  $pdf->Cell(25,7,$r['status'],1,0,'C');
  $pdf->Cell(30,7,$r['letter_grade'],1,1,'C');
}
$pdf->Output('D','Enrollment_Records.pdf');
exit;
?>
