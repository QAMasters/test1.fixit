<?php

$xheader = '

';
$xfooter = '

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
                <strong><?php echo $this->lang->line('ticket_histor'); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-xs-5 col-sm-6 col-lg-4">
        <div class="title-action">

            <!--<a href="<?php echo base_url(); ?>tickets/new" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Ticket</a>-->
        </div>
    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('ticket_history'); ?></h5>
                </div>
                <div class="ibox-content">
                    <form role="form" class="form-inline" method="POST" action="">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('ticket_id'); ?></label> <input type="text"
                                                                                                placeholder="<?php echo $this->lang->line('placeholder_ticket_history_enter_ticket_id'); ?>"
                                                                                                class="form-control"
                                                                                                name="ticket_id"
                                                                                                required="">
                            <button class="btn btn-sm btn-success" type="submit" name="get_history">
                                <strong><?php echo $this->lang->line('submit'); ?></strong></button>
                        </div>
                    </form>
                </div>
                <?php
                if (!empty($ticket_history)) {
                    ?>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-lg-12">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading"><h3>Ticket ID : <?php echo $ticket_id; ?></h3></div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($ticket_history as $key) { ?>
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-12">
                                <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon yellow-bg">
                                            <i class="fa fa-commenting-o"></i>
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <p><?php echo $key->comments; ?></p>
                                            <span class="vertical-date">
                                        <small><?php echo $key->time; ?></small>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>

<!-- Page-Level Scripts -->

</body>

</html>

<!-- Localized -->
<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>