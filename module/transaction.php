<div class="col-md-5">
    <div class="title-content">
        <div class="row">
            <div class="col-md-8">
                <h3>TRANSACTION</h3>
            </div>
            <div class="col-md-4">
                <a class="btn dataCart"><i class="fa fa-shopping-cart fa-lg pull-right"></i></a>
            </div>
        </div>
    </div>

    <!-- notification -->
    <?php
    $status = isset($_GET['notif']) ? $_GET['notif'] : false;
    if ($status == "success") { ?>
        <div class="alert alert-success" role="alert">
            Transaction successfully added.
        </div>
    <?php } else if ($status == "failed") { ?>
        <div class="alert alert-danger" role="alert">
            Transaction already exists.
        </div>
    <?php } else if ($status == "empty") { ?>
        <div class="alert alert-danger" role="alert">
            All fields are requred.
        </div>
    <?php } else if ($status == "min") { ?>
        <div class="alert alert-danger" role="alert">
            Quantity cannot be less than 1.
        </div>
    <?php } else if ($status == "delcartsuccess") { ?>
        <div class="alert alert-success" role="alert">
            Data removed from shopping cart.
        </div>
    <?php } else if ($status == "quantity") {?>
        <div class="alert alert-danger" role="alert">
            Out of stock. 
        </div>
    <?php } ?>

    <div class="row btn-transaction">
        <div class="col-md-6">
            <button class="btn btn-primary btn-block in" type="button" name="in" id="in" data-toggle="collapse" href="#collapseIn">IN</button>
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary btn-block out" type="button" name="out" id="out" data-toggle="collapse" href="#collapseOut">OUT</button>
        </div>
    </div>

    <!-- transaction IN -->
    <div class="collapse cl-in" id="collapseIn">
        <div class="row">

            <div class="form-group col-sm-6">
                <label>Product ID</label>
                <select class="custom-select" name="id" id="id">
                    <?php foreach ($product as $data) { ?>
                        <option value="<?= $data['id'] ?>"><?= $data['id'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label>Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" min=1 value=1 required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Supplier</label>
                <select class="custom-select" name="supplier" id="supplier">
                    <?php foreach ($supplier as $data) { ?>
                        <option value="<?= $data['id'] ?>"><?= $data['id'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <label>Unit</label>
                <select class="custom-select" name="unit" id="unit">
                    <?php foreach ($unit as $data) { ?>
                        <option value="<?= $data['unit'] ?>"><?= $data['unit'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Storeroom</label>
                <select class="custom-select" name="storeroom" id="storeroom">
                    <?php foreach ($storeroom as $data) { ?>
                        <option value="<?= $data['storeroom'] ?>"><?= $data['storeroom'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <label>Info</label>
                <input class="form-control" type="text" name="info" id="info" value="IN" disabled>
            </div>
        </div>
        <div class="form-group d-flex justify-content-center">
            <button name="btn-in" id="btn-in" type="button" class="btn btn-primary openModal" value="ADD TRANSACTION">ADD TRANSACTION</button>
        </div>
    </div>

    <!-- transaction OUT -->
    <div class="collapse cl-out" id="collapseOut">
        <div class="row">

            <div class="form-group col-sm-6">
                <label>Product ID</label>
                <select class="custom-select" name="idOut" id="idOut">
                    <?php foreach ($product as $data) { ?>
                        <option value="<?= $data['id'] ?>"><?= $data['id'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label>Quantity</label>
                <input type="number" name="quantityOut" id="quantityOut" class="form-control" placeholder="Quantity" min=1 value=1 required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Unit</label>
                <select class="custom-select" name="unitOut" id="unitOut">
                    <?php foreach ($unit as $data) { ?>
                        <option value="<?= $data['unit'] ?>"><?= $data['unit'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <label>Storeroom</label>
                <select class="custom-select" name="storeroomOut" id="storeroomOut">
                    <?php foreach ($storeroom as $data) { ?>
                        <option value="<?= $data['storeroom'] ?>"><?= $data['storeroom'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Info</label>
                <input class="form-control text-center" type="text" name="infoOut" id="infoOut" value="OUT" disabled>
            </div>
        </div>
        <div class="form-group d-flex justify-content-center">
            <button type="button" name="btn-out" id="btn-out" class="btn btn-primary openModalOut" value="ADD TRANSACTION">ADD TRANSACTION</button>
        </div>
    </div>
</div>

<!-- Modal confirmation In -->
<div id="modalConfirmationIn" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="row modal-row">
                    <div class="col-md-12">
                        <form method="POST" action="../controller/temptransaction.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Product ID</label>
                                    <input class="form-control" type="text" name="id" id="id" readonly>
                                </div>
                                <div class="col-md-8">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text" name="name" id="name" disabled>
                                </div>
                            </div>
                            <label>Quantity</label>
                            <input class="form-control" type="number" name="quantity" id="quantity" readonly>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Supplier ID</label>
                                    <input class="form-control" type="text" name="supplier" id="supplier" readonly>
                                </div>
                                <div class="col-md-8">
                                    <label>Supplier Name</label>
                                    <input class="form-control" type="text" name="suppliername" id="suppliername" disabled>
                                </div>
                            </div>

                            <label>Unit</label>
                            <input class="form-control" type="text" name="unit" id="unit" readonly>
                            <label>Storeroom</label>
                            <input class="form-control" type="text" name="storeroom" id="storeroom" readonly>
                            <label>Info</label>
                            <input class="form-control" type="text" name="info" id="info" readonly>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button name="btnTransaction-in" type="submit" class="btn btn-danger">ADD TRANSACTION</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal confirmation Out -->
<div id="modalConfirmationOut" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="row modal-row">
                    <div class="col-md-12">
                        <form method="POST" action="../controller/temptransaction.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Product ID</label>
                                    <input class="form-control" type="text" name="idOut" id="idOut" readonly>
                                </div>
                                <div class="col-md-8">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text" name="nameOut" id="nameOut" disabled>
                                </div>
                            </div>
                            <label>Quantity</label>
                            <input class="form-control" type="number" name="quantityOut" id="quantityOut" readonly>
                            <label>Unit</label>
                            <input class="form-control" type="text" name="unitOut" id="unitOut" readonly>
                            <label>Storeroom</label>
                            <input class="form-control" type="text" name="storeroomOut" id="storeroomOut" readonly>
                            <label>Info</label>
                            <input class="form-control" type="text" name="infoOut" id="infoOut" readonly>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button name="btnTransaction-out" type="submit" class="btn btn-danger">ADD TRANSACTION</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal shopping cart -->
<div id="modalCart" class="modal fade">
    <div class="modal-dialog modal-confirm modal-lg">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="row modal-row ml-5">
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Supplier</th>
                                    <th>Unit</th>
                                    <th>Storeroom</th>
                                    <th>Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php if (isset($temptransaction)) {
                                $no = 1;
                                foreach ($temptransaction as $data) { ?>
                                    <tr>                                        
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['idproduct'] ?></td>
                                        <td><?= $data['quantity'] ?></td>
                                        <td><?= $data['supplier'] ?></td>
                                        <td><?= $data['unit'] ?></td>
                                        <td><?= $data['storeroom'] ?></td>
                                        <td><?= $data['info'] ?></td>
                                        <td><a href='../controller/deletecart.php?idtemp=<?= $data['idtemp'] ?>'><button class="btn"><i class="fa fa-trash text-light"></i></button></a></td>
                                    </tr>
                            <?php }
                            } ?>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-center mx-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Add more..</button>

                        <a href="../controller/transaction.php">
                            <button type="button" class="btn btn-danger" name="btn-buy" value="BUY">BUY</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal notif add more Transaction -->
<div id="modalKeranjang" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <form method="POST" action="../controller/tempproduct.php">
                <div class="modal-header flex-column">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title w-100">Do you want to add more products?</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Add more..</button>

                    <a href="../controller/transaction.php">
                        <button type="button" class="btn btn-danger" name="btn-buy" value="BUY">BUY</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- pass data to modalConfirmation In -->
<script>
    $(document).ready(function() {

        $('.openModal').on('click', function() {
            $('#modalConfirmationIn').modal('show');

            $('input#id').val($('#id').val());
            $('input#name').val($('#name').val());
            $('input#quantity').val($('#quantity').val());
            $('input#supplier').val($('#supplier').val());
            $('input#unit').val($('#unit').val());
            $('input#storeroom').val($('#storeroom').val());
            $('input#info').val($('#info').val());

        });
    });
</script>

<!-- pass data to modalConfirmation Out -->
<script>
    $(document).ready(function() {

        $('.openModalOut').on('click', function() {
            $('#modalConfirmationOut').modal('show');

            $('input#idOut').val($('#idOut').val());
            $('input#nameOut').val($('#nameOut').val());
            $('input#quantityOut').val($('#quantityOut').val());
            $('input#supplierOut').val($('#supplierOut').val());
            $('input#unitOut').val($('#unitOut').val());
            $('input#storeroomOut').val($('#storeroomOut').val());
            $('input#infoOut').val($('#infoOut').val());

        });
    });
</script>

<!-- hide collapse -->
<script>
    $('.out').on('click', function() {
        $('.cl-in').collapse('hide');
    });

    $('.in').on('click', function() {
        $('.cl-out').collapse('hide');
    });
</script>

<!-- get data Name transaction in -->
<script>
    $('#btn-in').on('click', function() {
        var selectId = $('#id :selected').text();
        var selectSupplier = $('#supplier :selected').text();
        $.getJSON("../data/product.json", function(data) {
            $.each(data, function(index, value) {
                if (selectId == value.id) {
                    $('input#name').val(value.name);
                }
            });
        });

        $.getJSON("../data/supplier.json", function(data) {
            $.each(data, function(index, value) {
                if (selectSupplier == value.id) {
                    $('input#suppliername').val(value.name);
                }
            });
        });
    });
</script>

<script>
    $('#btn-out').on('click', function() {
        var selectId = $('#idOut :selected').text();
        $.getJSON("../data/product.json", function(data) {
            $.each(data, function(index, value) {
                if (selectId == value.id) {
                    $('input#nameOut').val(value.name);
                }
            });
        });
    });
</script>

<!-- show modalCart -->
<script>
    $('.dataCart').on('click', function() {
        $('#modalCart').modal('show');
    });
</script>

<?php
if (isset($_GET['addmore'])) { ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#modalKeranjang').modal('show');
        });
    </script>
<?php } ?>