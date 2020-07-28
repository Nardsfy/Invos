<?php
$sumber = "../data/transaction.json";
$konten = file_get_contents($sumber);
$transaction = json_decode($konten, true);

$sumber2 = "../data/product.json";
$konten2 = file_get_contents($sumber2);
$product = json_decode($konten2, true);

$sumber3 = "../data/storeroom.json";
$konten3 = file_get_contents($sumber3);
$storeroom = json_decode($konten3, true);

$sumber4 = "../data/unit.json";
$konten4 = file_get_contents($sumber4);
$unit = json_decode($konten4, true);

$report = $_POST['report'];
$arrproduct = [];
$arrstoreroom = [];
$arrunit = [];
$idx = 0;

foreach ($product as $data) {
    array_push($arrproduct, $data['id']);
}

foreach ($storeroom as $data) {
    array_push($arrstoreroom, $data['storeroom']);
}

foreach ($unit as $data) {
    array_push($arrunit, $data['unit']);
}
require('../fpdf/fpdf.php');

if ($report == "Product ID") {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 7, 'REPORT TRANSACTION BY ' . $report);
    // add space
    $pdf->Cell(10, 10, '', 0, 1);
    for ($i = 0; $i < count($arrproduct); $i++) {
        $pdf->SetFont('Arial', 'B', 16);
        //add space
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Cell(50, 6, 'Product ID' . $arrproduct[$idx], 1, 0);
        //add space
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80, 6, 'Transaction ID', 1, 0);
        $pdf->Cell(30, 6, 'Product ID', 1, 0);
        $pdf->Cell(20, 6, 'Quantity', 1, 0);
        $pdf->Cell(20, 6, 'Supplier', 1, 0);
        $pdf->Cell(20, 6, 'Unit', 1, 0);
        $pdf->Cell(30, 6, 'Storeroom', 1, 0);
        $pdf->Cell(40, 6, 'Date', 1, 0);
        $pdf->Cell(20, 6, 'Info', 1, 0);
        $pdf->Ln();
        foreach ($transaction as $data) {
            if ($data['idproduct'] == $arrproduct[$idx]) {
                $pdf->Cell(80, 6, $data['id'], 1, 0);
                $pdf->Cell(30, 6, $data['idproduct'], 1, 0);
                $pdf->Cell(20, 6, $data['quantity'], 1, 0);
                $pdf->Cell(20, 6, $data['supplier'], 1, 0);
                $pdf->Cell(20, 6, $data['unit'], 1, 0);
                $pdf->Cell(30, 6, $data['storeroom'], 1, 0);
                $pdf->Cell(40, 6, $data['date'], 1, 0);
                $pdf->Cell(20, 6, $data['info'], 1, 0);
                $pdf->Ln();
            }
        }
        $idx++;
    }
    $pdf->Output('I', 'report_byproduct.pdf');
} else if ($report == "Storeroom") {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 7, 'REPORT TRANSACTION BY ' . $report);
    // add space
    $pdf->Cell(10, 10, '', 0, 1);
    for ($i = 0; $i < count($arrstoreroom); $i++) {
        $pdf->SetFont('Arial', 'B', 16);
        //add space
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Cell(60, 6, 'Storeroom ' . $arrstoreroom[$idx], 1, 0);
        //add space
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80, 6, 'Transaction ID', 1, 0);
        $pdf->Cell(30, 6, 'Storeroom', 1, 0);
        $pdf->Cell(30, 6, 'Product ID', 1, 0);
        $pdf->Cell(20, 6, 'Quantity', 1, 0);
        $pdf->Cell(20, 6, 'Supplier', 1, 0);
        $pdf->Cell(20, 6, 'Unit', 1, 0);
        $pdf->Cell(40, 6, 'Date', 1, 0);
        $pdf->Cell(20, 6, 'Info', 1, 0);
        $pdf->Ln();
        foreach ($transaction as $data) {
            if ($data['storeroom'] == $arrstoreroom[$idx]) {
                $pdf->Cell(80, 6, $data['id'], 1, 0);
                $pdf->Cell(30, 6, $data['storeroom'], 1, 0);
                $pdf->Cell(30, 6, $data['idproduct'], 1, 0);
                $pdf->Cell(20, 6, $data['quantity'], 1, 0);
                $pdf->Cell(20, 6, $data['supplier'], 1, 0);
                $pdf->Cell(20, 6, $data['unit'], 1, 0);
                $pdf->Cell(40, 6, $data['date'], 1, 0);
                $pdf->Cell(20, 6, $data['info'], 1, 0);
                $pdf->Ln();
            }
        }
        $idx++;
    }
    $pdf->Output('I', 'report_bystoreroom.pdf');
} else if ($report == "Unit") {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 7, 'REPORT TRANSACTION BY ' . $report);
    // add space
    $pdf->Cell(10, 10, '', 0, 1);
    for ($i = 0; $i < count($arrunit); $i++) {
        $pdf->SetFont('Arial', 'B', 16);
        //add space
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Cell(60, 6, 'Unit ' . $arrunit[$idx], 1, 0);
        //add space
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80, 6, 'Transaction ID', 1, 0);
        $pdf->Cell(20, 6, 'Unit', 1, 0);
        $pdf->Cell(30, 6, 'Product ID', 1, 0);
        $pdf->Cell(20, 6, 'Quantity', 1, 0);
        $pdf->Cell(20, 6, 'Supplier', 1, 0);
        $pdf->Cell(30, 6, 'Storeroom', 1, 0);
        $pdf->Cell(40, 6, 'Date', 1, 0);
        $pdf->Cell(20, 6, 'Info', 1, 0);
        $pdf->Ln();
        foreach ($transaction as $data) {
            if ($data['unit'] == $arrunit[$idx]) {
                $pdf->Cell(80, 6, $data['id'], 1, 0);
                $pdf->Cell(20, 6, $data['unit'], 1, 0);
                $pdf->Cell(30, 6, $data['idproduct'], 1, 0);
                $pdf->Cell(20, 6, $data['quantity'], 1, 0);
                $pdf->Cell(20, 6, $data['supplier'], 1, 0);
                $pdf->Cell(30, 6, $data['storeroom'], 1, 0);
                $pdf->Cell(40, 6, $data['date'], 1, 0);
                $pdf->Cell(20, 6, $data['info'], 1, 0);
                $pdf->Ln();
            }
        }
        $idx++;
    }
    $pdf->Output('I', 'report_byunit.pdf');
} else if ($report == "Date") {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 7, 'REPORT TRANSACTION BY ' . $report);
    // add space
    $pdf->Cell(10, 10, '', 0, 1);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(80, 6, 'Transaction ID', 1, 0);
    $pdf->Cell(40, 6, 'Date', 1, 0);
    $pdf->Cell(30, 6, 'Product ID', 1, 0);
    $pdf->Cell(20, 6, 'Quantity', 1, 0);
    $pdf->Cell(20, 6, 'Supplier', 1, 0);
    $pdf->Cell(20, 6, 'Unit', 1, 0);
    $pdf->Cell(30, 6, 'Storeroom', 1, 0);
    $pdf->Cell(20, 6, 'Info', 1, 0);
    $pdf->Ln();
    foreach ($transaction as $data) {
        $pdf->Cell(80, 6, $data['id'], 1, 0);
        $pdf->Cell(40, 6, $data['date'], 1, 0);
        $pdf->Cell(30, 6, $data['idproduct'], 1, 0);
        $pdf->Cell(20, 6, $data['quantity'], 1, 0);
        $pdf->Cell(20, 6, $data['supplier'], 1, 0);
        $pdf->Cell(20, 6, $data['unit'], 1, 0);
        $pdf->Cell(30, 6, $data['storeroom'], 1, 0);
        $pdf->Cell(20, 6, $data['info'], 1, 0);
        $pdf->Ln();
    }
    $pdf->Output('I', 'report_bydate.pdf');
}
