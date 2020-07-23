<?php
$sumber = "../data/storeroom.json";
$konten = file_get_contents($sumber);
$storeroom = json_decode($konten, true);

$id = $_POST['idDelete'];

if (isset($id)) {
    //get array index 
    $index = array();
    foreach ($storeroom as $key => $data) {
        if ($data['id'] == $id) {
            $index[] = $key;
        }
    }

    //delete data
    foreach ($index as $idx) {
        unset($storeroom[$idx]);
    }

    //rebase array
    $storeroom = array_values($storeroom);

    file_put_contents($sumber, json_encode($storeroom));
    header("location:../layout/adminhome.php?module=viewstoreroom&notif=deletesuccess");
} else {
    header("location:../layout/adminhome.php?module=viewstoreroom&notif=deletefailed");
}
