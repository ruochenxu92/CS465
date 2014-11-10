<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/7/14
 * Time: 11:55 PM
 */
    require('fpdf.php');

class PDF extends FPDF {
    var $col = 0;
    var $y0;

    function Header() {
        //Page header
        global $title;

        $this -> SetFont('Arial', 'B', 15);
        $w = $this->GetStringWidth($title) + 6;

        $this -> SetX((210 - $w) / 2);
        $this -> SetDrawColor(0, 80, 180);
        $this -> SetFillColor(230, 230, 0);
        $this -> SetTextColor(220, 50, 50);
        $this -> SetLineWidth(1);
        $this -> Cell($w, 9, $title, 1, 1, 'C', true);
        $this -> Ln(10);
        //Save ordinate
        $this -> y0 = $this -> GetY();
    }

    function Footer() {
        //Page footer
        $this -> SetY(-15);
        $this -> SetFont('Arial', 'I', 14);
        $this -> SetTextColor(128);
        $this -> Cell(0, 10, 'Page '.$this->PageNo(), 0, 0, 'C');
    }

    function SetCol($col) {
        // Set position at a given column
        $this -> col = $col;
        $x = 10 + $col * 65;
        $this -> SetLeftMargin($x);
        $this -> SetX($x);
    }

    function AcceptPageBreak() {
        //Method accepting or not automatic page break
        if ($this -> col < 2) {
            //Go to next column
            $this -> SetCol($this -> col + 1);
            //Set ordinate to top
            $this -> SetY($this->y0);
            //keep on page
            return false;
        } else {
            //Go back to first column
            $this->SetCol(0);
            //Page break
            return true;
        }
    }

    function ChapterTitle($num, $label) {
        //Title
        $this -> SetFont('Arial', '', 12);
        $this -> SetFillColor(200, 220, 255);
        $this -> Cell(0, 6, 'Chapter '.$num. ' : '. $label, 0, 1, 'L ', true, 'google.com');
    }

}


    //Instansication of inherited class
    $pdf = new PDF();
    $pdf -> title = 'Xiaomin Xu';

    $pdf -> AliasNbPages();

    $pdf -> AddPage();

    $pdf -> SetFont('Times', '', 12);

    for ($i = 1; $i <= 40; $i++) {
        $pdf -> Cell(0, 10, 'Printing line number '.$i, 0, 1);
    }

    $pdf -> Output();





?>


