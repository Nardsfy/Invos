<div class="col-md-12">
    <div class="title-content">
        <h3>DATA PRODUCT</h3>
    </div>

    <!-- notification -->
    <?php 
    $status = isset($_GET['notif']) ? $_GET['notif'] : false;
    if ($status == "success") { ?>
        <div class="alert alert-success" role="alert">
            Product successfully updated.
        </div>
    <?php } else if($status == "failed") { ?>
        <div class="alert alert-danger" role="alert">
            Product cannot be updated.
        </div>
    <?php } else if($status == "deletesuccess") { ?>
        <div class="alert alert-success" role="alert">
            Product successfully deleted.
        </div>
    <?php } else if($status == "deletefailed") { ?>
        <div class="alert alert-danger" role="alert">
            Product cannot be deleted.
        </div>
    <?php } ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Products</h3>

            <!-- search -->
            <div class="pull-right">
                <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                    <i class="fa fa-search fa-lg"></i>
                </span>
            </div>
        </div>
        <div class="panel-body">
            <input type="text" class="form-control search-table" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search product.." />
        </div>

        <!-- table product -->
        <table class="table table-hover" id="dev-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $page = !isset($_GET['halaman']) ? 1 : $_GET['halaman'];
                $limit = 10;
                $offset = ($page - 1) * $limit;
                $total_product = count($product);
                $total_pages = ceil($total_product / $limit);
                $final = array_splice($product, $offset, $limit);
                $no = $offset + 1;

                foreach ($final as $data) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><i class="col-md-3 fa fa-pencil modalUpdateProduct"></i><i class="fa fa-trash modalDeleteProduct"></i></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- paging table -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item">
                        <a class="page-link" href="home.php?module=viewproduct&halaman=<?= $i; ?>"><?= $i; ?> </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </div>
</div>

<!-- Modal updateProduct -->
<div id="modalUpdateProduct" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="../controller/updateproduct.php">
                                <div class="col-md-12">                                    
                                    <label>Product ID</label>
                                    <input class="form-control" type="text" name="id" id="id" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text" name="name" id="name" required>
                                </div>                                
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal deleteProduct -->
<div id="modalDeleteProduct" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <form method="POST" action="../controller/deleteproduct.php">
                <div class="modal-header flex-column">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title w-100">Do you want to delete this product?</h4>
                    <input type="hidden" name="idDelete" id="idDelete">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    (function() {
        'use strict';
        var $ = jQuery;
        $.fn.extend({
            filterTable: function() {
                return this.each(function() {
                    $(this).on('keyup', function(e) {
                        $('.filterTable_no_results').remove();
                        var $this = $(this),
                            search = $this.val().toLowerCase(),
                            target = $this.attr('data-filters'),
                            $target = $(target),
                            $rows = $target.find('tbody tr');

                        if (search == '') {
                            $rows.show();
                        } else {
                            $rows.each(function() {
                                var $this = $(this);
                                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                            })
                            if ($target.find('tbody tr:visible').size() === 0) {
                                var col_count = $target.find('tr').first().find('td').size();
                                var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                $target.find('tbody').append(no_results);
                            }
                        }
                    });
                });
            }
        });
        $('[data-action="filter"]').filterTable();
    })(jQuery);

    $(function() {
        // attach table filter plugin to inputs
        $('[data-action="filter"]').filterTable();

        $('.container').on('click', '.panel-heading span.filter', function(e) {
            var $this = $(this),
                $panel = $this.parents('.panel');

            $panel.find('.panel-body').slideToggle();
            if ($this.css('display') != 'none') {
                $panel.find('.panel-body input').focus();
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

<!-- pass data product to modalUpdate -->
<script>
    $(document).ready(function() {

        $('.modalUpdateProduct').on('click', function() {

            $('#modalUpdateProduct').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[1]);
            $('#name').val(data[2]);

        });
    });
</script>

<!-- pass id product to modalDelete -->
<script>
    $(document).ready(function() {

        $('.modalDeleteProduct').on('click', function() {

            $('#modalDeleteProduct').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#idDelete').val(data[1]);

        });
    });    
</script>