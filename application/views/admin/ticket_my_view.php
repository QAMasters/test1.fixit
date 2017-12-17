<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/dataTables/datatables.min.css" rel="stylesheet">
';
$xfooter = '
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
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
                <strong><?php echo $this->lang->line('open_tickets'); ?></strong>
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
                    <h5><?php echo $this->lang->line('open_tickets'); ?></h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th><?php echo $this->lang->line('community'); ?></th>
                                <th><?php echo $this->lang->line('name'); ?></th>
                                <th><?php echo $this->lang->line('phone'); ?></th>
                                <th><?php echo $this->lang->line('services'); ?></th>
                                <th><?php echo $this->lang->line('creation_date'); ?></th>
                                <th><?php echo $this->lang->line('status'); ?></th>
                                <th><?php echo $this->lang->line('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($open_tic as $key) {
                                $ticket_age = ticket_age($key->created_on);
                                $created_on = creation_date_only($key->created_on);

                                if (substr($key->status, 0, 11) == 'Assigned to') {
                                    $vendor = get_user_name($key->vendor)->fname;
                                } else if (substr($key->status, 0, 11) == 'Accepted by') {
                                    $vendor = get_user_name($key->vendor)->fname;
                                } else {
                                    $vendor = '';
                                }

                                echo '<tr style="cursor: pointer;">
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->community . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $this->lang->line($key->service) . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age . ' day(s)</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'"><span class="label label-' . status_label($key->status) . '">' . $key->status . ' ' . $vendor . '</span></td>
                          <td>
                            <a href="#Accept" data-toggle="modal" data-hover="tooltip" title="Accept Ticket" data-placement="top" data-whatever="' . $key->ticket_id . '" class="btn btn-primary btn-circle btn-outline"><span class="glyphicon glyphicon-ok"></a>
                            <a href="#Reject" data-toggle="modal" data-hover="tooltip" title="Giveup Ticket" data-placement="top" data-whatever="' . $key->ticket_id . '" class="btn btn-danger btn-circle btn-outline"><span class="glyphicon glyphicon-remove"></a>

                          </td>
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

<?php include 'footer.php'; ?>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            order: [],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy', title: 'Mytickets'},
                {extend: 'csv', title: 'Mytickets'},
                {extend: 'excel', title: 'Mytickets'},
                {extend: 'pdf', title: 'Mytickets'},

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

</script>

</body>

</html>

<!-- Localized -->
<!--=============================Ticket Accept Modal====================-->
<div class="modal fade" id="Accept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><i class="fa fa-check"></i> Accept Ticket</h2>
            </div>
            <?php echo form_open('tickets/status/change'); ?>
            <div class="modal-body">
                <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                <input type="hidden" name="ticketaccept" class="form-control" id="recipient-name">
                <div class="form-group">
                    <label for="message-text" class="control-label"><?php echo $this->lang->line('comment'); ?>:</label>
                    <textarea class="form-control" name="comment" id="message-text" required=""></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Accept Ticket" class="btn btn-success"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Accept").on("show.bs.modal", function (e) {
        var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
        o.find(".modal-body input").val(t)
    });
</script>
<!--=============================Ticket Reject Modal====================-->
<div class="modal fade" id="Reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><i class="fa fa-ban"></i> Reject Ticket</h2>
            </div>
            <?php echo form_open('tickets/status/change'); ?>
            <div class="modal-body">
                <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                <input type="hidden" name="ticketreject" class="form-control" id="recipient-name">
                <div class="form-group">
                    <label for="message-text" class="control-label"><?php echo $this->lang->line('comment'); ?>:</label>
                    <textarea class="form-control" name="comment" minlength=10 id="message-text" required=""></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input id="subscribe-email-submit" type="submit" value="Reject Ticket" class="btn btn-success"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Reject").on("show.bs.modal", function (e) {
        var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
        o.find(".modal-body input").val(t)
    });
</script>

<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>