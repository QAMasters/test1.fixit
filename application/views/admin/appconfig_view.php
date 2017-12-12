<?php
$xheader = '

';
$xfooter = '';
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
                <strong><?php echo $this->lang->line('app_config'); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" class="text-color"><h4><i
                                        class="fa fa-home"></i> <?php echo $this->lang->line('company_config'); ?></h4>
                        </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"><h4><i
                                        class="fa fa-gear"></i> <?php echo $this->lang->line('app_config'); ?></h4></a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-3"><h4><i
                                        class="fa fa-money"></i> <?php echo $this->lang->line('bank_details'); ?></h4>
                        </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4"><h4><i
                                        class="fa fa-file"></i> <?php echo $this->lang->line('invoice'); ?></h4></a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-5"><h4><i
                                        class="fa fa-camera-retro"></i> <?php echo $this->lang->line('logo'); ?></h4>
                        </a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <?php echo form_open('settings/appconfig/update', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('company_name'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="c_name"
                                                             value="<?php echo $appconfig->c_name; ?>"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('email'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="email"
                                                             value="<?php echo $appconfig->email; ?>"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('address'); ?></label>
                                <div class="col-sm-6"><textarea class="form-control"
                                                                name="address"><?php echo $appconfig->address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit"
                                            name="comp_update"><?php echo $this->lang->line('update'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <?php echo form_open('settings/appconfig/update', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('title'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="title"
                                                             value="<?php echo $appconfig->title; ?>"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('footer'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="footer"
                                                             value="<?php echo $appconfig->footer; ?>"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit"
                                            name="app_update"><?php echo $this->lang->line('update'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <?php echo form_open('settings/appconfig/update', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('company_name'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control"
                                                             value="<?php echo $bank_details->c_name; ?>" name="c_name">
                                </div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('phone'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control"
                                                             value="<?php echo $bank_details->phone; ?>" name="phone">
                                </div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('account_number'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control"
                                                             value="<?php echo $bank_details->ac_num; ?>" name="ac_num">
                                </div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('email'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->email; ?>" name="email">
                                </div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('website'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->website; ?>"
                                                             name="website"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('bank_data1'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->d1; ?>" name="d1"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('bank_data2'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->d2; ?>" name="d2"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('bank_data3'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->d3; ?>" name="d3"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('bank_data4'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->d4; ?>" name="d4"></div>
                            </div>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('bank_data5'); ?></label>
                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control"
                                                             value="<?php echo $bank_details->d5; ?>" name="d5"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit"
                                            name="bank_update"><?php echo $this->lang->line('update'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            <?php echo form_open('settings/appconfig/update', 'class="form-horizontal"'); ?>
                            <div class="form-group"><label
                                        class="col-sm-3 control-label"><?php echo $this->lang->line('rot_data'); ?></label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="rot_data"
                                                             value="<?php echo $appconfig->rot_data; ?>"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit"
                                            name="inv_update"><?php echo $this->lang->line('save_changes'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-5" class="tab-pane">
                        <div class="panel-body">
                            <?php echo form_open_multipart('settings/appconfig/update', 'class="form-horizontal"'); ?>
                            <div class="form-group text-center">

                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label"></label>
                                <div class="col-sm-6">
                                    <img src="<?php echo base_url('uploads/logo/') . $appconfig->logo; ?>" width="100px"
                                         height="100px">
                                    <br><br>
                                    <input type="file" class="form-control" name="logo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-success" type="submit"
                                            name="logo_upload"><?php echo $this->lang->line('save_changes'); ?></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
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
<script type="text/javascript">
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    })
</script>