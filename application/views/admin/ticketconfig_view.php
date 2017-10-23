<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/select2/select2.min.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/dataTables/datatables.min.css" rel="stylesheet">
';
$xfooter = '
<!-- Select2 -->
    <script src="' . base_url() . 'assets/plugins/select2/select2.full.min.js"></script>
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
';
include 'header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('settings'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html"><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('settings'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('ticket_config'); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<?php
foreach ($ini_types as $key) {
    $ini_type1 = $key->ini_type;
    $ini_type2[$ini_type1] = $key->ini_type;
}
$js1 = array('id' => 'ini_type', 'class' => 'js-example-basic-single', 'style' => 'width:100%');

foreach ($communities as $key) {
    $community = $key->community;
    $community1[$community] = $key->community;
}
$js2 = array('id' => 'community', 'class' => 'js-example-basic-single', 'style' => 'width:100%');
?>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" class="text-color"><h4><i
                                        class="fa fa-user-secret"></i> <?php echo $this->lang->line('ini_types'); ?>
                            </h4></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"><h4><i
                                        class="fa fa-group"></i> <?php echo $this->lang->line('communities'); ?></h4>
                        </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3"><h4><i class="fa fa-upload"
                                                                           aria-hidden="true"></i> <?php echo $this->lang->line('material_import'); ?>
                            </h4></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <?php echo form_open('settings/ticket-config/add_ini_type', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('add_ini_type'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="ini_type"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit" name="add_ini_type"><i
                                                class="fa fa-plus-circle"
                                                aria-hidden="true"></i> <?php echo $this->lang->line('add'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="hr-line-dashed"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover material" width="100%" border="0"
                                       cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Initiator Types</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($ini_types as $key) {
                                        echo '<tr>
                                        <th>' . $key->id . '</th>
                                        <th>' . $key->ini_type . '</th>
                                    </tr>';

                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <?php echo form_open('settings/ticket-config/add_community', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('add_community'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="community"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit" name="add_community"><i
                                                class="fa fa-plus-circle"
                                                aria-hidden="true"></i> <?php echo $this->lang->line('add'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="hr-line-dashed"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover material" width="100%" border="0"
                                       cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Community</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($communities as $key) {
                                        echo '<tr>
                                        <th>' . $key->id . '</th>
                                        <th>' . $key->community . '</th>
                                    </tr>';

                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <?php echo form_open_multipart('settings/ticket-config/material_import', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('select'); ?></label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" name="material_file">
                                    <small>Download Sample XML file <a
                                                href="<?php echo base_url(); ?>uploads/samples/material.xml"
                                                download="material_sample.xml">click here</a></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit" name="material_import"><i
                                                class="fa fa-upload"
                                                aria-hidden="true"></i> <?php echo $this->lang->line('upload'); ?>
                                    </button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="hr-line-dashed"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover material" width="100%" border="0"
                                       cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($items as $item) {
                                        echo '<tr>
                                        <th>' . $item->item_name . '</th>
                                        <th>' . $item->item_unit . '</th>
                                        <th>' . $item->item_quantity . '</th>
                                        <th>' . $item->item_price . '</th>
                                        <th>' . $item->item_discount . '</th>
                                        <th>' . $item->item_total . '</th>
                                    </tr>';

                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include 'footer.php'; ?>

</body>

</html>

<!-- Localized -->
<script>
    $(document).ready(function () {
        $('.material').DataTable({
            pageLength: 10,
            responsive: true,
        });

    });

</script>
