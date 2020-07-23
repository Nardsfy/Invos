<div class="col-md-5">
    <div class="title-content">
        <h3>MASTER STOREROOM</h3>
    </div>

    <!-- notification -->
    <?php 
    $status = isset($_GET['notif']) ? $_GET['notif'] : false;
    if ($status == "success") { ?>
        <div class="alert alert-success" role="alert">
            Storeroom successfully added.
        </div>
    <?php } else if($status == "failed") { ?>
        <div class="alert alert-danger" role="alert">
            Storeroom already exists.
        </div>
    <?php } ?>

    <form action="../controller/storeroom.php" method="POST">
        <div class="form-group master-form">
            <label>Storeroom</label>
            <input type="text" name="storeroom" class="form-control" placeholder="Storeroom" required>
        </div>        
        <div class="form-group d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="ADD STOREROOM">
        </div>
    </form>
</div>