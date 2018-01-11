<?php
$xheader = '
<link href="' . base_url() . 'assets1/plugins/pricing-tables/css/style.css" rel="stylesheet" type="text/css">
<link href="' . base_url() . 'assets1/css/landing1.css" rel="stylesheet" type="text/css"/>
<link href="' . base_url() . 'assets1/custom.css" rel="stylesheet" type="text/css">
<link href="' . base_url() . 'assets/plugins/iCheck/custom.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/select2/select2.min.css" rel="stylesheet">
';
$xfooter = '
<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
<script src="' . base_url() . 'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="' . base_url() . 'assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
';
include 'header.php';
?>
<body>
<nav id="header" class="navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="#">FiXiT</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><?php echo $this->lang->line('home'); ?></a></li>
                <li><a href="" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('login'); ?></a>
                </li>
                <li class="dropdown">
                    <?php
                    if ($pref_lang == 'en') {
                        echo '<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="false"><img src="' . base_url() . 'assets/img/flags/us.png" width="20px" height="15px"> EN <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="#" id="lang"><img src="' . base_url() . 'assets/img/flags/sw.png" width="20px" height="20px"> SW</a></li></ul>';
                        $new_lang = 'sw';

                    } else if ($pref_lang == 'sw') {
                        echo '<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="false"><img src="' . base_url() . 'assets/img/flags/sw.png" width="20px" height="15px"> SW <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="#" id="lang"><img src="' . base_url() . 'assets/img/flags/us.png" width="20px" height="20px"> EN</a></li></ul>';
                        $new_lang = 'en';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="home" id="home">
    <div class="overlay"></div>

</div>


<div id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10"
                 data-wow-delay="0.5s">
                <h2><?php echo $this->lang->line('create_new_ticket'); ?></h2>     <em>
                    <?php echo $this->lang->line('create_new_ticket_lbl'); ?>
                </em>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($n_ticket)) {
    $n_name = $n_ticket->ini_name;
    $n_email = $n_ticket->ini_email;
    $n_phone = $n_ticket->ini_phone;
    $n_address = $n_ticket->ini_address;
    $n_door_code = $n_ticket->ini_doornum;
    $n_ini_type = $n_ticket->ini_type;
    $n_pref_s_time = $n_ticket->pref_s_time;
    $n_pref_e_time = $n_ticket->pref_e_time;
    $n_keys_tube = $n_ticket->keys_tube;
    $n_pets_home = $n_ticket->pets_home;
    $n_pets_data = $n_ticket->pets_data;
    $n_community = $n_ticket->community;
    $n_description = $n_ticket->description;
} else {
    $n_name = '';
    $n_email = '';
    $n_phone = '';
    $n_address = '';
    $n_door_code = '';
    $n_ini_type = '';
    $n_pref_s_time = '';
    $n_pref_e_time = '';
    $n_keys_tube = '';
    $n_pets_home = '';
    $n_pets_data = '';
    $n_community = '';
    $n_description = '';
}

$js = array('class' => 'form-control', 'class' => 'select2_demo_3', 'style' => 'width:100%');
$options = array('placeholder' => $this->lang->line('select'), 'Yes' => $this->lang->line('yes'), 'No' => $this->lang->line('no'));

$i_name = array('type' => 'text', 'name' => 'i_name', 'value' => $n_name, 'placeholder' => $this->lang->line('phold_name'), 'class' => 'form-control', 'required' => 'required', 'data-error' => $this->lang->line('please_enter_name'));

$i_email = array('type' => 'email', 'name' => 'i_email', 'value' => $n_email, 'placeholder' => $this->lang->line('phold_email'), 'class' => 'form-control', 'required' => 'required', 'data-error' => $this->lang->line('enter_email'));
$i_phone = array('type' => 'number', 'name' => 'i_phone', 'value' => $n_phone, 'placeholder' => $this->lang->line('phold_phone'), 'class' => 'form-control', 'oninput' => 'this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;', 'maxlength' => '10', 'required' => 'required', 'data-minlength' => '10', 'min' => '0', 'data-error' => $this->lang->line('enter_valid_phone_number'));
$i_address = array('type' => 'text', 'name' => 'i_address', 'value' => $n_address, 'placeholder' => $this->lang->line('phold_address'), 'class' => 'form-control');
$i_door_code = array('type' => 'text', 'name' => 'i_door_code', 'value' => $n_door_code, 'placeholder' => $this->lang->line('phold_doorcode'), 'class' => 'form-control');

$ini_type2[''] = '';
foreach ($ini_types as $key) {
    $ini_type1 = $key->ini_type;
    $ini_type2[$ini_type1] = $key->ini_type;
}
$js1 = array('id' => 'state', 'class' => '', 'style' => 'width:100%');

$js3 = array('id' => 'pets', 'class' => 'select2_demo_3', 'style' => 'width:100%');

$pets_data = array('type' => 'text', 'name' => 'pets_data', 'value' => $n_pets_data, 'placeholder' => $this->lang->line('enter_pet_data'), 'class' => 'form-control');

$community1[''] = '';
foreach ($communities as $key) {
    $community = $key->community;
    $community1[$community] = $key->community;
}
$js2 = array('id' => 'community', 'class' => '', 'style' => 'width:100%');

$serv_opt = array('class' => 'select2_demo_3', 'onchange' => 'fetch_select(this.value);', 'style' => 'width:100%', 'required' => 'required');
$sub_serv_opt = array('class' => 'select2_demo_3', 'id' => 'new_select', 'style' => 'width:100%', 'required' => 'required');

$i_desc = array('type' => 'textarea', 'name' => 'i_desc', 'value' => $n_description, 'placeholder' => $this->lang->line('phold_desc'), 'class' => 'form-control', 'rows' => '4');

?>
<?php
echo form_open_multipart('', 'data-toggle="validator"');
?>
<div id="contact">
    <div class="container">
        <div class="row" style="text-align: left">
            <div class="col-sm-10 col-sm-offset-1 rotateInUpLeft">

                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <p class="pull-left" style="font-size: 18px;"><?php echo $this->lang->line('lbl_pers_info'); ?>
                            <input type="checkbox" class="emergency" name="emergency"/> <span
                                    style="font-size: 15px; color: red; "><?php echo $this->lang->line('emergency_high_priority'); ?> </span>
                        </p>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('name'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_input($i_name); ?>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('phone'); ?></label>
                                <div class="input-group m-d"><span class="input-group-addon">+46</span>
                                    <?php echo form_input($i_phone); ?>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('email'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_input($i_email); ?>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
                <br>

                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <p class="pull-left"
                           style="font-size: 18px;"><?php echo $this->lang->line('lbl_addr_info'); ?></p>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('address'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_input($i_address); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('door_code'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_input($i_door_code); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('ini_type'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('ini_type', $ini_type2, $n_ini_type, $js1); ?>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="control-label">Start Time</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <input size="16" type="text" readonly class="start_datetime form-control"
                                           name="i_pref_s_time" value="<?php echo $n_pref_s_time; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="control-label">End Time</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <input size="16" type="text" readonly class="end_datetime form-control"
                                           name="i_pref_e_time" value="<?php echo $n_pref_e_time; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('keys_tube'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('i_keys_tube', $options, $n_keys_tube, $js); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('pets_home'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('i_pets_home', $options, $n_pets_home, $js3); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('community'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('community', $community1, $n_community, $js2); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group" id="pets_data" style="display: none;">
                                <label class="control-label">Pets Data</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_input($pets_data); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->

                <br>
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <p class="pull-left"
                           style="font-size: 18px;"><?php echo $this->lang->line('lbl_service_info'); ?></p>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('location'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('service', $services, $selected_service, $serv_opt); ?>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label"><?php echo $this->lang->line('problem'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('sub_service', $selected_sub_service, $selected_sub_service, $sub_serv_opt); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label class="control-label"><?php echo $this->lang->line('description'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_textarea($i_desc); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
                <br>
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <p class="pull-left" style="font-size: 18px;"><?php echo $this->lang->line('images'); ?></p>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label class="control-label"><?php echo $this->lang->line('select_images'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success btn-lg"
                name="create"><?php echo $this->lang->line('create_ticket'); ?></button>
        </form>
    </div>
</div>

<form method="POST" action="" class="m_ticket" id="m_ticket">
    <input type="hidden" name="new_ticket_id" value="<?php if (isset($new_ticket_id)) {
        echo $new_ticket_id;
    } ?>">
</form>


<?php include 'footer.php'; ?>
</body>

</html>

<script type="text/javascript">
    $('#lang').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "change-lang?lang=<?php echo $new_lang; ?>",
            type: "GET",//type of posting the data
            success: function (data) {
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //what to do in error
            },
            timeout: 15000//timeout of the ajax call
        });

    });
</script>

<?php if (isset($message)) { ?>
    <script>
        $(document).ready(function () {
            var title1 = "<?php echo $message; ?>"
            var text1 = "<?php echo $text; ?>"
            swal({
                title: title1,
                html: text1,
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'OK',
                confirmButtonText: '<?php echo $this->lang->line('want_another_ticket');?>'
            }).then(function () {
                document.getElementById("m_ticket").submit();
            })
        });
    </script>
<?php } ?>

<script type="text/javascript">
    $(".select2_demo_3").select2({
        placeholder: "Select",
        allowClear: true
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#state').select2({
            placeholder: "<?php echo $this->lang->line('type_or_add');?>",
            allowClear: true,
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
            allowClear: true,
            tags: true,
            tokenSeparators: [",", " "],
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

<script>
    $(document).ready(function () {
        $('.emergency').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('login'); ?></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="login">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                               placeholder="<?php echo $this->lang->line('enter_email'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><?php echo $this->lang->line('password'); ?></label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                               placeholder="Password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                <button type="submit" class="btn btn-success"><?php echo $this->lang->line('login'); ?></button>
            </div>
            </form>
        </div>
    </div>
</div>