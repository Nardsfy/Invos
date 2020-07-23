<?php 
$sumber = "../data/temptransaction.json";
$konten = file_get_contents($sumber);
$temptransaction = json_decode($konten, true);

$sumber2 = "../data/transaction.json";
$konten2 = file_get_contents($sumber2);
$transaction = json_decode($konten2, true);

$uniqid = uniqid(rand(), true);
date_default_timezone_set("Asia/Jakarta");
$date = date("d M Y, H:i");

foreach ($temptransaction as $key => $data) {
    $idproduct = $data['idproduct'];
    $quantity = $data['quantity'];
    $supplier = $data['supplier'];
    $unit = $data['unit'];
    $storeroom = $data['storeroom'];        
    $info = $data['info'];

    $transaction[] = array('id' => $uniqid, 'idproduct' => $idproduct, 'quantity' => $quantity, 'supplier' => $storeroom, 'supplier' => $supplier, 'unit' => $unit, 'storeroom' => $storeroom, 'date' => $date, 'info' => $info);
    file_put_contents($sumber2, json_encode($transaction));
}

foreach ($temptransaction as $key => $data) {
    unset($temptransaction[$key]);
}   

$temptransaction = array_values($temptransaction);
file_put_contents($sumber, json_encode($temptransaction));
header("location:../layout/home.php?module=transaction&notif=success");