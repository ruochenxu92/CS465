<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/8/14
 * Time: 12:15 AM
 */

    require('fpdf.php');

class PDF extends FPDF {
    //load data
    function LoadData($file) {
        //Read file lines
        $lines = file ($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', trim($line));
        }
        return $data;
    }

    //Simple table
    function BasicTable($header, $data) {
        //Header
        foreach($header as $col) {
            $this -> Cell(40, 7, $col, 1);
        }
        $this -> Ln();
        //Data
        foreach($data as $row) {
            foreach ($row as $col) {
                $this -> Cell(40, 6, $col, 1);
            }
            $this -> Ln();// /n
        }
    }

    //Better table
    function ImprovedTable($header, $data) {
        //Column widths
        $w = array(40, 35, 40, 45);
        //Header
        for ($i = 0; $i < count($header); $i++) {
            $this -> Cell($w[$i], 7, $header[$i], 1, 0, 'c');
        }
        $this -> Ln();
        //Data is 2-D array
        foreach($data as $row) {
            $this -> Cell($w[0], 6, $row[0], 'LR');
            $this -> Cell($w[1], 6, $row[1], 'LR');
            $this -> Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this -> Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this -> Ln();
        }
        //Closing line
        $this -> Cell(array_sum($w), 0, '', 'T');
    }

    //Colored table
    function FancyTable($header, $data) {
        //colors, line width and bold font
        $this -> SetFillColor(182, 105, 255);
        $this -> SetTextColor(255);
        $this -> SetDrawColor(128, 0, 0);
        $this -> SetLineWidth(.3);
        $this -> SetFont('', 'B');
        //Header
        $w = array(40, 35, 40, 45);
        for($i = 0; $i < count($header); $i++) {
            $this -> Cell($w[$i], 7, $header[$i], 1, 0, 'c', true);
        }
        $this -> Ln();
        //Color and font restoration
        $this -> SetFillColor(224, 235, 255);
        $this -> SetTextColor(0);//black
        $this -> SetFont('');//default
        //Data
        $fill = false;
        foreach ($data as $row) {
            $this -> Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this -> Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this -> Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this -> Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this -> Ln();
            $fill = !$fill;
        }
        $this -> Cell(array_sum($w), 0, '', 'T');
    }
}

    $pdf = new PDF();
    //Column headings
    $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands');
    //Data loading
    $data = $pdf -> LoadData('countries.txt');
    $pdf -> SetFont('Arial', '', 14);

    $pdf -> AddPage();
    $pdf -> BasicTable($header, $data);

    $pdf -> AddPage();
    $pdf -> ImprovedTable($header, $data);

    $pdf -> AddPage();
    $pdf -> FancyTable($header, $data);

    $pdf -> Output();

?>


