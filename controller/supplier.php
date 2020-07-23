<?php
$sumber = "../data/supplier.json";
$konten = file_get_contents($sumber);
$supplier = json_decode($konten, true);

$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$contact = $_POST['contact'];

if(isset($supplier)) {
    foreach($supplier as $data) {        
        if($data['email'] == $email || $data['contact'] == $contact) {
            $cek = false;
        break;
        } else {
            $last_id = sprintf("%03s", (int)($data['id'] + 1));
            $cek = true;
        }
    }
} else {
    $last_id = "001";
    $cek=true;
}

if($cek) {
    $supplier[] = array('id' => $last_id, 'name' => $name, 'address' => $address, 'email' => $email, 'contact' => $contact);
    file_put_contents($sumber, json_encode($supplier));
    header("location:../layout/home.php?module=mastersupplier&notif=success");
} else {
    header("location:../layout/home.php?module=mastersupplier&notif=failed");
}