<?php
require_once('fpdf.php');
require_once('fpdi.php');

// initiate FPDI
$pdf = new FPDI();
for ($i = 0; $i < 30; $i++) {

// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile("travel.pdf");
// import page 1
$tplIdx = $pdf->importPage(2);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 0, 0, 200, 300);

// now write some text above the imported page

    $pdf->SetFont('Helvetica');
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetXY(30, 30);
    $pdf->Write(0, 'This is just a simple text');
    $pdf->Ln(10);
}

$pdf->Output();