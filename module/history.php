<div class="col-md-12">
    <div class="title-content">
        <h3>HISTORY TRANSACTION</h3>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">History</h3>
            <div class="pull-right">
                <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                    <i class="fa fa-search fa-lg"></i>
                </span>
            </div>
        </div>
        <div class="panel-body">
            <input type="text" class="form-control search-table" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search transaction.." />
        </div>
        <table class="table table-hover" id="dev-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $page = !isset($_GET['halaman']) ? 1 : $_GET['halaman'];
                $limit = 10;
                $offset = ($page - 1) * $limit;
                $total_transaction = count($new_transaction);
                $total_pages = ceil($total_transaction / $limit);
                $final = array_splice($new_transaction, $offset, $limit);
                $no = $offset + 1;

                foreach ($final as $data) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['date'] ?></td>
                        <td>
                            <div class="detailTransaction">Detail</div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- paging table -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item">
                        <a class="page-link" href="home.php?module=history&halaman=<?= $i; ?>"><?= $i; ?> </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </div>
</div>

<!-- Modal detail -->
<div id="modalDetail" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="row detailId">
                    <div class="col-md-4">
                        <h6 class="modal-title">Transaction ID</h6>
                    </div>
                    <div class="col-md-8 mb-2">
                        <input class="form-control" name="detailid" id="detailid" type="text" disabled>
                    </div>
                </div>
                <!-- table -->
                <div class="ml-5" id="detailData" name="detailData"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="btnDetail-close" name="btnDetail-close" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
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

<!-- pass data table to modalDetail -->
<script>
    $('.detailTransaction').on('click', function() {
        $('#modalDetail').modal('show');

        $tr = $(this).closest('tr');

        var row = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#detailid').val(row[1]);

        $.getJSON("../data/transaction.json", function(data) {
            $.getJSON("../data/product.json", function(dt) {
                var $table = $("<table id='tbDetail' name='tbDetail' class='table table-dark'>");
                $table.append('<thead><tr><th>PRODUCT ID</th><th>PRODUCT NAME</th><th>QUANTITY</th><th>SUPPLIER</th><th>UNIT</th><th>STOREROOM</th><th>DATE</th><th>INFO</th></tr></thead>');
                for (i = 0; i < data.length; i++) {
                    for (j = 0; j < dt.length; j++) {
                        if (dt[j].id == data[i].idproduct) {
                            var getName = dt[j].name;
                        }
                    }
                    if (row[1] == data[i].id) {
                        $table.append('<tr><td>' + data[i].idproduct + '</td><td>' + getName + '</td><td>' + data[i].quantity + '</td><td>' + data[i].supplier + '</td><td>' + data[i].unit + '</td><td>' + data[i].storeroom + '</td><td>' + data[i].date + '</td><td>' + data[i].info + '</td></tr>');
                    }
                }
                $('#detailData').append($table);
                $('.detailTransaction').on('click', function() {
                    $table.remove();
                });
            });
        });
    });
</script>