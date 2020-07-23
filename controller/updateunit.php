<?php
$sumber = "../data/unit.json";
$konten = file_get_contents($sumber);
$unit = json_decode($konten, true);

$id = $_POST['id'];
$name = $_POST['name'];
$cek = false;

foreach($unit as $key => $data) {
    if($id == $data['id']) {
        $unit[$key]['unit'] = $name;
        $cek = true;
    }
}

if($cek) {
    file_put_contents($sumber, json_encode($unit));
    header("location:../layout/adminhome.php?module=viewunit&notif=success");
} else {
    header("location:../layout/adminhome.php?module=viewunit&notif=failed");
}