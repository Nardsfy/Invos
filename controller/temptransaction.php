<?php
$sumber = "../data/temptransaction.json";
$konten = file_get_contents($sumber);
$temptransaction = json_decode($konten, true);

$sumber2 = "../data/transaction.json";
$konten2 = file_get_contents($sumber2);
$transaction = json_decode($konten2, true);

$idTemp = uniqid(rand(), true);
$totalQt = 0;

if ($_POST['quantity'] == "" && $_POST['quantityOut'] == "") {    
    header("location:../layout/home.php?module=transaction&notif=empty");
} else if ((int)$_POST['quantity'] < 1 && (int)$_POST['quantityOut'] < 1) {
    header("location:../layout/home.php?module=transaction&notif=min");
} else {
    if (isset($_POST['btnTransaction-in'])) {
        
        $id = $_POST['id'];
        $quantity = (int)$_POST['quantity'];
        $supplier = $_POST['supplier'];
        $unit = $_POST['unit'];
        $storeroom = $_POST['storeroom'];
        $info = $_POST['info'];

        $temptransaction[] = array('idtemp' => $idTemp, 'idproduct' => $id, 'quantity' => $quantity, 'supplier' => $supplier, 'unit' => $unit, 'storeroom' => $storeroom, 'info' => $info);
        file_put_contents($sumber, json_encode($temptransaction));
        header("location:../layout/home.php?module=transaction&addmore=ok");
    } else if (isset($_POST['btnTransaction-out'])) {
        $id = $_POST['idOut'];
        $quantity = $_POST['quantityOut'];
        $unit = $_POST['unitOut'];
        $storeroom = $_POST['storeroomOut'];
        $info = $_POST['infoOut'];

        foreach($transaction as $data) {
            if($data['idproduct'] == $id && $data['storeroom'] == $storeroom && $data['unit'] == $unit) {
                $totalQt += $data['quantity'];                            
            }            
        }

        if($quantity > $totalQt) {
            header("location:../layout/home.php?module=transaction&notif=quantity");
        } else {
            $temptransaction[] = array('idtemp' => $idTemp, 'idproduct' => $id, 'quantity' => $quantity * -1, 'supplier' => "-", 'unit' => $unit, 'storeroom' => $storeroom, 'info' => $info);
            file_put_contents($sumber, json_encode($temptransaction));
            header("location:../layout/home.php?module=transaction&addmore=ok");
        }            
    }
}