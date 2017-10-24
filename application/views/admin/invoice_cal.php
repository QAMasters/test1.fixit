<script type="text/javascript">
    function enable_autocomplete(InputField) {
        $(InputField).autocomplete({
            source: "<?php echo base_url()?>invoice/mat_search",
            select: function (event, ui) {
                var row = $(this).closest('tr');
                var sel_item = ui.item;
                row.find('.invoice_product').val(sel_item.label);
                row.find('.invoice_unit').val(sel_item.unit);
                row.find('.invoice_product_qty').val(sel_item.quantity);
                row.find('.invoice_product_price').val(sel_item.price);
                row.find('.invoice_product_discount').val(sel_item.discount);
                row.find('.invoice_product_surcharge').val(sel_item.surcharge);
                row.find('.invoice_product_sub').val(sel_item.sub);
                row.find('.invoice_product_unit').val(sel_item.unit);
                calculateTotal();
            },
            minLength: 1
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {

        enable_autocomplete($('.auto'));
        var cloned = $('#invoice_table tr:last').clone();
        $('.add-row').click(function (e) {
            e.preventDefault();
            cloned.clone().appendTo('#invoice_table');
            enable_autocomplete($('.auto'));
        });

        // enable date pickers for due date and invoice date
        var dateFormat = $(this).attr('data-vat-rate');
        $('#invoice_date, #invoice_due_date').datetimepicker({
            showClose: false,
            format: dateFormat
        });

        // copy customer details to shipping
        $('input.copy-input').on("input", function () {
            $('input#' + this.id + "_ship").val($(this).val());
        });

        // remove product row
        $('#invoice_table').on('click', ".delete-row", function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotal();
        });

        calculateTotal();
        //To update on select autocomplete immediately
        $(document).on('click', document, function () {
            calculateTotal();
        });
        $('#invoice_table').on('input', '.calculate', function () {
            updateTotals(this);
            calculateTotal();
        });

        $('#invoice_totals').on('input', '.calculate', function () {
            calculateTotal();
        });

        $('#invoice_product').on('input', '.calculate', function () {
            calculateTotal();
        });

        $('.remove_vat').on('change', function () {
            calculateTotal();
        });

        function updateTotals(elem) {

            var tr = $(elem).closest('tr'),
                quantity = $('[name="invoice_product_qty[]"]', tr).val(),
                price = $('[name="invoice_product_price[]"]', tr).val(),
                percent = $('[name="invoice_product_discount[]"]', tr).val(),
                sur1 = $('[name="invoice_product_surcharge[]"]', tr).val(),

                subtotal = parseInt(quantity) * parseFloat(price);
            var subtotal1 = 0
            var subtotal2 = 0;

            if (sur1 && $.isNumeric(sur1) && sur1 !== 0) {
                subtotal1 = ((parseFloat(sur1) / 100) * subtotal);

            } else {
                $('[name="invoice_product_surcharge[]"]', tr).val('');
            }

            if (percent && $.isNumeric(percent) && percent !== 0) {
                subtotal2 = ((parseFloat(percent) / 100) * subtotal);
            } else {
                $('[name="invoice_product_discount[]"]', tr).val('');
            }

            subtotal3 = (subtotal + subtotal1) - subtotal2

            $('.calculate-sub', tr).val(subtotal3.toFixed(2));
        }

        function calculateTotal() {

            var grandTotal = 0,
                disc = 0,
                surcharge = 0,
                c_ship = parseInt($('.calculate.shipping').val()) || 0;
            var item_name = '';
            var item_shipping = 0;
            var tax_credit = 0;
            var tax_credit1 = 0, tax_credit2 = 0;
            $('#invoice_table tbody tr').each(function () {
                var c_sbt = $('.calculate-sub', this).val(),
                    quantity = $('[name="invoice_product_qty[]"]', this).val(),
                    price = $('[name="invoice_product_price[]"]', this).val() || 0,
                    subtotal = parseInt(quantity) * parseFloat(price);

                item_name = $('[name="invoice_product[]"]', this).val();

                //item_shipping = item_shipping + item_name.includes("Frakt");
                if (item_name.includes("Frakt") === true) {
                    item_shipping = item_shipping + subtotal;
                }
                if (item_name.includes("Rot") === true) {
                    tax_credit = tax_credit + subtotal;
                }


                grandTotal += parseFloat(c_sbt);
                disc += subtotal - parseFloat(c_sbt);
            });

            // VAT, DISCOUNT, SHIPPING, TOTAL, SUBTOTAL:
            var subT = parseFloat(grandTotal),
                finalTotal = parseFloat(grandTotal + c_ship),
                vat = parseInt($('.invoice-vat').attr('data-vat-rate'));

            tax_credit1 = (((25 / 100) * tax_credit) + tax_credit);
            tax_credit2 = ((30 / 100) * tax_credit1);


            if (isNaN(subT)) {
                return false;
            } else {
                $('.invoice-sub-total').text(subT.toFixed(2));
            }
            $('#invoice_subtotal').val(subT.toFixed(2));
            $('.invoice-discount').text(disc.toFixed(2));
            $('#invoice_discount').val(disc.toFixed(2));
            $('.invoice-shipping').text(item_shipping);
            $('#invoice_shipping').val(item_shipping);
            $('.invoice-tax_credit').text(tax_credit2);
            $('#invoice_tax_credit').val(tax_credit2);

            if ($('.invoice-vat').attr('data-enable-vat') === '1') {

                if ($('.invoice-vat').attr('data-vat-method') === '1') {
                    $('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
                    $('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
                    $('.invoice-total').text((finalTotal - tax_credit2).toFixed());
                    $('#invoice_total').val((finalTotal - tax_credit2).toFixed());
                } else {
                    $('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
                    $('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
                    var finalTotal1 = (finalTotal + ((vat / 100) * finalTotal));
                    var roundoff = (finalTotal1.toFixed(2) - finalTotal1.toFixed())
                    $('.invoice-total').text((finalTotal1 - tax_credit2).toFixed());
                    $('#invoice_total').val((finalTotal1 - tax_credit2).toFixed());
                    $('.invoice-roundoff').text(Math.abs(roundoff.toFixed(2)));
                    $('#invoice_roundoff').val(Math.abs(roundoff.toFixed(2)));
                }
            } else {
                $('.invoice-total').text((finalTotal - tax_credit2).toFixed());
                $('#invoice_total').val((finalTotal - tax_credit2).toFixed());
            }
            // remove vat
            if ($('input.remove_vat').is(':checked')) {
                $('.invoice-vat').text("0.00");
                $('#invoice_vat').val("0.00");
                $('.invoice-roundoff').text("0.00");
                $('#invoice_roundoff').val("0.00");
                $('.invoice-total').text((finalTotal - tax_credit2).toFixed());
                $('#invoice_total').val((finalTotal - tax_credit2).toFixed());
            }
        }
    });
</script>