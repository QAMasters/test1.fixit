<?php
$xheader = '
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<link href="' . base_url() . 'assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

';
$xfooter = '
<script src="' . base_url() . 'assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="' . base_url() . 'assets/plugins/moment/moment.min.js"></script>
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
<script src="' . base_url() . 'assets/invoice/bootstrap.datetime.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="' . base_url() . 'assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
';
include 'header.php';
?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-xs-7 col-sm-6 col-lg-8">
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
        <div class="col-xs-5 col-sm-6 col-lg-4">
            <div class="title-action">
                <button id="send" class="btn btn-danger"><i class="fa fa-send"></i> Send</button>
                <a class="btn btn-primary"
                   href="<?php echo base_url() ?>invoice/pdf?ticket_id=<?php echo $tic->ticket_id; ?>"
                   target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
            </div>
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
                                    <img src="<?php echo base_url('uploads/logo/') . $appconfig->logo; ?>" width="300"
                                         height="200">
                                </div>
                                <div class="col-sm-6 table-responsive m-t">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="4" width="800px"><h1 align="center">
                                                    <b><?php echo $this->lang->line('invoice'); ?></b></h1></th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td align="center" width="25%" height="50px">
                                                <b><?php echo $this->lang->line('invoice_number'); ?></b>
                                                <br><?php echo $inv->invoice_id; ?></td>
                                            <td align="center" width="25%">
                                                <b><?php echo $this->lang->line('customer_number'); ?></b> <br></td>
                                            <td align="center" width="25%">
                                                <b><?php echo $this->lang->line('invoice_date'); ?></b> <br><input
                                                        class="datepicker" data-date-format="yyyy-mm-dd"
                                                        value="<?php echo $inv->invoice_date; ?>" name="invoice_date">
                                            </td>
                                            <td align="center" width="25%">
                                                <b><?php echo $this->lang->line('page'); ?></b> <br>1
                                            </td>
                                        </tr>
                                        <tr style="vertical-align: top; text-align: left;">
                                            <td colspan="4" width="25%" height="100px">
                                                <b><?php echo $this->lang->line('billing_address'); ?></b><br><?php echo $tic->ini_name . "<br>" . $tic->ini_address; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="50%" height="20px">
                                        <b><?php echo $this->lang->line('var_reference'); ?></b>
                                        : <?php if ($tic->vendor != '') {
                                            echo get_user_name($tic->vendor)->fname;
                                        } ?></td>
                                    <td width="50%"><b><?php echo $this->lang->line('terms_of_payment'); ?></b> :
                                        <select name="bill_due" class="" style=""
                                                onchange="change_bill_due(this.value);">
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
                                    <td width="50%" height="20px">
                                        <b><?php echo $this->lang->line('your_reference'); ?></b>
                                        : <?php echo $tic->ini_name; ?></td>
                                    <td width="50%"><b><?php echo $this->lang->line('expiration_date'); ?></b>
                                        : <?php echo date('Y-m-d', strtotime($inv->invoice_date . ' + ' . $inv->bill_due . ' days')); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" height="20px">
                                        <b><?php echo $this->lang->line('your_order_number'); ?></b>
                                        : <?php echo $tic->ticket_id; ?></td>
                                    <td width="50%"></td>
                                </tr>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <td><?php echo $this->lang->line('description'); ?></td>
                                </tr>
                                <tr>
                                    <td><textarea class="form-control"
                                                  name="description"><?php echo $inv->description ?></textarea>
                                    </td>
                                </tr>
                            </table>
                            <h4><?php echo $this->lang->line('rot_status'); ?>: <?php echo $inv->rot; ?> <font
                                        size="2px"><a href='#Rot' data-toggle='modal' data-hover='tooltip'
                                                      title='ROT details' data-placement='top'
                                                      data-whatever="<?php echo $tic->ticket_id; ?>"
                                                      class=''> <?php echo $this->lang->line('view_add_rot'); ?></a></font>
                            </h4><br>
                            <!-- / end client details section -->
                            <!--items start here-->
                            <?php
                            $invoice_product = array('type' => 'text', 'name' => 'invoice_product[]', 'placeholder' => $this->lang->line('phold_item_name'), 'class' => 'form-control form-group-sm item-input invoice_product calculate auto');
                            $unit_options = array('hours' => 'Hours', 'pieces' => 'Pieces');
                            $js1 = array('id' => 'state', 'class' => 'form-control invoice_product_unit', 'style' => 'width:100%');
                            $invoice_product_qty = array('type' => 'text', 'name' => 'invoice_product_qty[]', 'class' => 'form-control invoice_product_qty calculate');
                            $invoice_product_price = array('type' => 'text', 'name' => 'invoice_product_price[]', 'placeholder' => $this->lang->line('phold_item_price'), 'class' => 'form-control calculate invoice_product_price required', 'id' => 'invoice_product_price');
                            $invoice_product_discount = array('type' => 'text', 'name' => 'invoice_product_discount[]', 'placeholder' => $this->lang->line('phold_item_discount'), 'class' => 'form-control calculate invoice_product_discount');
                            $invoice_product_surcharge = array('type' => 'text', 'name' => 'invoice_product_surcharge[]', 'placeholder' => $this->lang->line('phold_item_surcharge'), 'class' => 'form-control calculate invoice_product_surcharge');
                            $invoice_product_sub = array('type' => 'text', 'name' => 'invoice_product_sub[]', 'class' => 'form-control invoice_product_sub calculate-sub', 'id' => 'invoice_product_sub', 'readonly' => '');

                            ?>
                            <div class="table-responsive m-t">
                                <table class="table table-bordered table-responsive" id="invoice_table">
                                    <thead>
                                    <tr>
                                        <th><h4><a href="#" class="btn btn-primary btn-xs add-row"><span
                                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                            </h4></th>
                                        <th width="30%"><h4><?php echo $this->lang->line('item'); ?></h4></th>
                                        <th width="10%"><h4><?php echo $this->lang->line('unit'); ?></h4></th>
                                        <th><h4><?php echo $this->lang->line('quantity'); ?></h4></th>
                                        <!--                                        <th width="10%"><h4>-->
                                        <?php //echo $this->lang->line('price'); ?><!--</h4></th>-->
                                        <!--                                        <th width="9%"><h4>-->
                                        <?php //echo $this->lang->line('discount'); ?><!-- %</h4></th>-->
                                        <!--                                        <th width="10%"><h4>-->
                                        <?php //echo $this->lang->line('surcharge'); ?><!-- %</h4></th>-->
                                        <!--                                        <th width="13%"><h4>-->
                                        <?php //echo $this->lang->line('sub_total'); ?><!--</h4></th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($inv_items as $inv_item) { ?>
                                        <tr>
                                            <td>
                                                <div class="form-group form-group-sm  no-margin-bottom"><a href="#"
                                                                                                           class="btn btn-danger btn-xs delete-row"><span
                                                                class="glyphicon glyphicon-remove"
                                                                aria-hidden="true"></span></a></div>
                                            </td>
                                            <td>
                                                <div class="form-group-sm  no-margin-bottom">
                                                    <?php echo form_input($invoice_product, $inv_item->item_name); ?>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group form-group-sm no-margin-bottom">
                                                    <?php echo form_dropdown('unit[]', $unit_options, $inv_item->unit, $js1); ?>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group form-group-sm no-margin-bottom">
                                                    <?php echo form_input($invoice_product_qty, $inv_item->quantity); ?>
                                                </div>
                                            </td>
                                            <td class="text-right" width="10%">
                                                <div class="input-group input-group-sm  no-margin-bottom">
                                                    <?php echo form_input($invoice_product_price, $inv_item->price); ?>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="form-group form-group-sm  no-margin-bottom">
                                                    <?php echo form_input($invoice_product_discount, $inv_item->discount); ?>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="form-group form-group-sm  no-margin-bottom">
                                                    <?php echo form_input($invoice_product_surcharge, $inv_item->surcharge); ?>
                                                </div>
                                            </td>
                                            <td class="text-right" width="10%">
                                                <div class="input-group input-group-sm">
                                                    <?php echo form_input($invoice_product_sub, $inv_item->sub_total); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!--empty row -->
                                    <tr>
                                        <td>
                                            <div class="form-group form-group-sm  no-margin-bottom"><a href="#"
                                                                                                       class="btn btn-danger btn-xs delete-row"><span
                                                            class="glyphicon glyphicon-remove"
                                                            aria-hidden="true"></span></a></div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm  no-margin-bottom">
                                                <?php echo form_input($invoice_product); ?>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="form-group form-group-sm no-margin-bottom">
                                                <?php echo form_dropdown('unit[]', $unit_options, '', $js1); ?>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="form-group form-group-sm no-margin-bottom">
                                                <?php echo form_input($invoice_product_qty, '1'); ?>
                                            </div>
                                        </td>
                                        <td class="text-right" width="10%">
                                            <div class="input-group input-group-sm  no-margin-bottom">
                                                <?php echo form_input($invoice_product_price); ?>
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="form-group form-group-sm  no-margin-bottom">
                                                <?php echo form_input($invoice_product_discount); ?>
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="form-group form-group-sm  no-margin-bottom">
                                                <?php echo form_input($invoice_product_surcharge); ?>
                                            </div>
                                        </td>
                                        <td class="text-right" width="10%">
                                            <div class="input-group input-group-sm">
                                                <?php echo form_input($invoice_product_sub, '0.00'); ?></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--items end here-->
                            <div id="invoice_totals" class="padding-right row text-right">

                                <div class="col-xs-4 pull-right">
                                    <table class="table-responsive">
                                        <tr>
                                            <td width="50%">
                                                <div class="row">
                                                    <div class="col-xs-4 col-xs-offset-5">
                                                        <strong><?php echo $this->lang->line('shipping'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <span class="invoice-shipping">00.00</span>
                                                        <input type="hidden" name="invoice_discount"
                                                               id="invoice_shipping">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-4 col-xs-offset-5">
                                                        <strong><?php echo $this->lang->line('sub_total'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <span class="invoice-sub-total">00.00</span>
                                                        <input type="hidden" name="invoice_subtotal"
                                                               id="invoice_subtotal">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                define('ENABLE_VAT', true);
                                                define('VAT_INCLUDED', false);
                                                define('VAT_RATE', '25');
                                                ?>
                                                <?php if (ENABLE_VAT == true) { ?>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-xs-offset-5">
                                                            <strong><?php echo $this->lang->line('tax_vat'); ?>
                                                                :</strong>
                                                            <!--<br>Remove TAX/VAT <input type="checkbox" class="remove_vat">-->
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <span class="invoice-vat"
                                                                  data-enable-vat="<?php echo ENABLE_VAT ?>"
                                                                  data-vat-rate="<?php echo VAT_RATE ?>"
                                                                  data-vat-method="<?php echo VAT_INCLUDED ?>">0.00</span>
                                                            <input type="hidden" name="invoice_vat" id="invoice_vat">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-4 col-xs-offset-5">
                                                        <strong><?php echo $this->lang->line('rounding'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <span class="invoice-roundoff">00.00</span>
                                                        <input type="hidden" name="invoice_roundoff"
                                                               id="invoice_roundoff">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-4 col-xs-offset-5">
                                                        <strong><?php echo $this->lang->line('tax_credit'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <span class="invoice-tax_credit">00.00</span>
                                                        <input type="hidden" name="invoice_tax_credit"
                                                               id="invoice_tax_credit">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-4 col-xs-offset-5">
                                                        <strong><?php echo $this->lang->line('total'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <span class="invoice-total">00.00</span>
                                                        <input type="hidden" name="invoice_total" id="invoice_total">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xs-12 margin-top btn-group">
                                    <input type="submit" class="btn btn-success float-right"
                                           value="<?php echo $this->lang->line('save_invoice'); ?>"
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

    <div class="modal fade" id="Rot" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="CloseLabel"><?php echo $this->lang->line('enter_rot'); ?></h4>
                </div>
                <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>invoices/update_rot"
                      data-toggle="validator">
                    <input type="hidden" name="ticket_id" class="form-control ticket_id"
                           value="<?php echo $tic->ticket_id; ?>">
                    <div class="modal-body">
                        <div class="form-group"><label
                                    class="col-lg-5 control-label"><?php echo $this->lang->line('rot_label1'); ?></label>
                            <div class="col-lg-7"><input type="text" name="label1"
                                                         value="<?php if (isset($rot->label1)) {
                                                             echo $rot->label1;
                                                         } ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-lg-5 control-label"><?php echo $this->lang->line('rot_label2'); ?></label>
                            <div class="col-lg-7"><input type="text" name="label2"
                                                         value="<?php if (isset($rot->label2)) {
                                                             echo $rot->label2;
                                                         } ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-lg-5 control-label"><?php echo $this->lang->line('rot_label3'); ?></label>
                            <div class="col-lg-7"><input type="text" name="label3"
                                                         value="<?php if (isset($rot->label3)) {
                                                             echo $rot->label3;
                                                         } ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group"><label
                                    class="col-lg-5 control-label"><?php echo $this->lang->line('rot_label4'); ?></label>
                            <div class="col-lg-7"><input type="number" name="personal_number"
                                                         value="<?php if (isset($rot->personal_number)) {
                                                             echo $rot->personal_number;
                                                         } ?>" class="form-control" placeholder="yyyymmddaaaa" min="0"
                                                         maxlength="12"
                                                         oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;"
                                                         required="" data-minlength="12">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="<?php echo $this->lang->line('add_rot_data'); ?>" name="rot"
                               class="btn btn-success"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('.datepicker').datepicker({
            autoclose: true,
        });
        var datePicker = $('.datepicker').datepicker().on('changeDate', function (ev) {
            //Functionality to be called whenever the date is changed
            $.ajax
            ({
                type: "GET",
                url: "<?php echo base_url()?>invoice/invoice_date_change",
                data: "ticket_id=<?php echo $tic->ticket_id;?>&date=" + this.value,
                success: function (result) {
                    location.reload();
                }
            });
        });
    </script>

    <script type="text/javascript">
        function change_bill_due(val) {
            $.ajax
            ({
                type: "GET",
                url: "<?php echo base_url()?>invoice/change_bill_due",
                data: "ticket_id=<?php echo $tic->ticket_id;?>&bill_due=" + val,
                success: function (result) {
                    location.reload();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#send").click(function () {
                $.get("<?php echo base_url();?>invoice/send_email?ticket_id=<?php echo $tic->ticket_id;?>", function (data) {
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

<?php include 'invoice_cal.php' ?>