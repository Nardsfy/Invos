<div class="col-md-12">
    <div class="title-content">
        <h3>DATA PRODUCT</h3>
    </div>

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