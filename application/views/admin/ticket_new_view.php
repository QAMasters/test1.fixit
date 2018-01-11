<?php

$xheader = '
<link href="'.base_url().'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="'.base_url().'assets/plugins/iCheck/custom.css" rel="stylesheet">
<link href="'.base_url().'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="'.base_url().'assets/plugins/select2/select2.min.css" rel="stylesheet">
';
$xfooter = '
<!-- iCheck -->
    <script src="'.base_url().'assets/plugins/iCheck/icheck.min.js"></script>
    <!-- Sweet alert -->
    <script src="'.base_url().'assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="'.base_url().'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="'.base_url().'assets/plugins/select2/select2.full.min.js"></script>
    <script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
';

include 'header.php';
?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-xs-7 col-sm-6 col-lg-8">
                    <h2><?php echo $this->lang->line('tickets');?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url()?>dashboard"><?php echo $this->lang->line('home');?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line('tickets');?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line('new');?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-xs-5 col-sm-6 col-lg-4">
                    <div class="title-action">                        
                        
                        <!--<a href="<?php echo base_url(); ?>tickets/new" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Ticket</a>-->
                    </div>                  
                </div>
            </div>
<?php
echo form_open_multipart('tickets/new',  'data-toggle="validator"');
?>
    <div class="wrapper wrapper-content animated fadeInRight">
<?php
    
    $js = array('class' => 'form-control', 'class' => 'select2_demo_3', 'style' => 'width:100%');
    $options = array( '' => 'Select', 'Yes' => 'Yes', 'No' => 'No');
    
    $i_name = array('type' => 'text', 'name' => 'i_name', 'value' => '', 'placeholder' => $this->lang->line('phold_name'), 'class' => 'form-control', 'required'=>'required', 'data-error'=>'Please Enter Name');
    
    $i_email = array('type' => 'email', 'name' => 'i_email', 'value' => '', 'placeholder' => $this->lang->line('phold_email'), 'class' => 'form-control');
    $i_phone = array('type' => 'number', 'name' => 'i_phone', 'value' => '', 'placeholder' => $this->lang->line('phold_phone'), 'class' => 'form-control', 'oninput'=>'this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;', 'maxlength'=>'10', 'required' => 'required', 'data-minlength'=>'10' , 'min'=>'0' , 'data-error'=>'Please Enter Valid Phone Number');
    $i_address = array('type' => 'text', 'name' => 'i_address', 'value' => '', 'placeholder' => $this->lang->line('phold_address'), 'class' => 'form-control');
    $i_door_code = array('type' => 'text', 'name' => 'i_door_code', 'value' => '', 'placeholder' => $this->lang->line('phold_doorcode'), 'class' => 'form-control');
    
    $ini_type2[''] = '';
    foreach($ini_types as $key){
        $ini_type1 = $key->ini_type;
        $ini_type2[$ini_type1] = $key->ini_type;
    }
    $js1 = array('id' => 'ini_type', 'class' => 'form-control select2_demo_3', 'style' => 'width:100%');
    $js3 = array('id' => 'pets', 'class' => 'form-control select2_demo_3', 'style' => 'width:100%');
    
    $pets_data = array('type' => 'text', 'name' => 'pets_data', 'value' => '', 'placeholder' => 'Enter Pets Information', 'class' => 'form-control');

    $community1[''] = '';
    foreach($communities as $key){
        $community = $key->community;
        $community1[$community] = $key->community;
    }
    $js2 = array('id' => 'community', 'class' => '', 'style' => 'width:100%');

    $serv_opt = array('class' => 'select2_demo_3', 'onchange' =>'fetch_select(this.value);', 'style' => 'width:100%','required' => 'required', 'data-error'=>'Please Select a Serive');
    $sub_serv_opt = array('class' => 'select2_demo_3', 'id' =>'new_select', 'style' => 'width:100%');
    
    $i_desc = array('type' => 'textarea', 'name' => 'i_desc', 'value' => '', 'placeholder' => $this->lang->line('phold_desc'), 'class' => 'form-control', 'rows'=>'4');
    
?>
        <div class="row">
            <div class="col-lg-12">            
            <form class="" action="tickets/new" method="post"  id="contact_form">
                <div class="ibox float-e-margins">
                    <a class="collapse-link" style="color: inherit;">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('lbl_pers_info');?></h5>&nbsp;
                    <input type="checkbox" class="emergency" name="emergency"/> <font color="red"><?php echo $this->lang->line('emergency_high_priority');?> </font>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-up"></i>
                    </div>
                    </div></a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('name');?></label>
                                    <?php echo form_input($i_name); ?><div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('phone');?></label>
                                    <div class="input-group"><span class="input-group-addon">+46</span>
                                    <?php echo form_input($i_phone); ?>
                                    </div><div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('email');?></label>
                                    <?php echo form_input($i_email); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox collapsed">
                    <a class="collapse-link" style="color: inherit;">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('lbl_addr_info');?></h5>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-up"></i>
                    </div>
                    </div></a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('address');?></label>
                                    <?php echo form_input($i_address); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('door_code');?></label>
                                    <?php echo form_input($i_door_code); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('ini_type');?></label>
                                    <?php echo form_dropdown('ini_type', $ini_type2, '', $js1); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"><label class="control-label">Start Time</label>
                                    <input size="16" type="text" readonly class="start_datetime form-control" name="i_pref_s_time" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"><label class="control-label">End Time</label>
                                    <input size="16" type="text" readonly class="end_datetime form_datetime form-control" name="i_pref_e_time" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('keys_tube');?></label>
                                    <?php echo form_dropdown('i_keys_tube', $options, '', $js); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('pets_home');?></label>
                                    <?php echo form_dropdown('i_pets_home', $options, '',$js3); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('community');?></label>
                                    <?php echo form_dropdown('community', $community1, '', $js2); ?>
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
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <a class="collapse-link" style="color: inherit;">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('lbl_service_info');?></h5>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-up"></i>
                    </div>
                    </div></a>
                    <div class="ibox-content">
                        <?php //print_r($services); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('location');?></label>
                                    <?php echo form_dropdown('service', $services, '', $serv_opt); ?><div class="help-block with-errors"></div>
                                </div>
                            </div>
                              <div class="col-sm-6">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('problem');?></label>
                                    <?php echo form_dropdown('sub_service', '', '', $sub_serv_opt); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('description');?></label>
                                    <?php echo form_textarea($i_desc); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox collapsed">
                    <a class="collapse-link" style="color: inherit;">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('images');?></h5>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-up"></i>
                    </div>
                    </div></a>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"><label class="control-label"><?php echo $this->lang->line('select_image');?></label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <div>
            <button type="submit" class="btn btn-warning" name="save_draft" 
            class=""><?php echo $this->lang->line('save_draft');?></button>
            <button type="submit" class="btn btn-success" name="create_ticket" class=""><?php echo $this->lang->line('create_ticket');?></button>
            </div>
        </div>
        
    </div>
<?php echo form_close();?>
    <!-- Mainly scripts -->
<?php
include 'footer.php';
?>

<script type="text/javascript">
$(document).ready(function() {
    $('#ini_type').select2({
   placeholder: "<?php echo $this->lang->line('type_or_add');?>",
   allowClear: true,
   tags: true,
   tokenSeparators: [",", ""],
   createTag: function(newTag) {
       return {
           id: newTag.term,
           text: newTag.term + ' (new)'
       };
   }
    });     
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#community').select2({
   placeholder: "<?php echo $this->lang->line('type_or_add');?>",
   allowClear: true,
   tags: true,
   tokenSeparators: [",", ""],
   createTag: function(newTag) {
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

<script>
$(document).ready(function () {
    $('.emergency').iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
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
$(".start_datetime").change(function(){
    $('.end_datetime').datetimepicker('remove');
    var s_date = this.value;
    $(".end_datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        startDate: s_date,
        autoclose: true
    });
});
</script>

<?php if (isset($message)) { ?>
<script>
$(document).ready(function(){
  swal({
    title: "Ticket Not found !",
    text: "Please check again ",
    type: "error"
  });
});
</script>
<?php } ?>

<script>
$(document).ready(function(){
  $( "#pets" ).change(function() {
    var x= $("#pets").val();
    if(x=='Yes'){
      $("#pets_data").show();
    }else{
      $("#pets_data").hide();
    }
  });
});
</script>
<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: '<?php echo base_url() ?>fetchservice',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}
</script>

</body>

</html>

<!-- Localized -->