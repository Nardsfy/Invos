<div class="col-md-5">
    <div class="title-content">
        <h3>MASTER SUPPLIER</h3>
    </div>

    <!-- notification -->
    <?php 
    $status = isset($_GET['notif']) ? $_GET['notif'] : false;
    if ($status == "success") { ?>
        <div class="alert alert-success" role="alert">
            Supplier successfully added.
        </div>
    <?php } else if($status == "failed") { ?>
        <div class="alert alert-danger" role="alert">
            Supplier already exists.
        </div>
    <?php } ?>

    <form action="../controller/supplier.php" method="POST">
        <div class="form-group master-form">
            <label>Supplier Name</label>
            <input type="text" name="name" class="form-control" placeholder="Supplier Name" required>
        </div>
        <div class="form-group master-form">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address" required>
        </div>
        <div class="form-group master-form">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group master-form">
            <label>Contact</label>
            <input type="text" name="contact" class="form-control" placeholder="Contact" required>
        </div>
        <div class="form-group d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="ADD SUPPLIER">
        </div>
    </form>
</div>