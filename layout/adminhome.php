<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

//get data product
$sumber = "../data/product.json";
$konten = file_get_contents($sumber);
$product = json_decode($konten, true);

//get data supplier
$sumber2 = "../data/supplier.json";
$konten2 = file_get_contents($sumber2);
$supplier = json_decode($konten2, true);

//get data storeroom
$sumber3 = "../data/storeroom.json";
$konten3 = file_get_contents($sumber3);
$storeroom = json_decode($konten3, true);

//get data unit
$sumber4 = "../data/unit.json";
$konten4 = file_get_contents($sumber4);
$unit = json_decode($konten4, true);

//get data transaction
$sumber5 = "../data/transaction.json";
$konten5 = file_get_contents($sumber5);
$transaction = json_decode($konten5, true);

//get data temptransaction
$sumber6 = "../data/temptransaction.json";
$konten6 = file_get_contents($sumber6);
$temptransaction = json_decode($konten6, true);


//delete same name data transaction
$new_transaction = array();
$exists = array();
if (isset($transaction)) {
    foreach ($transaction as $element) {
        if (!in_array($element['id'], $exists)) {
            $new_transaction[] = $element;
            $exists[] = $element['id'];
        }
    }
}

$module = isset($_GET['module']) ? $_GET['module'] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOS</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="../style/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light">
        <!-- Brand/logo -->
        <div class="navbar-brand">
            <img class="invos" src="../icon/invos.png">INVOS
        </div>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="masterNavbar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Master
                </a>
                <div class="dropdown-menu" aria-labelledby="masterNavbar">
                    <a class="dropdown-item" href="adminhome.php?module=masterunit">Unit</a>
                    <a class="dropdown-item" href="adminhome.php?module=masterstoreroom">Storeroom</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="viewNavbar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    View
                </a>
                <div class="dropdown-menu" aria-labelledby="viewNavbar">
                    <a class="dropdown-item" href="adminhome.php?module=viewunit">Unit</a>
                    <a class="dropdown-item" href="adminhome.php?module=viewstoreroom">Storeroom</a>
                    <a class="dropdown-item" href="adminhome.php?module=viewproduct">Product</a>
                    <a class="dropdown-item" href="adminhome.php?module=viewsupplier">Supplier</a>
                    <a class="dropdown-item" href="adminhome.php?module=viewstock">Stock</a>
                    <a class="dropdown-item" href="adminhome.php?module=history">History</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, <?= $_SESSION['username'] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="profile">
                    <a class="dropdown-item" href="../controller/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="container content">
        <div class="row d-flex justify-content-center">
            <?php
            $file = "../module/admin/$module.php";
            if (file_exists($file)) {
                include($file);
            } else {
                echo "No module selected!";
            }
            ?>
        </div>
    </div>
</body>

</html>