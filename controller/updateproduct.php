<?php
$sumber = "../data/product.json";
$konten = file_get_contents($sumber);
$product = json_decode($konten, true);

$id = $_POST['id'];
$name = $_POST['name'];
$cek = false;

foreach($product as $key => $data) {
    if($id == $data['id']) {
        $product[$key]['name'] = $name;
        $cek = true;
    }
}

if($cek) {
    file_put_contents($sumber, json_encode($product));
    header("location:../layout/home.php?module=viewproduct&notif=success");
} else {
    header("location:../layout/home.php?module=viewproduct&notif=failed");
}