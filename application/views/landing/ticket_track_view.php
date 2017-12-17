<?php
$xheader = '
<link href="' . base_url() . 'assets1/plugins/pricing-tables/css/style.css" rel="stylesheet" type="text/css">
<link href="' . base_url() . 'assets1/css/landing1.css" rel="stylesheet" type="text/css"/>
<link href="' . base_url() . 'assets1/custom.css" rel="stylesheet" type="text/css">
<link href="' . base_url() . 'assets/plugins/iCheck/custom.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/select2/select2.min.css" rel="stylesheet">
<style type="text/css">
/* Form Progress */
.progress {
  width: 100%;
  margin: 20px auto;
  text-align: center;
  height: 60px;
  background-color: white;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.progress .circle,
.progress .bar {
  display: inline-block;
  background: #fff;
  width: 40px; height: 40px;
  border-radius: 40px;
  border: 1px solid #d5d5da;
}
.progress .bar {
  position: relative;
  width: 15%;
  height: 6px;
  top: -33px;
  margin-left: -5px;
  margin-right: -5px;
  border-left: none;
  border-right: none;
  border-radius: 0;
}
.progress .circle .label {
  display: inline-block;
  width: 32px;
  height: 32px;
  line-height: 32px;
  border-radius: 32px;
  margin-top: 3px;
  color: #b5b5ba;
  font-size: 17px;
}
.progress .circle .title {
  color: #b5b5ba;
  font-size: 13px;
  line-height: 30px;
  margin-left: -5px;
}

/* Done / Active */
.progress .bar.done,
.progress .circle.done {
  background: #eee;
}
.progress .bar.active {
  background: linear-gradient(to right, #EEE 40%, #FFF 60%);
}
.progress .circle.done .label {
  color: #FFF;
  background: #8bc435;
  box-shadow: inset 0 0 2px rgba(0,0,0,.2);
}
.progress .circle.done .title {
  color: #444;
}
.progress .circle.active .label {
  color: #FFF;
  background: #0c95be;
  box-shadow: inset 0 0 2px rgba(0,0,0,.2);
}
.progress .circle.active .title {
  color: #0c95be;
}
</style>
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
                <h2><?php echo $this->lang->line('update_ticket'); ?></h2>     <em>
                    <?php echo $this->lang->line('update_ticket_lbl'); ?>
                </em>
            </div>
        </div>
    </div>
</div>

<div class="progress">
    <div class="circle done">
        <span class="label">1</span>
        <span class="title">Created</span>
    </div>
    <span class="bar done"></span>
    <div class="circle done">
        <span class="label">2</span>
        <span class="title">Processing</span>
    </div>
    <span class="bar half"></span>
    <div class="circle active">
        <span class="label">3</span>
        <span class="title">Done</span>
    </div>
    <span class="bar"></span>
    <div class="circle">
        <span class="label">4</span>
        <span class="title">Closed</span>
    </div>
</div>

<?php
$i_name = array('type' => 'text', 'name' => 'i_name', 'value' => $ticket->ini_name, 'placeholder' => $this->lang->line('phold_name'), 'class' => 'form-control', 'required' => 'required', 'data-error' => 'Please Enter Name');

$i_email = array('type' => 'email', 'name' => 'i_email', 'value' => $ticket->ini_email, 'placeholder' => $this->lang->line('phold_email'), 'class' => 'form-control', 'data-validation' => 'email', 'required' => 'required', 'data-error' => 'Please Enter Email');
$i_phone = array('type' => 'number', 'name' => 'i_phone', 'value' => $ticket->ini_phone, 'placeholder' => $this->lang->line('phold_phone'), 'class' => 'form-control', 'oninput' => 'this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;', 'maxlength' => '10', 'required' => 'required', 'data-minlength' => '10', 'min' => '0', 'data-error' => 'Please Enter Valid Phone Number');
$i_address = array('type' => 'text', 'name' => 'i_address', 'value' => $ticket->ini_address, 'placeholder' => $this->lang->line('phold_address'), 'class' => 'form-control', "data-validation" => "required");
$i_door_code = array('type' => 'text', 'name' => 'i_door_code', 'value' => $ticket->ini_doornum, 'placeholder' => $this->lang->line('phold_doorcode'), 'class' => 'form-control', "data-validation" => "required");
$i_desc = array('type' => 'textarea', 'name' => 'i_desc', 'value' => $ticket->description, 'placeholder' => $this->lang->line('phold_description'), 'class' => 'form-control', "data-validation" => "required", 'rows' => '4');

$js = array('class' => 'form-control', 'class' => 'select2_demo_3', 'style' => 'width:100%');
$options = array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No');

$ini_type2[''] = '';
foreach ($ini_types as $key) {
    $ini_type1 = $key->ini_type;
    $ini_type2[$ini_type1] = $key->ini_type;
}
$js1 = array('id' => 'state', 'class' => '', 'style' => 'width:100%');

$js3 = array('id' => 'pets', 'class' => 'select2_demo_3', 'style' => 'width:100%');

$pets_data = array('type' => 'text', 'name' => 'pets_data', 'value' => $ticket->pets_data, 'placeholder' => 'Enter Pets Information', 'class' => 'form-control');

$community1[''] = '';
foreach ($communities as $key) {
    $community = $key->community;
    $community1[$community] = $key->community;
}
$js2 = array('id' => 'community', 'class' => '', 'style' => 'width:100%');

$serv_opt = array('class' => 'select2_demo_3', 'onchange' => 'fetch_select(this.value);', 'style' => 'width:100%');
$sub_serv_opt = array('class' => 'select2_demo_3', 'id' => 'new_select', 'style' => 'width:100%');
?>
<?php
echo form_open_multipart('', 'data-toggle="validator"');
echo form_hidden('ticket_id', $ticket->ticket_id);
?>
<div id="contact">
    <div class="container">
        <div class="row" style="text-align: left">
            <div class="col-sm-10 col-sm-offset-1 rotateInUpLeft">

                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <p class="pull-left" style="font-size: 18px;"><?php echo $this->lang->line('lbl_pers_info'); ?>
                            <input type="checkbox" class="emergency"
                                   name="emergency" <?php if ($ticket->emergency == '1') {
                                echo 'checked';
                            } ?> /> <span
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
                                    <?php echo form_dropdown('ini_type', $ini_type2, $ticket->ini_type, $js1); ?>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="control-label">Start Time</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <input size="16" type="text" readonly class="start_datetime form-control"
                                           name="i_pref_s_time" value="<?php echo $ticket->pref_s_time; ?>"
                                           style="font-size:13px;">
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="control-label">End Time</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <input size="16" type="text" readonly class="end_datetime form-control"
                                           name="i_pref_e_time" value="<?php echo $ticket->pref_e_time; ?>"
                                           style="font-size:13px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('keys_tube'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('i_keys_tube', $options, $ticket->keys_tube, $js); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('pets_home'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('i_pets_home', $options, $ticket->pets_home, $js3); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="control-label"><?php echo $this->lang->line('community'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('community', $community1, $ticket->community, $js2); ?>
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
                                    <?php //echo form_dropdown('service', $services, $ticket->service, $serv_opt); ?>
                                    <select name="service" class="select2_demo_3" onchange="fetch_select(this.value);"
                                            required="required" data-error="Please Select a Serice" style="width: 100%">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php foreach ($services as $service) { ?>
                                            <option value="<?php echo $service ?>" <?php if ($service == $ticket->service) {
                                                echo "selected";
                                            } ?> ><?php echo $this->lang->line($service) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label"><?php echo $this->lang->line('problem'); ?></label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <?php echo form_dropdown('sub_service', $sub_services, $ticket->sub_service, $sub_serv_opt); ?>
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
                        <p class="pull-left" style="font-size: 18px;">Images</p>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label class="control-label">Select Image</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label class="control-label">Images</label>
                                <div class="input-group col-md-12 col-xs-12">
                                    <div class="text-center">
                                        <?php
                                        $dir = 'uploads/ticket_images';
                                        $map = directory_map($dir);
                                        $ticket_id_hash = md5($ticket->ticket_id);
                                        foreach ($map as $key) {
                                            $file = substr($key, 0, 32);
                                            if ($ticket_id_hash == $file) {
                                                echo '<a href="' . base_url($dir) . '/' . $key . '"  data-gallery="" style="padding-right: 5px;"><img src="' . base_url($dir) . '/' . $key . '" width="80" height="80"></a>';
                                            }
                                        }
                                        ?>          </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success btn-lg" name="update">Update Ticket</button>
        </form>
    </div>
</div>

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
            var text1 = ""
            swal({
                title: title1,
                text: text1,
                type: "success"
            });
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

<script>
    $(document).ready(function () {
        $('.emergency').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
        });
    });
</script>

<script type="text/javascript">
    var i = 1;
    var status_id = "<?php echo ticket_status_id($ticket->ticket_id); ?>"
    $('.progress .circle').removeClass().addClass('circle');
    $('.progress .bar').removeClass().addClass('bar');
    setInterval(function () {
        $('.progress .circle:nth-of-type(' + i + ')').addClass('active');
        $('.progress .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');
        $('.progress .circle:nth-of-type(' + (i - 1) + ') .label').html('&#10003;');
        $('.progress .bar:nth-of-type(' + (i - 1) + ')').addClass('active');
        $('.progress .bar:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');

        //this must be 
        if (i != status_id) {
            i++;
        }

        if (i == 0) {
            $('.progress .bar').removeClass().addClass('bar');
            $('.progress div.circle').removeClass().addClass('circle');
            i = 1;
        }
    }, 500);

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
                               placeholder="Enter email">
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