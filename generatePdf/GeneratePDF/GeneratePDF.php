<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/7/14
 * Time: 10:58 PM
 */
    require('fpdf.php');
    $pdf = new FPDF();
//    $pdf->AddPage();
//    $pdf->setFont('Arial', 'B', 16);
//    $pdf->Cell(40, 40, 'Xiaomin Xu');
//    $pdf->Cell(40, 40, 'Hello World!');
//    $pdf->Ln();
//    $pdf->Cell(40, 10, 'Hello World!');
//    $pdf->Cell(40, 10, 'Hello World!');
//    $pdf->Output();


class PDF extends FPDF {

    function Header() {
            //Logo
            $this->Image('logo2.png', 0, 0, 100);
            $this->SetFont('Arial', 'B', 30);
            $this->Cell(70);
            $this->Cell(0, 30, "Iterations", 0, 0, 'c');//c = center
            $this->Ln(20);
        }


        function Footer() {
            // Position at 1.5cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 12);
            //page number
            $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 2, 'c');
        }
    }


    $user = $_GET['user'];

    $pdf = new PDF();

    $pdf->AliasNbPages();

    $pdf->AddPage();

    $pdf->SetFont('Times', 'BI', 15);
//    $pdf->SetFillColor(182, 105, 255);
//    $pdf -> SetDrawColor(128, 0, 0);


    $day = [1, 2, 3, 4, 5];

    $city = ['New York City', 'San Francisco', 'Las Vegas', 'Los Angeles', 'Washington D.C.'];

    $pdf->Cell(0, 10, "Hello, ".$user, 0, 1);
    $pdf->Cell(0, 10, "     Your iterations are already generated as below:", 0, 1);



    $i = 1;
    $distance = "100 miles";
    $duration = "1 hours 10 min";

    foreach ($day as $d) {
        $pdf->SetTextColor(182, 105, 255);

        $pdf->Cell(0, 10, "               Day".$d, 0, 1);
        $pdf->Cell(0, 10, "                         Distance = ".$distance,0, 1);//0 stands for border, 1 stands for new line
            $pdf->Cell(0, 10, "                         Duration = ".$duration,0, 1);//0 stands for border, 1 stands for new line

        foreach($city as $c){
            $pdf->Cell(0, 10, "                         ".$c, 0, 1);//city information
        }

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        if ($i % 2 == 0) {
            $pdf->SetTextColor(0, 0, 0);

            $pdf->AddPage();
        }
        $pdf->SetTextColor(182, 105, 255);
        $i++;

    }
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Cell(0, 10, "               Thanks for your support!", 0, 1, 'R');
    $pdf->Cell(0, 10, "               GoTrip Team", 0, 1, 'R');
    $pdf->Cell(0, 10, "               Nov, 14, 2014", 0, 1, 'R');

    $pdf->Output();
?>



