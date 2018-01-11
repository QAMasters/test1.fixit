<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
';
$xfooter = '
<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
<!-- Jasny -->
<script src="' . base_url() . 'assets/plugins/jasny/jasny-bootstrap.min.js"></script>
';
include 'header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('profile'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="#"><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('profile'); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="avatar">
                                <img src="<?php echo !empty($profilepic) ? base_url() . 'uploads/users/' . $profilepic : base_url() . 'uploads/users/default.png'; ?>?rand=<?php echo rand(); ?>"
                                     class="profile-avatar" width="120" height="120">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="personal">
                                <h1 class="name"><?php echo $profile->fname . ' ' . $profile->lname; ?></h1>
                                <p class="description"><strong>Email: </strong> <?php echo $profile->email; ?><br>
                                    <strong></strong></p>
                                <p>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#Image"><i
                                                class="fa fa-camera-retro"></i> <?php echo $this->lang->line('change_image'); ?>
                                    </button>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" class="text-color"><h4><i
                                        class="fa fa-home"></i> <?php echo $this->lang->line('information'); ?></h4></a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-2"><h4><i
                                        class="fa fa-gear"></i> <?php echo $this->lang->line('settings'); ?></h4></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?php echo $this->lang->line('status'); ?>:</dt>
                                        <dd>
                                            <span class="label label-primary"><?php echo $this->lang->line('active'); ?></span></a>
                                        </dd>
                                        <dt>Full Name:</dt>
                                        <dd><?php echo $profile->fname . ' ' . $profile->lname; ?></dd>
                                        <dt>Email:</dt>
                                        <dd><a href="mailto:<?php echo $profile->email; ?>"
                                               class="text-navy"> <?php echo $profile->email; ?></a></dd>
                                        <dt>Phone:</dt>
                                        <dd><a href="tel:<?php echo $profile->phone; ?>"
                                               class="text-navy"> <?php echo $profile->phone; ?></a></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <form class="form-horizontal" action=" " method="post" data-toggle="validator">
                                <input type="hidden" name="id" value="<?php echo $profile->id; ?>">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo $this->lang->line('fname'); ?></label>
                                    <div class="col-md-4 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                            <input name="fname" placeholder="First Name" class="form-control"
                                                   type="text" value="<?php echo $profile->fname; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label
                                            class="col-md-4 control-label"><?php echo $this->lang->line('lname'); ?></label>
                                    <div class="col-md-4 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                            <input name="lname" placeholder="Last Name" class="form-control" type="text"
                                                   value="<?php echo $profile->lname; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label
                                            class="col-md-4 control-label"><?php echo $this->lang->line('email'); ?></label>
                                    <div class="col-md-4 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-envelope"></i></span>
                                            <input name="email" placeholder="E-Mail Address" class="form-control"
                                                   type="text" value="<?php echo $profile->email; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label
                                            class="col-md-4 control-label"><?php echo $this->lang->line('phone'); ?>
                                        #</label>
                                    <div class="col-md-4 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon">+46</span>
                                            <input name="phone"
                                                   placeholder="<?php echo $this->lang->line('phold_phone'); ?>"
                                                   class="form-control" type="number"
                                                   oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;"
                                                   maxlength="10" value="<?php echo $profile->phone; ?>" min="0"
                                                   required data-minlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label
                                            class="col-md-4 control-label"><?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-4 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                            <input name="password" placeholder="***********" class="form-control"
                                                   type="password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit"
                                                name="update"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                            </form>
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
<div class="modal fade" id="Image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><i class="fa fa-camera-retro"></i> <?php echo $this->lang->line('update_profile_pic'); ?></h2>
            </div>
            <?php echo form_open_multipart('profile/pic_upload'); ?>
            <div class="modal-body text-center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img data-src=""
                                                                                                   alt="Select Image">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"
                         style="max-width: 200px; max-height: 150px;">
                    </div>
                    <div><span class="btn btn-default btn-file"><span
                                    class="fileinput-new"><?php echo $this->lang->line('select_image'); ?></span><span
                                    class="fileinput-exists"><?php echo $this->lang->line('change'); ?></span><input
                                    type="file" name="profilepic"></span><a href="#"
                                                                            class="btn btn-default fileinput-exists"
                                                                            data-dismiss="fileinput"><?php echo $this->lang->line('remove'); ?></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small btn-success" type="submit"
                        name="avatar"><?php echo $this->lang->line('upload'); ?></button>
                <button type="button" class="btn btn-warning"
                        data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>