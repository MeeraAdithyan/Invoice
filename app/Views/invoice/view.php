<!DOCTYPE html>
<html>

<head>
    <title>Create Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .error {
            display: block;
            padding-top: 5px;
            font-size: 14px;
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="post" id="add_create" name="add_create" action="<?= site_url('/submit-form') ?>">
                    <table class="table table-bordered table-hover" id="invoiceItem">
                        <thead>
                            <tr>
                                <th width="30%">Item Name</th>
                                <th width="20%">Quantity</th>
                                <th width="20%">Unit Price</th>
                                <th width="15%">Tax</th>
                                <th width="20%">Total</th>
                            </tr>
                        </thead>
                        <tbody class="items">
                            <?php
                            foreach ($item as $item) {
                            ?>
                                <tr>
                                    <td><?= $item['name']; ?></td>
                                    <td><?= $item['quantity']; ?></td>
                                    <td><?= $item['price']; ?></td>
                                    <td><?= $item['tax'] . '%'; ?></td>
                                    <td><?= isset($item['total']) ? $item['total'] : 0; ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="sub_total">
                                <th colspan="4" class='text-right'>Sub Total(with out Tax)</th>
                                <td><?= $sub_total_without_tax; ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" class='text-right'>Discount</th>
                                <td><?= $discount; ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" class='text-right'>Sub Total(with Tax)</th>
                                <td class=""><?= $sub_total_with_tax; ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" class='text-right'>Total</th>
                                <td class=''><?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
</body>

</html>