<?php
$sumber = "../data/storeroom.json";
$konten = file_get_contents($sumber);
$storeroom = json_decode($konten, true);

$name = $_POST['storeroom'];
$last_id = "001";
$cek = false;

if(isset($storeroom)) {
    foreach($storeroom as $data) {
        if($data['storeroom'] == $name) {            
            $cek = false;
        break;
        } else {
            $last_id = sprintf('%03s',((int)$data['id']+1));            
            $cek = true;
        }
    }
} else {    
    $cek=true;
}

if($cek) {    
    $storeroom[] = array('id' => $last_id, 'storeroom' => $name);
    file_put_contents($sumber, json_encode($storeroom));
    header("location:../layout/adminhome.php?module=masterstoreroom&notif=success");
} else {    
    header("location:../layout/adminhome.php?module=masterstoreroom&notif=failed");
}
