<?php
$sumber = "../data/supplier.json";
$konten = file_get_contents($sumber);
$supplier = json_decode($konten, true);

$id = $_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$cek = false;

foreach($supplier as $key => $data) {
    if($id == $data['id']) {
        $supplier[$key]['name'] = $name;
        $supplier[$key]['address'] = $address;
        $supplier[$key]['email'] = $email;
        $supplier[$key]['contact'] = $contact;
        $cek=true;
    }
}

if($cek) {
    file_put_contents($sumber, json_encode($supplier));
    header("location:../layout/home.php?module=viewsupplier&notif=success");
} else {
    header("location:../layout/home.php?module=viewsupplier&notif=failed");
}