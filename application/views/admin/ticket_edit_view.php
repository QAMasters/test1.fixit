<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/iCheck/custom.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/select2/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Ladda style -->
    <link href="' . base_url() . 'assets/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
          
<style>
/* Social Icons */
#social_side_links {
    position: fixed;
  top: 180px;
  right: 0;
  padding: 0;
  list-style: none;
  z-index: 99;
}

#social_side_links li a {display: block;}

#social_side_links li a img {
    display: block;
    max-width:40px;
  padding: 10px;
  -webkit-transition:  background .2s ease-in-out;
  -moz-transition:  background .2s ease-in-out;
  -o-transition:  background .2s ease-in-out;
  transition:  background .2s ease-in-out;
}

#social_side_links li a:hover img {background: rgba(0, 0, 0, .2);}
  
body {background-color:#F8ECC9;}
</style>

';

$xfooter = '
<script src="' . base_url() . 'assets/plugins/moment/moment.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
<!-- iCheck -->
    <script src="' . base_url() . 'assets/plugins/iCheck/icheck.min.js"></script>

    <script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
    <!-- Sweet alert -->
    <script src="' . base_url() . 'assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="' . base_url() . 'assets/plugins/select2/select2.full.min.js"></script>

<!-- Ladda -->
    <script src="' . base_url() . 'assets/plugins/ladda/spin.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/ladda/ladda.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/ladda/ladda.jquery.min.js"></script>


';

include 'header.php';
?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-xs-7 col-sm-6 col-lg-8">
            <h2><?php echo $this->lang->line('tickets'); ?></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>dashboard"><?php echo $this->lang->line('home'); ?></a>
                </li>
                <li>
                    <a><?php echo $this->lang->line('tickets'); ?></a>
                </li>
                <li class="active">
                    <strong><?php echo $this->lang->line('edit'); ?></strong>
                </li>
            </ol>
        </div>
        <div class="col-xs-5 col-sm-6 col-lg-4">
            <div class="title-action">
                <?php
                if ($ticket->status == 'Draft') { ?>
                    <a href="<?php echo base_url(); ?>tickets/publish?ticket_id=<?php echo $ticket->ticket_id ?>&publish=true"
                       class="btn btn-warning"><i
                                class="fa fa-check-circle"></i> <?php echo $this->lang->line('publish'); ?></a>
                <?php } else { ?>
                    <a href="#Vendor" data-toggle="modal" data-hover="tooltip" title="Change Vendor"
                       data-placement="top" data-whatever="<?php echo $ticket->ticket_id; ?>" class="btn btn-danger"><i
                                class="fa fa-refresh fa-spin fa-fw"></i> <?php echo $this->lang->line('vendors'); ?>
                    </a>
                <?php } ?>
                <!--<a href="<?php echo base_url(); ?>tickets/new" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Ticket</a>-->
                <a class="btn btn-primary"
                   href="<?php echo base_url() ?>tickets/pdf?ticket_id=<?php echo $ticket->ticket_id; ?>"
                   target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
            </div>
        </div>
    </div>

<?php

$i_name = array('type' => 'text', 'name' => 'i_name', 'value' => $ticket->ini_name, 'placeholder' => $this->lang->line('phold_name'), 'class' => 'form-control', 'required' => 'required', 'data-error' => 'Please Enter Name');

$i_email = array('type' => 'email', 'name' => 'i_email', 'value' => $ticket->ini_email, 'placeholder' => $this->lang->line('phold_email'), 'class' => 'form-control');
$i_phone = array('type' => 'number', 'name' => 'i_phone', 'value' => $ticket->ini_phone, 'placeholder' => $this->lang->line('phold_phone'), 'class' => 'form-control', 'oninput' => 'this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;', 'maxlength' => '10', 'required' => 'required', 'data-minlength' => '10', 'min' => '0', 'data-error' => 'Please Enter Valid Phone Number');
$i_address = array('type' => 'text', 'name' => 'i_address', 'value' => $ticket->ini_address, 'placeholder' => $this->lang->line('phold_address'), 'class' => 'form-control');
$i_door_code = array('type' => 'text', 'name' => 'i_door_code', 'value' => $ticket->ini_doornum, 'placeholder' => $this->lang->line('phold_doorcode'), 'class' => 'form-control');
$i_desc = array('type' => 'textarea', 'name' => 'i_desc', 'value' => $ticket->description, 'placeholder' => $this->lang->line('phold_description'), 'class' => 'form-control', 'rows' => '4');

$js = array('class' => 'form-control', 'class' => 'select2_demo_3', 'style' => 'width:100%');
$options = array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No');

$ini_type2[''] = '';
foreach ($ini_types as $key) {
    $ini_type1 = $key->ini_type;
    $ini_type2[$ini_type1] = $key->ini_type;
}
$js1 = array('id' => 'ini_type', 'class' => '', 'style' => 'width:100%');
$js3 = array('id' => 'pets', 'class' => 'form-control select2_demo_3', 'style' => 'width:100%');

$pets_data = array('type' => 'text', 'name' => 'pets_data', 'value' => $ticket->pets_data, 'placeholder' => 'Enter Pets Information', 'class' => 'form-control');

$community1[''] = '';
foreach ($communities as $key) {
    $community = $key->community;
    $community1[$community] = $key->community;
}
$js2 = array('id' => 'community', 'class' => '', 'style' => 'width:100%');

$serv_opt = array('class' => 'select2_demo_3', 'onchange' => 'fetch_select(this.value);', 'style' => 'width:100%');
$sub_serv_opt = array('class' => 'select2_demo_3', 'id' => 'new_select', 'style' => 'width:100%');

//$form_submit = array('name' => 'submit', 'id' => '', 'type' => 'submit','content' => 'Update', 'class' => 'btn btn-success ticket_update');

//$form_reset = array('name' => 'reset', 'id' => 'btnClear', 'type' => 'reset', 'content' => $this->lang->line('reset'), 'class' => 'btn btn-default');
?>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row text-center" style="padding-bottom: 0.2cm;">
            <?php

            foreach ($tickets_array as $key) {
                $tkt_array[] = $key->ticket_id;
            }


            #current ticket id
            $current_value = $ticket->ticket_id;
            $current_key_value = array_search($current_value, $tkt_array);
            $last_key_value = count($tkt_array) - 1;
            if ($current_key_value >= 1) {
                $previous_value = $tkt_array[$current_key_value - 1];
                ?>
                <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                    <a class="btn btn-danger btn-rounded btn-sm btn-outline" href="<?php echo $previous_value; ?>">
                        << <?php echo $this->lang->line('previous_ticket'); ?></a></div>
                <?php
            }
            if ($current_key_value < $last_key_value) {
                $next_value = $tkt_array[$current_key_value + 1];
                ?>
                <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6 pull-right">
                    <a class="btn btn-danger btn-rounded btn-sm btn-outline"
                       href="<?php echo $next_value; ?>"><?php echo $this->lang->line('next_ticket'); ?> >> </a></div>
                <?php
            }
            ?>

        </div>

        <?php
        if (substr($ticket->status, 0, 11) == 'Assigned to') {
            $vendor = get_user_name($ticket->vendor)->fname;
        } else if (substr($ticket->status, 0, 11) == 'Accepted by') {
            $vendor = get_user_name($ticket->vendor)->fname;
        } else {
            $vendor = '';
        }
        ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-title">
                    <h5><?php echo '<font size="4"># ' . $ticket->ticket_id . '</font>' ?> </h5><span
                            class="label label-"></span>
                    <div class="ibox-tools" style="padding-right: 30px;">
                        <label class="label label-<?php echo status_label($ticket->status); ?>"
                               style="padding-top: 6px; padding-bottom: 6px;"><?php echo $ticket->status . $vendor ?></label>

                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle"
                                    aria-expanded="false">
                                <i class="fa fa-refresh"></i> Change Status <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url() . 'tickets/status/change?ticket_id=' . $ticket->ticket_id . '&status=done' ?>">Work
                                        Completed</a></li>
                                <li>
                                    <a href="<?php echo base_url() . 'tickets/status/change?ticket_id=' . $ticket->ticket_id . '&status=raiseinvoice' ?>">Request
                                        Invoice</a></li>
                            </ul>
                        </div>

                        <a href="event_download?ticket_id=<?php echo $ticket->ticket_id; ?>"
                           class="btn btn-primary btn-sm" data-hover="tooltip" title="Download Calendar Event"
                           data-placement="top"><i class="fa fa-download"></i> Event</a>
                        <a href="#Share" data-toggle="modal" data-whatever="<?php echo $ticket->ticket_id; ?>"
                           class="btn btn-primary btn-sm" data-hover="tooltip" title="Share Ticket via Email"
                           data-placement="top"><i class="fa fa-share-alt"></i> Share</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-7">
                <?php
                echo form_open_multipart('', 'data-toggle="validator"');
                echo form_hidden('ticket_id', $ticket->ticket_id);
                ?>
                <div class="ibox">
                    <a class="collapse-link" style="color: inherit;">
                        <div class="ibox-title">
                            <h5><?php echo $this->lang->line('lbl_pers_info'); ?></h5>&nbsp;
                            <input type="checkbox" class="emergency"
                                   name="emergency" <?php if ($ticket->emergency == '1') {
                                echo 'checked';
                            } ?> /> <font
                                    color="red"><?php echo $this->lang->line('emergency_high_priority'); ?> </font>
                            <div class="ibox-tools">
                                <i class="fa fa-chevron-up"></i>
                            </div>
                        </div>
                    </a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('name'); ?></label>
                                    <?php echo form_input($i_name); ?>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('phone'); ?></label>
                                    <div class="input-group"><span class="input-group-addon">+46</span>
                                        <?php echo form_input($i_phone); ?>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class=""><?php echo $this->lang->line('email'); ?></label>
                                    <?php echo form_input($i_email); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox collapsed">
                    <a class="collapse-link" style="color: inherit;">
                        <div class="ibox-title">
                            <h5><?php echo $this->lang->line('lbl_addr_info'); ?></h5>
                            <div class="ibox-tools">
                                <i class="fa fa-chevron-up"></i>
                            </div>
                        </div>
                    </a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('address'); ?></label>
                                    <?php echo form_input($i_address); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('door_code'); ?></label>
                                    <?php echo form_input($i_door_code); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('ini_type'); ?></label>
                                    <?php echo form_dropdown('ini_type', $ini_type2, $ticket->ini_type, $js1); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"><label class="control-label">Start Time</label>
                                    <input size="16" type="text" readonly class="start_datetime form-control"
                                           name="i_pref_s_time" value="<?php echo $ticket->pref_s_time; ?>"
                                           style="font-size:13px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"><label class="control-label">End Time</label>
                                    <input size="16" type="text" readonly class="end_datetime form-control"
                                           name="i_pref_e_time" value="<?php echo $ticket->pref_e_time; ?>"
                                           style="font-size:13px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('keys_tube'); ?></label>
                                    <?php echo form_dropdown('i_keys_tube', $options, $ticket->keys_tube, $js); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('pets_home'); ?></label>
                                    <?php echo form_dropdown('i_pets_home', $options, $ticket->pets_home, $js3); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('community'); ?></label>
                                    <?php echo form_dropdown('community', $community1, $ticket->community, $js2); ?>
                                </div>
                            </div>
                            <div class="col-sm-6" id="pets_data" style="display: none;">
                                <div class="form-group"><label class="control-label">Pets Data</label>
                                    <?php echo form_input($pets_data); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox collapsed">
                    <a class="collapse-link" style="color: inherit;">
                        <div class="ibox-title">
                            <h5><?php echo $this->lang->line('lbl_service_info'); ?></h5>
                            <div class="ibox-tools">
                                <i class="fa fa-chevron-up"></i>
                            </div>
                        </div>
                    </a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('location'); ?></label>
                                    <?php //echo form_dropdown('service', $services, $ticket->service, $serv_opt); ?>
                                    <select name="service" class="form-control select2_demo_3"
                                            onchange="fetch_select(this.value);" required="required"
                                            data-error="Please Select a Serice" style="width: 100%">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php foreach ($services as $service) { ?>
                                            <option value="<?php echo $service ?>" <?php if ($service == $ticket->service) {
                                                echo "selected";
                                            } ?> ><?php echo $this->lang->line($service) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('problem'); ?></label>
                                    <?php echo form_dropdown('sub_service', $sub_services, $ticket->sub_service, $sub_serv_opt); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"><label
                                            class="control-label"><?php echo $this->lang->line('description'); ?></label>
                                    <?php echo form_textarea($i_desc); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox collapsed">
                    <a class="collapse-link" style="color: inherit;">
                        <div class="ibox-title">
                            <h5>Images</h5>
                            <div class="ibox-tools">
                                <i class="fa fa-chevron-up"></i>
                            </div>
                        </div>
                    </a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"><label class="control-label">Selct Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"><label class="control-label">Images</label>
                                    <div class="lightBoxGallery">
                                        <?php
                                        $dir = 'uploads/ticket_images';
                                        $map = directory_map($dir);
                                        $ticket_id_hash = md5($ticket->ticket_id);
                                        foreach ($map as $key) {
                                            $file = substr($key, 0, 32);
                                            if ($ticket_id_hash == $file) {
                                                echo '<a href="' . base_url($dir) . '/' . $key . '"  data-gallery=""><img src="' . base_url($dir) . '/' . $key . '" width="80" height="80"></a>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">


                    <div>
                        <button type="submit"
                                class="ticket_update btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                        <button type="reset" onclick="window.history.go(-1);"
                                class="btn btn-warning"><?php echo $this->lang->line('close'); ?></button>
                        <?php //echo form_button($form_reset); ?>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-lg-5">
                <div class="ibox">
                    <div class="ibox-content">

                        <?php
                        $invoice_product = array('type' => 'text', 'name' => 'invoice_product[]', 'placeholder' => 'Enter item title and / or description', 'class' => 'form-control form-group-sm item-input invoice_product calculate auto');
                        $unit_options = array('hours' => 'Hours', 'pieces' => 'Pieces');
                        $js1 = array('id' => 'state', 'class' => 'form-control', 'style' => 'width:100%');
                        $invoice_product_qty = array('type' => 'text', 'name' => 'invoice_product_qty[]', 'class' => 'form-control invoice_product_qty calculate');
                        $invoice_product_price = array('type' => 'text', 'name' => 'invoice_product_price[]', 'placeholder' => '00.00', 'class' => 'form-control calculate invoice_product_price required', 'id' => 'invoice_product_price');
                        $invoice_product_discount = array('type' => 'text', 'name' => 'invoice_product_discount[]', 'placeholder' => 'Discount', 'class' => 'form-control calculate invoice_product_discount');
                        $invoice_product_surcharge = array('type' => 'text', 'name' => 'invoice_product_surcharge[]', 'placeholder' => 'Surcharge', 'class' => 'form-control calculate invoice_product_surcharge');
                        $invoice_product_sub = array('type' => 'text', 'name' => 'invoice_product_sub[]', 'class' => 'form-control invoice_product_sub calculate-sub', 'id' => 'invoice_product_sub', 'readonly' => '');

                        ?>
                        <?php echo form_open('tickets/add_material'); ?>
                        <input type="hidden" name="ticket_id" value="<?php echo $ticket->ticket_id; ?>">
                        <div class="table-responsive m-t">
                            <table class="table table-bordered table-responsive" id="invoice_table">
                                <thead>
                                <tr>
                                    <th width="5%"><a href="#" class="btn btn-primary btn-xs add-row"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></th>
                                    <th width="30%">Item</th>
                                    <th width="10%">Unit</th>
                                    <th width="15%">Qty</th>
                                    <th width="10%">Price</th>
                                    <th width="15%">Disc %</th>
                                    <th width="15%">Sur %</th>
                                    <th width="13%">Sub Total</th>
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
                                                <?php echo form_input($invoice_product_surcharge, ''); ?>
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
                        <div class="">
                            <button class="btn btn-success btn-sm" name="add_material"><i class="fa fa-plus-circle"></i>
                                Add
                            </button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">

                <div class="ibox">
                    <div class="ibox-title ui-sortable-handle">
                        <h5><?php echo $this->lang->line('comments'); ?></h5>
                    </div>
                    <div class="ibox-content">
                        <form method="POST" class="addcomment" action="addcomment">
                            <input type="hidden" name="ticket_id" value="<?php echo $ticket->ticket_id; ?>">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your message" rows="3" name="comment"
                                          required></textarea>
                            </div>
                            <label> <input type="checkbox" class="private_comment" name="private" checked> <font
                                        color="#f8ac5a"> <?php echo $this->lang->line('make_private'); ?> </font></label>

                            <button type="submit" class="btn btn-success btn-block" name="addcomment"
                                    class="addcomment"><?php echo $this->lang->line('add_comment'); ?></button>
                        </form>
                        <?php
                        foreach ($comments as $key) {
                            ?>
                            <div id="vertical-timeline" class="vertical-container light-timeline no-margins">

                                <div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon yellow-bg">
                                        <i class="fa fa-comments"></i>
                                    </div>

                                    <div class="vertical-timeline-content">
                                        <h3><?php $user = get_user_name($key->commented_by);
                                            echo $user->fname;
                                            if ($key->private == 1) {
                                                echo ' <span class="label label-danger">PRIVATE</span>';
                                            }
                                            ?>
                                            <small class="text-navy pull-right"><?php echo $key->commented_on; ?></small>
                                        </h3>
                                        <p><?php echo $key->comments; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Social Icons 
<ul id="social_side_links">
    <li><a href="#Share" data-toggle="modal" data-hover="tooltip" title="Share via Email" data-placement="top" data-whatever="<?php echo $ticket->ticket_id; ?>" class="btn btn-warning btn-outline"><i class="fa fa-share"></i> <?php echo $this->lang->line('share'); ?></a></li>
</ul>-->

<?php
include 'footer.php';
?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#ini_type').select2({
                placeholder: "<?php echo $this->lang->line('type_or_add');?>",
                tags: true,
                tokenSeparators: [",", ""],
                createTag: function (newTag) {
                    return {
                        id: newTag.term,
                        text: newTag.term + ' (new)'
                    };
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#community').select2({
                placeholder: "<?php echo $this->lang->line('type_or_add');?>",
                tags: true,
                tokenSeparators: [",", ""],
                createTag: function (newTag) {
                    return {
                        id: newTag.term,
                        text: newTag.term + ' (new)'
                    };
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(".select2_demo_3").select2({
            placeholder: "Select",
            allowClear: true
        });
    </script>

    <script type="text/javascript">
        $(".start_datetime").datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            //startDate: "2017-10-14 10:00",
            autoclose: true
        });
    </script>

    <script type="text/javascript">
        $(".start_datetime").change(function () {
            $('.end_datetime').datetimepicker('remove');
            var s_date = this.value;
            $(".end_datetime").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                startDate: s_date,
                autoclose: true
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.private_comment').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
            });
            $('.emergency').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red',
            });
        });
    </script>

    <script>
        $(function () {
            $(".addcomment").submit(function () {
                $.post($(this).attr("action"),
                    $(this).serialize(),
                    function (response) {
                        swal({title: response, text: "", type: "success",});
                        location.reload(true);
                    });
                $(this)[0].reset();
                return false;
            });
        });
    </script>

<?php if (!empty($success)) { ?>
    <script>
        $(document).ready(function () {
            var msg = "<?php echo $success; ?> ";

            swal({
                title: msg,
                text: "",
                type: "success",
            });
        });
    </script>
<?php } ?>

    <script>
        $(document).ready(function () {
            var x = $("#pets").val();
            if (x == 'Yes') {
                $("#pets_data").show();
            } else {
                $("#pets_data").hide();
            }
            $("#pets").change(function () {
                var x = $("#pets").val();
                if (x == 'Yes') {
                    $("#pets_data").show();
                } else {
                    $("#pets_data").hide();
                }
            });
        });
    </script>
    <script type="text/javascript">
        function fetch_select(val) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>fetchservice',
                data: {
                    get_option: val
                },
                success: function (response) {
                    document.getElementById("new_select").innerHTML = response;
                }
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $('.ticket_update').click(function () {
                $(this).attr('disabled', 'disabled');
                $(this).parents('form').submit()
            })
        });
    </script>

    </body>

    </html>

    <!-- Localized -->
    <!--============================= Modal====================-->
    <div class="modal fade" id="Vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2><i class="fa fa-refresh fa-spin fa-fw"></i> <?php echo $this->lang->line('change_vendor'); ?>
                    </h2>
                </div>
                <?php echo form_open('tickets/status/change'); ?>
                <div class="modal-body">
                    <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                    <input type="hidden" name="vendorchange" class="form-control" id="recipient-name">
                    <h4>Current Vendor : <?php if ($ticket->vendor != '') {
                            echo get_user_name($ticket->vendor)->fname;
                        } else {
                            echo "Not Assigned";
                        } ?></h4>
                    <div class="form-group">
                        <?php echo form_dropdown('vendor', $vendor_array, $ticket->vendor, $js); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-small btn-success" type="submit"
                            name="avatar"><?php echo $this->lang->line('update'); ?></button>
                    <button type="button" class="btn btn-warning"
                            data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript">
        $("#Vendor").on("show.bs.modal", function (e) {
            var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
            o.find(".modal-body input").val(t)
        });
    </script>

<?php
$invoice_product = array('type' => 'text', 'name' => 'invoice_product', 'placeholder' => 'Enter item title and / or description', 'class' => 'form-control form-group-sm item-input invoice_product calculate');
$unit_options = array('hours' => 'Hours', 'pieces' => 'Pieces');
$js1 = array('id' => 'state', 'class' => 'form-control', 'style' => 'width:100%');
$invoice_product_qty = array('type' => 'text', 'name' => 'invoice_product_qty', 'class' => 'form-control invoice_product_qty calculate');
$invoice_product_price = array('type' => 'text', 'name' => 'invoice_product_price', 'placeholder' => '00.00', 'class' => 'form-control calculate invoice_product_price required');
$invoice_product_discount = array('type' => 'text', 'name' => 'invoice_product_discount', 'placeholder' => 'Enter % or value (ex: 10% or 10.50)', 'class' => 'form-control calculate invoice_product_discount');
$invoice_product_sub = array('type' => 'text', 'name' => 'invoice_product_sub', 'class' => 'form-control calculate-sub invoice_product_sub', 'id' => 'invoice_product_sub', 'readonly' => '');

?>

    <!--Material modal-->
    <div class="modal fade" id="Material" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2><i class="fa fa-plus-circle"></i> Add Material</h2>
                </div>
                <?php echo form_open('tickets/add_material'); ?>
                <div class="modal-body">

                    <div class="form-group ticket_id">
                        <input type="hidden" name="ticket_id" class="form-control" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-small btn-success" type="submit" name="avatar">Add</button>
                    <button type="button" class="btn btn-warning"
                            data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript">
        $("#Material").on("show.bs.modal", function (e) {
            var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
            o.find(".ticket_id input").val(t)
        });
    </script>
    <!--share modal-->
    <div class="modal fade" id="Share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2><i class="fa fa-share-alt-square"></i> <?php echo $this->lang->line('share_ticket'); ?></h2>
                </div>
                <?php echo form_open('tickets/share_ticket'); ?>
                <div class="modal-body">

                    <div class="form-group ticket_id">
                        <input type="text" name="ticket_id" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control"
                               placeholder="<?php echo $this->lang->line('enter_email'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-small btn-success" type="submit" name="avatar">Share</button>
                    <button type="button" class="btn btn-warning"
                            data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript">
        $("#Share").on("show.bs.modal", function (e) {
            var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
            o.find(".ticket_id input").val(t)
        });
    </script>

    <script type="text/javascript">
        $("[data-hover='tooltip']").tooltip();
    </script>

<?php include 'invoice_cal.php' ?>