<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/summernote/summernote.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/summernote/summernote-bs3.css" rel="stylesheet">

';
$xfooter = '
    <!-- iCheck -->
    <script src="' . base_url() . 'assets/plugins/iCheck/icheck.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <!-- Sweet alert -->
    <script src="' . base_url() . 'assets/plugins/sweetalert/sweetalert.min.js"></script>
	<!-- Switchery -->
   <script src=' . base_url() . 'assets/plugins/switchery/switchery.js"></script>
	<!-- SUMMERNOTE -->
    <script src="' . base_url() . 'assets/plugins/summernote/summernote.min.js"></script>
';
include 'header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('settings'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>dashboard"><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('email_templates'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('edit'); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<?php
$tpl_name = array('type' => 'text', 'name' => 'tpl_name', 'value' => $email_tpl->tpl_name, 'placeholder' => 'Template Name', 'class' => 'form-control', 'disabled' => 'disabled');
$tpl_subject = array('type' => 'text', 'name' => 'tpl_subject', 'value' => $email_tpl->subject, 'placeholder' => 'Enter Last name', 'class' => 'form-control', 'data-validation' => 'required');
$form_submit = array('name' => 'submit', 'id' => '', 'type' => 'submit', 'content' => 'Update', 'class' => 'btn btn-primary');
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <?php echo form_open('', 'class="form-horizontal"');
    echo form_hidden('id', $email_tpl->id);
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('email_templates'); ?></h5>
                </div>
                <div class="ibox-content">
                    <form method="get" class="form-horizontal">
                        <div class="form-group"><label
                                    class="col-sm-3 control-label"><?php echo form_label('Template Name', 'tpl_name'); ?></label>
                            <div class="col-sm-6">
                                <?php echo form_input($tpl_name); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label
                                    class="col-sm-3 control-label"><?php echo form_label('Subject', 'tpl_subject'); ?></label>
                            <div class="col-sm-6">
                                <?php echo form_input($tpl_subject); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label
                                    class="col-sm-3 control-label"><?php echo form_label('Message', 'tpl_message'); ?></label>
                            <div class="col-sm-8">
                                <textarea class="input-block-level" id="summernote" rows="10"
                                          name="tpl_message"><?php echo $email_tpl->message; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <?php echo form_button($form_submit); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

</div>
</div>
<?php include 'footer.php'; ?>

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
        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['picture', ['picture']],
                ['link', ['link']],
                ['codeview', ['codeview']],
            ]
        });
    });
</script>
<script>
    $.validate({});
    // Restrict presentation length
    $('#presentation').restrictLength($('#pres-max-length'));

</script>
</body>
</html>

<!-- Localized -->