<?php
$xheader = '
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

';
$xfooter = '
<script src="' . base_url() . 'assets/plugins/datapicker/bootstrap-datepicker.js"></script>

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
<form method="post" action="<?php echo base_url(); ?>invoice/update">
    <input type="hidden" name="ticket_id" value="<?php echo $tic->ticket_id; ?>">
    <input type="hidden" name="invoice_id" value="<?php echo $inv->invoice_id; ?>">
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
                                    <thead>
                                    <tr>
                                        <th colspan="4" width="800px"><h1 align="center"><b>Faktura</b></h1></th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td align="center" width="25%" height="50px"><b>Fakturanummer</b>
                                            <br><?php echo $inv->invoice_id; ?></td>
                                        <td align="center" width="25%"><b>Kundnummber</b> <br></td>
                                        <td align="center" width="25%"><b>Fakturadatum</b> <br><input class="datepicker"
                                                                                                      data-date-format="yyyy-mm-dd"
                                                                                                      value="<?php echo $inv->invoice_date; ?>"
                                                                                                      name="invoice_date">
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
                                <td width="50%" height="20px"><b>var referns</b>
                                    : <?php echo get_user_name($tic->vendor)->fname; ?></td>
                                <td width="50%"><b>Betalningsvillkor</b> :
                                    <select name="bill_due">
                                        <?php
                                        if ($inv->bill_due == '10') {
                                            echo '<option value="10" selected> 10 days </option><option value="20"> 20 days </option><option value="30"> 30 days </option>';
                                        } else if ($inv->bill_due == '20') {
                                            echo '<option value="10"> 10 days </option><option value="20" selected> 20 days </option><option value="30"> 30 days </option>';
                                        } else if ($inv->bill_due == '30') {
                                            echo '<option value="10"> 10 days </option><option value="20"> 20 days </option><option value="30" selected> 30 days </option>';
                                        }
                                        ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <td width="50%" height="20px"><b>Er referens</b> : <?php echo $tic->ini_name; ?></td>
                                <td width="50%"><b>förfallodatum</b>
                                    : <?php echo date('Y-m-d', strtotime($inv->invoice_date . ' + ' . $inv->bill_due . ' days')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" height="20px"><b>Ert Ordernummer</b> : <?php echo $tic->ticket_id; ?>
                                </td>
                                <td width="50%"></td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td>Description</td>
                            </tr>
                            <tr>
                                <td><textarea class="form-control"
                                              name="description"><?php echo $inv->description ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <h4>ROT Status: <?php echo $inv->rot; ?> <font size="2px"><a href='#Rot' data-toggle='modal'
                                                                                     data-hover='tooltip'
                                                                                     title='ROT details'
                                                                                     data-placement='top'
                                                                                     data-whatever="<?php echo $tic->ticket_id; ?>"
                                                                                     class=''> View/Add ROT Details</a></font>
                        </h4><br>
                        <!-- / end client details section -->
                        <!--items start here-->

                        <table class="table table-bordered" id="invoice_table">
                            <thead>
                            <tr>
                                <th><h4><a href="#" class="btn btn-primary btn-xs add-row"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h4>
                                </th>
                                <th width="30%"><h4>Item</h4></th>
                                <th width="10%"><h4>Unit</h4></th>
                                <th><h4>Qty</h4></th>
                                <th width="10%"><h4>Price</h4></th>
                                <th width="20%"><h4>Discount</h4></th>
                                <th width="15%"><h4>Sub Total</h4></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($inv_items as $inv_item) { ?>
                                <tr>
                                    <td>
                                        <div class="form-group form-group-sm  no-margin-bottom">
                                            <a href="#" class="btn btn-danger btn-xs delete-row"><span
                                                        class="glyphicon glyphicon-remove"
                                                        aria-hidden="true"></span></a>
                                            <input type="text"
                                                   class="form-control form-group-sm item-input invoice_product"
                                                   name="invoice_product[]"
                                                   placeholder="Enter item title and / or description"
                                                   value="<?php echo $inv_item->item_name; ?>">
                                            <p class="item-select">or <a href="#">select an item</a></p>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group form-group-sm no-margin-bottom">
                                            <input type="text" class="form-control invoice_product_qty calculate"
                                                   name="invoice_product_qty[]"
                                                   value="<?php echo $inv_item->quantity; ?>">
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="input-group input-group-sm  no-margin-bottom">
                                            <span class="input-group-addon">$</span>
                                            <input type="text"
                                                   class="form-control calculate invoice_product_price required"
                                                   name="invoice_product_price[]" aria-describedby="sizing-addon1"
                                                   placeholder="0.00" value="<?php echo $inv_item->price; ?>">
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group form-group-sm  no-margin-bottom">
                                            <input type="text" class="form-control calculate"
                                                   name="invoice_product_discount[]"
                                                   placeholder="Enter % or value (ex: 10% or 10.50)"
                                                   value="<?php echo $inv_item->discount; ?>">
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control calculate-sub"
                                                   name="invoice_product_sub[]" id="invoice_product_sub"
                                                   aria-describedby="sizing-addon1"
                                                   value="<?php echo $inv_item->total; ?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                            </tbody>
                        </table>
                        <!--items end here-->
                        <div id="invoice_totals" class="padding-right row text-right">
                            <div class="col-xs-6 pull-right">
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Shipping (Frakt):</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-shipping">0.00</span>
                                        <input type="hidden" name="invoice_discount" id="invoice_shipping">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Sub Total(Belope fore Moms):</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-sub-total">0.00</span>
                                        <input type="hidden" name="invoice_subtotal" id="invoice_subtotal">
                                    </div>
                                </div>
                                <!-- <div class="row">
                                     <div class="col-xs-4 col-xs-offset-5">
                                         <strong>Discount:</strong>
                                     </div>
                                     <div class="col-xs-3">
                                         $<span class="invoice-discount">0.00</span>
                                         <input type="hidden" name="invoice_discount" id="invoice_discount">
                                     </div>
                                 </div>-->

                                <!--<div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong class="shipping">Shipping:</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control calculate shipping" name="invoice_shipping" aria-describedby="sizing-addon1" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>-->
                                <?php
                                define('ENABLE_VAT', true);
                                define('VAT_INCLUDED', false);
                                define('VAT_RATE', '25');
                                ?>
                                <?php if (ENABLE_VAT == true) { ?>
                                    <div class="row">
                                        <div class="col-xs-4 col-xs-offset-5">
                                            <strong>TAX/VAT (Moms):</strong><br>Remove TAX/VAT <input type="checkbox"
                                                                                                      class="remove_vat">
                                        </div>
                                        <div class="col-xs-3">
                                            $<span class="invoice-vat" data-enable-vat="<?php echo ENABLE_VAT ?>"
                                                   data-vat-rate="<?php echo VAT_RATE ?>"
                                                   data-vat-method="<?php echo VAT_INCLUDED ?>">0.00</span>
                                            <input type="hidden" name="invoice_vat" id="invoice_vat">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Rounding (Öresutjämning):</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-roundoff">0.00</span>
                                        <input type="hidden" name="invoice_roundoff" id="invoice_roundoff">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Tax Credit (Skattereduktion):</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-tax_credit">0.00</span>
                                        <input type="hidden" name="invoice_tax_credit" id="invoice_tax_credit">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-total">0.00</span>
                                        <input type="hidden" name="invoice_total" id="invoice_total">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 margin-top btn-group">
                                <input type="submit" class="btn btn-success float-right" value="Save Invoice"
                                       data-loading-text="Saving...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</body>
</html>
<?php
include 'footer.php';
?>


<div id="insert" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Select an item</h4>
            </div>
            <div class="modal-body">
                <select class="form-control item-select">
                    <option value="test">test</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="Rot" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
    <div class="modal-dialog vertical-align-center" role="document">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="CloseLabel">Enter ROT details</h4>
            </div>
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
                    <div class="form-group"><label class="col-lg-3 control-label">Bostadsrättsförenings org. nr</label>
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

<script>
    $('.datepicker').datepicker();

</script>
<script type="text/javascript">
    $(document).ready(function () {
        calculateTotal();
    });
</script>