<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/7/14
 * Time: 11:35 PM
 */


require('fpdf.php');

class PDF extends FPDF
{
    function Head()
    {
        global $title;
        //Arial bold 15
        $this->SetFont('Arial', 'B', 15);

        //calculate width of title and position
        $width = $this->GetStringWidth($title) + 6;
        $this->SetX((210 - $width) / 2);
        $this->SetDrawColor(0, 80, 100);
        $this->SetFillColor(230, 230, 0);
        $this->SetTextColor(220, 50, 50);

        //Thickness of frame (1 mm)
        $this->Cell($width, 9, $title, 1, 1, 'c', true);
        $this->Ln(10);
    }


    function Footer()
    {
        //Position at 15mm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Text color in gray
        $this->SetTextColor(128);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'c');
    }

    function ChapterTitle($num, $label)
    {
        //Arial 12
        $this->SetFont('Arial', '', 12);
        //background color
        $this->SetFillColor(200, 220, 255);
        //Title
        $this->Cell(0, 6, 'Chapter '.$num.' : '.$label, 0, 1, 'L ', true);
        //Line break;
        $this->Ln(4);
    }

    function ChapterBody($file)
    {
        //read text file
        $txt = file_get_contents($file);
        //Times 12
        $this->SetFont('Times', '', 12);
        //Output justified tet
        $this->MultiCell(0, 5, $txt);
        //Line Break
        $this->Ln();
        //Mention in italics
        $this->SetFont('', 'I');
        $this->Cell(0, 5, '(end of excerpt)');
    }

    function PrintChapter($num, $title, $file)
    {
        $this->AddPage();
        $this->Chaptertitle($num, $title);
        $this->ChapterBody($file);
    }
}



    $pdf = new PDF();
    $title = '20000 Leagues under the Seas';
    $pdf -> SetTitle($title);
    $pdf -> SetAuthor('Xiaomin');
    $pdf -> PrintChapter(1, 'University of Illinois at Urbana-Champaign', '20k_c1.txt');
    $pdf -> PrintChapter(2, 'University of Washington at Seattle', '20k_c2.txt');


    $pdf -> Output();
?>