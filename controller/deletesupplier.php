<?php
$sumber = "../data/supplier.json";
$konten = file_get_contents($sumber);
$supplier = json_decode($konten, true);

$id = $_POST['idDelete'];

if (isset($id)) {
    //get array index 
    $index = array();
    foreach ($supplier as $key => $data) {
        if ($data['id'] == $id) {
            $index[] = $key;
        }
    }

    //delete data
    foreach ($index as $idx) {
        unset($supplier[$idx]);
    }

    //rebase array
    $supplier = array_values($supplier);

    file_put_contents($sumber, json_encode($supplier));
    header("location:../layout/home.php?module=viewsupplier&notif=deletesuccess");
} else {
    header("location:../layout/home.php?module=viewsupplier&notif=deletefailed");
}
