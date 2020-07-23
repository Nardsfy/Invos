<div class="col-md-5">
    <div class="title-content">
        <h3>MASTER PRODUCT</h3>
    </div>

    <!-- notification -->
    <?php 
    $status = isset($_GET['notif']) ? $_GET['notif'] : false;
    if ($status == "success") { ?>
        <div class="alert alert-success" role="alert">
            Product successfully added.
        </div>
    <?php } else if($status == "failed") { ?>
        <div class="alert alert-danger" role="alert">
            Product already exists.
        </div>
    <?php } ?>

    <form action="../controller/product.php" method="POST">
        <div class="form-group master-form">
            <label>Product ID</label>
            <input type="text" name="id" class="form-control" placeholder="Product ID" required>
        </div>
        <div class="form-group master-form">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="form-group d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="ADD PRODUCT">
        </div>
    </form>
</div>