<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
';
$xfooter = '
';
include 'header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('invoices'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('invoices'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('inv_req'); ?></strong>
            </li>
        </ol>
    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="logo.png" width="300px" height="200px">
                        </div>
                        <div class="col-sm-6 table-responsive m-t">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="4" width="800px"><h1 align="center"><b>Faktura</b></h1></td>
                                </tr>
                                <tr>
                                    <td align="center" width="25%" height="50px"><b>Fakturanummer</b>
                                        <br><?php echo $inv->invoice_id; ?></td>
                                    <td align="center" width="25%"><b>Kundnummber</b> <br></td>
                                    <td align="center" width="25%"><b>Fakturadatum</b> <br><input type="text"
                                                                                                  name="invoice_date"
                                                                                                  value="<?php echo $inv->invoice_date; ?>">
                                    </td>
                                    <td align="center" width="25%"><b>Sida</b> <br>1</td>
                                </tr>
                                <tr style="vertical-align: top; text-align: left;">
                                    <td colspan="4" width="25%" height="100px">
                                        <b>Faktureringsadress</b><br><?php echo $tic->ini_name . "<br>" . $tic->ini_address; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <table class="table table-borderless">
                        <tr>
                            <td width="50%" height="20px"><b>var referns</b> : <?php echo $tic->vendor; ?></td>
                            <td width="50%"><b>Betalningsvillkor</b> :
                                <select name="bill_due">
                                    <?php
                                    if ($inv->bill_due_date == '10') {
                                        echo '<option value="10" selected> 10 days </option><option value="20"> 20 days </option><option value="30"> 30 days </option>';
                                    } else if ($inv->bill_due_date == '20') {
                                        echo '<option value="10"> 10 days </option><option value="20" selected> 20 days </option><option value="30"> 30 days </option>';
                                    } else if ($inv->bill_due_date == '30') {
                                        echo '<option value="10"> 10 days </option><option value="20"> 20 days </option><option value="30" selected> 30 days </option>';
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td width="50%" height="20px"><b>Er referens</b> : <?php echo $tic->ini_name; ?></td>
                            <td width="50%"><b>förfallodatum</b> : <?php echo $inv->bill_due_date; ?></td>
                        </tr>
                        <tr>
                            <td width="50%" height="20px"><b>Ert Ordernummer</b> : <?php echo $tic->ticket_id; ?></td>
                            <td width="50%"></td>
                        </tr>
                    </table>


                    <table class="table table-bordered">
                        <tr>
                            <td>Description</td>
                        </tr>
                        <tr>
                            <td>
                                <textarea class="form-control"
                                          name="description"><?php echo $inv->description ?></textarea>
                            </td>
                        </tr>
                    </table>

                    <h4>ROT Status: <?php echo $inv->rot; ?></h4>
                    <a href='#Rot' data-toggle='modal' data-hover='tooltip' title='Close Ticket' data-placement='top'
                       data-whatever="<?php echo $tic->ticket_id; ?>" class='btn btn-primary'>View/Add ROT Data</a>

                    <input type="hidden" name="ticket_id" value="<?php echo $tic->ticket_id; ?>">
                    <input type="hidden" name="invoice_id" value="<?php echo $inv->invoice_id; ?>">
                    <div class="table-responsive m-t">
                        <table class="table table-bordered" id="data">
                            <thead>
                            <tr>
                                <th style="width: 10%">Nummer</th>
                                <th style="width: 35%">Benämning</th>
                                <th style="width: 10%">Antal</th>
                                <th style="width: 10%">Enhat</th>
                                <th style="width: 10%">Pris</th>
                                <th style="width: 10%">Rabatt %</th>
                                <th style="width: 10%">Belopp</th>
                                <th style="width: 5%">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                $sub_total = 0;
                                $shipping = 0;
                                $tax = 0;
                                foreach ($inv_items as $key) {
                                    $item_name = $key->item_name;
                                    $quantity = $key->quantity;
                                    $quantity_type = $key->quantity_type;
                                    $price = $key->price;
                                    $discount = $key->discount;
                                    $total = $key->total;
                                    $sub_total = $sub_total + $key->total;

                                    if (stripos($item_name, 'Frakt') !== false) {
                                        $shipping += $total;
                                    }

                                    if (stripos($item_name, 'Rot arbete') !== false) {
                                        $tax += $total;
                                    }

                                    echo '<td><input type="text" class="form-control" name="rot_status" value=""></td>
                                    <td><input type="text" class="form-control" name="item_name[]" value="' . $item_name . '"></td>
                                    <td align="center"><input type="text" class="qty form-control" name="quantity[]" value="' . $quantity . '"></td>
                                    <td width="10%"><select name="quantity_type[]" class="form-control" tabindex="-1"><option value="' . $quantity_type . '">' . $quantity_type . '</option>
                                    <td align="center"><input type="text" class="rate form-control" name="price[]" value="' . $price . '"></td>
                                    <td align="center"><input type="text" class="disc form-control" name="discount[]" value="' . $discount . '"></td>
                                    <td align="center"><input type="text" class="cal form-control" name="total[]" value="' . $total . '"></td>
                                    <td><button type="button" class="btn btn-primary btn-sm removebutton" tabindex="4">Delete</button></td>
                                    </tr>';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->

                    <input type="button" id="addnew" class="calculate btn btn-primary" name="addnew" value="Add Item"/>

                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Frakt :</strong></td>
                            <td><?php echo $shipping; ?></td>
                        </tr>
                        <?php
                        $vat = (25 / 100) * $sub_total;
                        $g_total = $sub_total + $shipping + $vat;
                        $g_total1 = round($g_total);
                        $rounding = abs($g_total - $g_total1);
                        ?>
                        <tr>
                            <td><strong>Belopp fore moms :</strong></td>
                            <td><?php echo $sub_total; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Moms :</strong></td><?php ?>
                            <td><?php echo $vat; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Öresutjämning :</strong></td>
                            <td><?php echo number_format($rounding, 2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Skattereduktion :</strong></td>
                            <td><?php
                                $tax1 = $tax + ((25 / 100) * $tax);
                                $tax2 = (30 / 100) * $tax1;
                                echo $tax2;
                                ?></td>
                        </tr>
                        <tr>
                            <td><strong>Summa att betala :</strong></td>
                            <td><?php
                                $g_total2 = $g_total1 - $shipping;
                                echo $g_total2 - $tax2; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="save_invoice"> Save Invoice</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Page-Level Scripts -->
<?php if (!empty($message)) { ?>
    <script>
        $(document).ready(function () {
            var msg = "<?php echo $message; ?> ";

            swal({
                title: "Invoice Not Found",
                text: "",
                type: "danger",
            });
        });
    </script>
<?php } ?>


<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy', title: 'ExampleFile'},
                {extend: 'csv', title: 'ExampleFile'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

</script>

</body>

</html>

<!-- Localized -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#data').on('keyup', '.disc, .qty, .rate, .cal', calculateRow);
        $('#addnew').click(function () {
            $('#data').append('<tr>\n\
            <td><input type="text" class="form-control" name="rot_status" placeholder=""></td>\n\
            <td><input type="text" class="form-control" name="item_name[]" placeholder="Name of the Item"></td>\n\
            <td align="center"><input type="text" class="qty form-control" name="quantity[]" placeholder="Quantity"></td>\n\
            <td width="10%"><select name="quantity_type[]" class="form-control" tabindex="-1"><option value="hours">hours</option><option value="pieces">pieces</option></select></td>\n\
            <td align="center"><input type="text" class="rate form-control" name="price[]" value="0"></td>\n\
            <td align="center"><input type="text" class="disc form-control" name="discount[]" value="0" ></td>\n\
            <td align="center"><input type="text" class="cal form-control" name="total[]" value="0"></td>\n\
            <td><button type="button" class="btn btn-primary btn-sm removebutton" tabindex="4">Delete</button></td>\n\
        </tr>'
            );
            $('#data').off('keyup').on('keyup', ' .disc, .qty, .rate, .cal', calculateRow);
        });
        function calculateRow() {
            var cost = 0;
            var disc = 0;
            var $row = $(this).closest("tr");

            var qty = parseFloat($row.find('.qty').val());
            var rate = parseFloat($row.find('.rate').val());
            var disc = parseFloat($row.find('.disc').val());

            if (isNaN(disc)) {
                disc = 0;
            }
            cost1 = qty * rate;
            disc_per = (disc / 100) * cost1
            cost = cost1 - disc_per;


            if (isNaN(cost)) {
                $row.find('.cal').val("0");
            } else {
                $row.find('.cal').val(cost);
            }


        }
    });

    $(document).on('click', 'button.removebutton', function () {
        $(this).closest('tr').remove();
        return false;
    });
</script>
<script>
    $(document).ready(function () {
        $("#send").click(function () {
            $.get("invoicesend.php?ticket_id=<?php echo $ticket_id; ?>", function (data) {
                swal({
                    title: "Invoice sent successfully!",
                    timer: 2000,
                    type: "success",
                    showConfirmButton: false
                });
            });
        });
    });
</script>
<!--=============================ROT Modal====================-->
<div class="modal fade" id="Rot" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="CloseLabel">Enter ROT details</h4>
                </div>
                <?php
                $label1 = $rot->label1;
                $label2 = $rot->label2;
                $label3 = $rot->label3;
                $label4 = $rot->label4;
                $personal_number = $rot->personal_number;
                ?>
                <form class="form-horizontal" method="POST" action="addrot.php">
                    <input type="hidden" name="ticket_id" class="form-control ticket_id" id="ticket_id">
                    <div class="modal-body">
                        <div class="form-group"><label class="col-lg-3 control-label">Fastighetsbeteckning</label>
                            <div class="col-lg-8"><input type="text" name="label1" value="<?php if (isset($label1)) {
                                    echo $label1;
                                } ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-3 control-label">Lägenhetsbeteckning</label>
                            <div class="col-lg-8"><input type="text" name="label2" value="<?php if (isset($label1)) {
                                    echo $label2;
                                } ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-3 control-label">Bostadsrättsförenings org.
                                nr</label>
                            <div class="col-lg-8"><input type="text" name="label3" value="<?php if (isset($label1)) {
                                    echo $label3;
                                } ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group"><label class="col-lg-3 control-label">Personnummer</label>
                            <div class="col-lg-8"><input type="text" name="personal_number"
                                                         value="<?php if (isset($label1)) {
                                                             echo $personal_number;
                                                         } ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" value="Add ROT data" name="rot" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Rot").on("show.bs.modal", function (e) {
        var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
        o.find("#ticket_id").val(t)
    });
</script>

<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>