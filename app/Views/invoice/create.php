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
                                <th><button class="btn btn-success" id="addRows" type="button">+ </button></th>
                            </tr>
                        </thead>
                        <tbody class="items">
                            <tr>
                                <td><input type="text" name="name[]" id="ame_1" class="form-control name" autocomplete="off"></td>
                                <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                                <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                                <td><select name="tax[]" class="form-control tax">
                                        <option value="">Select Tax</option>
                                        <option value="0">0%</option>
                                        <option value="1">1%</option>
                                        <option value="5">5%</option>
                                        <option value="10">10%</option>

                                    </select>
                                </td>
                                <td><input type="number" name="total[]" class="form-control total" autocomplete="off" readdonly="true">
                                    <input type="hidden" name="total_with_out_tax[]" class="form-control total_with_out_tax" autocomplete="off" readdonly="true">
                                </td>
                            </tr>
                            <tr class="sub_total">
                                <td colspan="4" class='text-right'>Sub Total(with out Tax)</td>
                                <td><input type="number" name="sub_total_with_out_tax" class="form-control sub_total_with_out_tax" readdonly="true"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class='text-right'>Discount</td>
                                <td><input type="number" name="discount" id="discount" class="form-control discount" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class='text-right'>Sub Total(with Tax)</td>
                                <td class=""><input type="number" name="sub_total_tax" class=" form-control sub_total_tax" readdonly="true"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class='text-right'>Total</td>
                                <td class=''><input type="number" name="grand_total" class="form-control grand_total" readdonly="true"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>

                    </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-right">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Generate Invoice</button>
                </div>
            </div>
        </div>
    </div>


    </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script>
    if ($("#add_create").length > 0) {
        $("#add_create").validate({
            rules: {
                "name[]": {
                    required: true,
                },
                "quantity[]": {
                    required: true,
                    digits: true
                },
                "price[]": {
                    required: true,
                    number: true
                },
                "tax[]": {
                    required: true,
                },
            },
            messages: {
                "name[]": {
                    required: "Name is required.",
                },
                "quantity[]": {
                    required: "Quantity is required.",
                    digits: "Quantity must be an integer.."
                },
                "price[]": {
                    required: "Unit Price is required.",
                    number: "Unit Price must be a number."
                },
                "tax[]": {
                    required: "Tax is required.",
                },
            },
        })
    }
    $(document).ready(function() {
        $('#addRows').click(function() {
            n = ($('.items tr').length - 0) + 1;
            var tr = '<tr>' +
                '<td><input type="text" name="name[]"  class="form-control name" autocomplete="off"></td>' +
                '<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>' +
                '<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>' +
                '<td><select name="tax[]" id="tax" class="form-control tax">' +
                '<option value="">Select Tax</option>' +
                '<option value="0">0%</option>' +
                '<option value="1">1%</option>' +
                '<option value="5">5%</option>' +
                '<option value="10">10%</option>' +
                '</select>' +
                '</td>' +
                '<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off" disabled>' +
                '<input type="hidden" name="total_with_out_tax[]" class="form-control total_with_out_tax" autocomplete="off" disabled></td>' +
                '</tr>';
            $('.sub_total').before(tr);
        });
        $(document).on('change', '.quantity,.price,.tax', function() {
            // $('.quantity,.price,.tax').change(function() {
            var quantity = $(this).closest('tr').find('.quantity').val();
            var price = $(this).closest('tr').find('.price').val();
            var tax = $(this).closest('tr').find('.tax').find(":selected").val();
            var total = (quantity * price) + ((quantity * price) / 100) * tax;
            $(this).closest('tr').find('.total').val(total);
            $(this).closest('tr').find('.total_with_out_tax').val((quantity * price));
            var total_with_out_tax = total_with_tax = 0;
            $(".total_with_out_tax").each(function(index) {
                total_with_out_tax = parseFloat(total_with_out_tax) + parseFloat($(this).val());
            });
            $(".total").each(function(index) {
                total_with_tax = parseFloat(total_with_tax) + parseFloat($(this).val());
            });
            $('.sub_total_with_out_tax').val(total_with_out_tax);
            $('.sub_total_tax').val(total_with_tax);
            $('.grand_total').val(total_with_tax - $('.discount').val());
        });
        $(document).on('keyup', '.discount', function() {
            $('.grand_total').val(total_with_tax - $('.discount').val());
        });

    });
</script>

</html>