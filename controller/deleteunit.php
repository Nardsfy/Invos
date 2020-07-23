<?php
$sumber = "../data/unit.json";
$konten = file_get_contents($sumber);
$unit = json_decode($konten, true);

$id = $_POST['idDelete'];

if (isset($id)) {
    //get array index 
    $index = array();
    foreach ($unit as $key => $data) {
        if ($data['id'] == $id) {
            $index[] = $key;
        }
    }

    //delete data
    foreach ($index as $idx) {
        unset($unit[$idx]);
    }

    //rebase array
    $unit = array_values($unit);

    file_put_contents($sumber, json_encode($unit));
    header("location:../layout/adminhome.php?module=viewunit&notif=deletesuccess");
} else {
    header("location:../layout/adminhome.php?module=viewunit&notif=deletefailed");
}
