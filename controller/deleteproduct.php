<?php
$sumber = "../data/product.json";
$konten = file_get_contents($sumber);
$product = json_decode($konten, true);

$id = $_POST['idDelete'];

if (isset($id)) {
    //get array index 
    $index = array();
    foreach ($product as $key => $data) {
        if ($data['id'] == $id) {
            $index[] = $key;
        }
    }

    //delete data
    foreach ($index as $idx) {
        unset($product[$idx]);
    }

    //rebase array
    $product = array_values($product);

    file_put_contents($sumber, json_encode($product));
    header("location:../layout/home.php?module=viewproduct&notif=deletesuccess");
} else {
    header("location:../layout/home.php?module=viewproduct&notif=deletefailed");
}
