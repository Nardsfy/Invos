<?php
$sumber = "../data/storeroom.json";
$konten = file_get_contents($sumber);
$storeroom = json_decode($konten, true);

$id = $_POST['id'];
$name = $_POST['name'];
$cek = false;

foreach($storeroom as $key => $data) {
    if($id == $data['id']) {
        $storeroom[$key]['storeroom'] = $name;
        $cek = true;
    }
}

if($cek) {
    file_put_contents($sumber, json_encode($storeroom));
    header("location:../layout/adminhome.php?module=viewstoreroom&notif=success");
} else {
    header("location:../layout/adminhome.php?module=viewstoreroom&notif=failed");
}