<?php
$sumber = "../data/unit.json";
$konten = file_get_contents($sumber);
$unit = json_decode($konten, true);

$name = $_POST['unit'];
$last_id = "001";
$cek = false;

if(isset($unit)) {
    foreach($unit as $data) {
        if($data['unit'] == $name) {            
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
    $unit[] = array('id' => $last_id, 'unit' => $name);
    file_put_contents($sumber, json_encode($unit));
    header("location:../layout/adminhome.php?module=masterunit&notif=success");
} else {    
    header("location:../layout/adminhome.php?module=masterunit&notif=failed");
}
