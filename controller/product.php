<?php
$sumber = "../data/product.json";
$konten = file_get_contents($sumber);
$product = json_decode($konten, true);

$id = $_POST['id'];
$name = $_POST['name'];
$cek = false;

if(isset($product)) {
    foreach($product as $data) {
        if($data['id'] == $id || $data['name'] == $name) {
            $cek = false;
        break;
        } else {
            $cek = true;
        }
    }
} else {
    $cek=true;
}

if($cek) {
    $product[] = array('id' => $id, 'name' => $name);
    file_put_contents($sumber, json_encode($product));
    header("location:../layout/home.php?module=masterproduct&notif=success");
} else {
    header("location:../layout/home.php?module=masterproduct&notif=failed");
}
