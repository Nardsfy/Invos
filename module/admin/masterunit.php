<div class="col-md-5">
    <div class="title-content">
        <h3>MASTER UNIT</h3>
    </div>

    <!-- notification -->
    <?php 
    $status = isset($_GET['notif']) ? $_GET['notif'] : false;
    if ($status == "success") { ?>
        <div class="alert alert-success" role="alert">
            Unit successfully added.
        </div>
    <?php } else if($status == "failed") { ?>
        <div class="alert alert-danger" role="alert">
            Unit already exists.
        </div>
    <?php } ?>

    <form action="../controller/unit.php" method="POST">
        <div class="form-group master-form">
            <label>Unit</label>
            <input type="text" name="unit" class="form-control" placeholder="Unit" required>
        </div>        
        <div class="form-group d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="ADD UNIT">
        </div>
    </form>
</div>