<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$db, 3306);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";


    $sql = "select * from comment";
    $result = $conn->query($sql);
   // var_dump($result);




/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 11/8/14
 * Time: 1:56 AM
 */
//
//require('fpdf.php');
//
//
//$pdf = new PDF();
//$pdf->AddPage();
//$pdf->SetFont('Arial', '', 10);
//$pdf->Image('logo2.png', 10, 8,  10, 13, 'PNG');
//$pdf->Cell(18, 10, '', 0);
//$pdf->Cell(150, 10, 'Xiaomin Xu', 0);
//$pdf->SetFont('Arial', '', 9);
//$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
//$pdf->Ln(15);
//$pdf->SetFont('Arial', 'B', 11);
//$pdf->Cell(70, 8, '', 0);
//$pdf->Cell(100, 8, 'Beijing', 0);
//$pdf->Ln(8);
//$pdf->Ln(15);
//$pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(15, 8, 'Item', 1);
//$pdf->Cell(80, 8, 'Name', 1);
//$pdf->Cell(40, 8, 'City', 1);
//$pdf->Cell(25, 8, 'Code', 1);
//$pdf->Cell(25, 8, 'Code', 1);
//$pdf->Ln(8);
//$pdf->SetFont('Arial', '', 8);
////Consult Ta
//$products = mysql_query("SELECT * FROM PRODUCTS");
//$item = 0;
//while ($product = mysql_fetch_array($products)) {
//    $item = $item + 1;
//    $pdf->Cell(15, 8, $item, 0);
//    $pdf->Cell(80, 8, $product[''], 0);
//    $pdf->Cell(15, 8, $product[''], 0);
//    $pdf->Cell(15, 8, $product[''], 0);
//    $pdf->Cell(15, 8, $product[''], 0);
//    $pdf->Ln(8);
//}
//
//$pdf -> Output();
//

?>


