<?php
$sumber = "../data/temptransaction.json";
$konten = file_get_contents($sumber);
$temptransaction = json_decode($konten, true);

$idtemp = $_GET['idtemp'];

//get array index 
$index = array();
foreach ($temptransaction as $key => $data) {
    if ($data['idtemp'] == $idtemp) {
        $index[] = $key;
    }
}

//delete data
foreach ($index as $idx) {
    unset($temptransaction[$idx]);
}

//rebase array
$temptransaction = array_values($temptransaction);

file_put_contents($sumber, json_encode($temptransaction));
header("location:../layout/home.php?module=transaction&notif=delcartsuccess");
