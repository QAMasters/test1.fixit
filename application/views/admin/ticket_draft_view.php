<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/dataTables/datatables.min.css" rel="stylesheet">
';
$xfooter = '
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.colVis.min.js"></script> 
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
                <strong>Draft Tickets</strong>
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
                    <h5><?php echo $this->lang->line('draft_tickets'); ?></h5>
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
                            foreach ($draft_tic as $key) {
                                $ticket_age = ticket_age($key->created_on);
                                $created_on = creation_date_only($key->created_on);

                                $this->db->where('id = "' . $key->vendor . '"');
                                $vendor = $this->db->get('users')->row();
                                if (substr($key->status, 0, 11) == 'Assigned to') {
                                    $vendor = $vendor->fname;
                                } else {
                                    $vendor = '';
                                }
                                echo '<tr style="cursor: pointer;">
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->community . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $this->lang->line($key->service) . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age . ' ' . $this->lang->line('day(s)') . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'"><span class="label label-' . status_label($key->status) . '">' . $key->status . ' ' . $vendor . '</span></td>
                          <td>
                            <a class="btn btn-success btn-sm waves-effect" href="' . base_url() . 'tickets/' . $key->ticket_id . '"><i class="fa fa-edit"></i> Edit </a>                            
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
                {extend: 'copy', title: 'Drafttickets'},
                {extend: 'csv', title: 'Drafttickets'},
                {extend: 'excel', title: 'Drafttickets'},
                {extend: 'pdf', title: 'Drafttickets'},

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
            ],
        });

    });

</script>

</body>

</html>

<!-- Localized -->
<!--=============================Ticket Close Modal====================-->
<div class="modal fade" id="Close" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="CloseLabel"><?php echo $this->lang->line('close_ticket'); ?></h4>
            </div>
            <?php echo form_open('tickets/status/change'); ?>
            <div class="modal-body">
                <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                <input type="hidden" name="ticketclose" class="form-control" id="recipient-name">
                <div class="form-group">
                    <label for="message-text" class="control-label"><?php echo $this->lang->line('comment'); ?>:</label>
                    <textarea class="form-control" name="comment" id="message-text" required=""></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                <input type="submit" value="close" class="btn btn-primary"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Close").on("show.bs.modal", function (e) {
        var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
        o.find(".modal-body input").val(t)
    });
</script>
<!--=============================Ticket Delete Modal====================-->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="DeleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Delete">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="DeleteLabel"><?php echo $this->lang->line('delete_ticket'); ?></h4>
            </div>
            <?php echo form_open('tickets/status/change'); ?>
            <div class="modal-body">
                <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                <input type="hidden" name="ticketdelete" class="form-control" id="recipient-name">
                <div class="form-group">
                    <label for="message-text" class="control-label"><?php echo $this->lang->line('comment'); ?>:</label>
                    <textarea class="form-control" name="comment" minlength=10 id="message-text" required=""></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                <input id="subscribe-email-submit" type="submit" value="send" class="btn btn-primary"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Delete").on("show.bs.modal", function (e) {
        var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
        o.find(".modal-body input").val(t)
    });
</script>
<!--=============================Ticket Reminder Modal====================-->
<div class="modal fade" id="Reminder" tabindex="-1" role="dialog" aria-labelledby="DeleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Delete">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="DeleteLabel"><?php echo $this->lang->line('send_reminder'); ?></h4>
            </div>
            <?php echo form_open('tickets/status/change'); ?>
            <div class="modal-body">
                <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                <input type="hidden" name="ticketreminder" class="form-control" id="recipient-name">
                <div class="form-group">
                    <label for="message-text" class="control-label"><?php echo $this->lang->line('comment'); ?>:</label>
                    <textarea class="form-control" name="comment" id="message-text"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                <input id="subscribe-email-submit" type="submit" value="send" class="btn btn-primary"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Reminder").on("show.bs.modal", function (e) {
        var a = $(e.relatedTarget), t = a.data("whatever"), o = $(this);
        o.find(".modal-body input").val(t)
    });
</script>

<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>