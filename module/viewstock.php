<div class="col-md-5">
    <div class="title-content">
        <h3>STOCK</h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group master-form">
                <label>Product ID</label>
                <select class="custom-select" name="idproduct" id="idproduct">                    
                    <?php foreach ($product as $data) { ?>
                        <option value="<?= $data['id'] ?>"><?= $data['id'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group master-form">
                <label>Unit</label>
                <select class="custom-select" name="unit" id="unit">                    
                    <?php foreach ($unit as $data) { ?>
                        <option value="<?= $data['unit'] ?>"><?= $data['unit'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group master-form">
                <label>Storeroom</label>
                <select class="custom-select" name="storeroom" id="storeroom">                    
                    <?php foreach ($storeroom as $data) { ?>
                        <option value="<?= $data['storeroom'] ?>"><?= $data['storeroom'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group d-flex justify-content-center">
        <button type="button" class="btn btn-primary filter" value="Check Stock">Check Stock</button>
    </div>

    <div class="col-md-12 dataFilter"></div>
</div>

<script>
    var selectedId;
    var selectedUnit;
    var selectedStoreroom;
    var $table;
    $('#idproduct').change(function() {        
        $('.filter').attr("disabled", false);
        $table.remove();
    });
    $('#unit').change(function() {        
        $('.filter').attr("disabled", false);
        $table.remove();
    });
    $('#storeroom').change(function() {        
        $('.filter').attr("disabled", false);
        $table.remove();
    });

    $('.filter').on('click', function() {
        $('.filter').attr("disabled", true);
        selectedId = $('#idproduct').val();
        selectedUnit = $('#unit').val();
        selectedStoreroom = $('#storeroom').val();
        $table = $("<table class='table table-dark'>");
        var totalQt = 0;
        var getName;
        $table.append('<thead><tr><th>PRODUCT ID</th><th>PRODUCT NAME</th><th>QUANTITY</th><th>UNIT</th><th>STOREROOM</th></tr></thead>');
        if (typeof selectedId === "undefined" || typeof selectedUnit === "undefined" || typeof selectedStoreroom === "undefined") {
            $table.append('<tr><td colspan="5">Product ID, unit, and storeroom must be selected.</td></tr>')
        } else {
            $.getJSON("../data/transaction.json", function(data) {
                $.getJSON("../data/product.json", function(dt) {
                    $.each(data, function(index, value) {

                        for (j = 0; j < dt.length; j++) {
                            if (dt[j].id == selectedId) {
                                getName = dt[j].name;
                            }
                        }

                        if (selectedId == value.idproduct && selectedUnit == value.unit && selectedStoreroom == value.storeroom) {
                            totalQt += value.quantity;
                        }
                    });

                    $table.append('<tr><td>' + selectedId + '</td><td>' + getName + '</td><td>' + totalQt + '</td><td>' + selectedUnit + '</td><td>' + selectedStoreroom + '</td></tr>');

                });
            });
        }
        $('.dataFilter').append($table);
    });
</script>