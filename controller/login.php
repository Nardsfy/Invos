<?php
//get data user json
$sumber = "../data/user.json";
$konten = file_get_contents($sumber);
$data = json_decode($konten, true);

$username = $_POST['username'];
$password = $_POST['password'];
$cek = false;

session_start();

foreach ($data as $dt) {
    if ($dt['username'] == $username && $dt['password'] == $password) {
        $status = $dt['status'];
        $cek = true;
    break;
    } else {
        $cek = false;
    }
}

if($cek) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['status'] = $status;
    if($status == "user") {        
        header("location:../layout/home.php?module=viewproduct");
    } else if($status == "admin") {
        header("location:../layout/adminhome.php?module=viewproduct");
    }
} else {
    header("location:../layout/login.php?notif=error");
}
