<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/switchery/switchery.css" rel="stylesheet">

';

include 'header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-7 col-sm-6 col-lg-8">
        <h2><?php echo $this->lang->line('vendors'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>dashboard"><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('vendors'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('new'); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-xs-5 col-sm-6 col-lg-4">
        <div class="title-action">

            <a href="<?php echo base_url(); ?>vendors/new" class="btn btn-success"><i
                        class="fa fa-user-plus"></i> <?php echo $this->lang->line('add_vendor'); ?></a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('lbl_vendor_edit'); ?></h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action=" " method="post" data-toggle="validator">
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo $this->lang->line('fname'); ?></label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon"><i
                                                class="glyphicon glyphicon-user"></i></span>
                                    <input name="fname" placeholder="First Name" class="form-control" type="text"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-md-4 control-label"><?php echo $this->lang->line('lname'); ?></label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon"><i
                                                class="glyphicon glyphicon-user"></i></span>
                                    <input name="lname" placeholder="Last Name" class="form-control" type="text"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-md-4 control-label"><?php echo $this->lang->line('email'); ?></label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon"><i
                                                class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="email" placeholder="E-Mail Address" class="form-control" type="text"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-md-4 control-label"><?php echo $this->lang->line('phone'); ?> #</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon">+46</span>
                                    <input name="phone" placeholder="<?php echo $this->lang->line('phold_phone'); ?>"
                                           class="form-control" type="number"
                                           oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;"
                                           maxlength="10" min="0" required data-minlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-md-4 control-label"><?php echo $this->lang->line('password'); ?></label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon"><i
                                                class="glyphicon glyphicon-user"></i></span>
                                    <input name="password" placeholder="Enter Password" class="form-control"
                                           type="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label
                                    class="col-md-4 control-label"><?php echo $this->lang->line('status'); ?></label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <input type="checkbox" class="js-switch" name="status" checked=""/>
                                    <span class="help-block"><?php echo $this->lang->line('enable'); ?>
                                        /<?php echo $this->lang->line('disable'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-md-4 control-label"></label>
                            <div class="col-md-4 inputGroupContainer">
                                <button type="submit"
                                        class="btn btn-warning"><?php echo $this->lang->line('submit'); ?></button>
                                <button type="reset" class="btn btn-default"
                                        onclick="javascript:window.location='<?php echo base_url(); ?>vendors/active';"><?php echo $this->lang->line('cancel'); ?></button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- Switchery -->
<script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.js"></script>

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

<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>

<?php if (isset($success)) { ?>
    <script>
        $(document).ready(function () {
            swal({
                title: "Vendor Created Successfully!",
                text: "",
                type: "success"
            });
        });
    </script>
<?php } ?>

<script type="text/javascript">
    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {color: '#1c84c6'});
</script>
</body>

</html>

<!-- Localized -->