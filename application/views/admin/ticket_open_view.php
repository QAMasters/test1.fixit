<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="' . base_url() . 'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<!--New-->
    <link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet">
';
$xfooter = '
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.colVis.min.js"></script>
<script src="' . base_url() . 'assets/plugins/sweetalert/sweetalert.min.js"></script> 
<!--New-->
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
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
                    <ul class="list-inline">
                        <li><a href="#" class="all btn btn-success btn-sm"><?php echo $this->lang->line('all'); ?></a></li>
                        <li><a href="#" class="inprogress btn btn-success btn-sm"><?php echo $this->lang->line('show_inprogress'); ?></a></li>
                        <li><a href="#" class="unassigned btn btn-success btn-sm"><?php echo $this->lang->line('show_unassigned'); ?></a>                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover open-tickets" width="100%" border="0" cellspacing="0" cellpadding="0">
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
                          <td>' . $key->community . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $this->lang->line($key->service) . '</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age.' '. $this->lang->line('day(s)') .'</td>
                          <td onclick="window.document.location=\'' . $key->ticket_id . '\'"><span class="label label-' . status_label($key->status) . '">' . $key->status . ' ' . $vendor . '</span></td>
                          <td>
                            <a href="' . $key->ticket_id . '" data-hover="tooltip" title="' . $this->lang->line('edit') . '" data-placement="top" class="btn btn-success btn-circle btn-outline"><i class="fa fa-pencil"></i></a>
                            <a href="#Close" data-toggle="modal" data-hover="tooltip" title="' . $this->lang->line('close_ticket') . '" data-placement="top" data-whatever="' . $key->ticket_id . '" class="btn btn-warning btn-circle btn-outline"><span class="glyphicon glyphicon-remove"></a>
                            <a href="#Delete" data-toggle="modal" data-hover="tooltip" title="' . $this->lang->line('delete_ticket') . '" data-placement="top" data-whatever="' . $key->ticket_id . '" class="btn btn-danger btn-circle btn-outline"><span class="glyphicon glyphicon-trash"></a>
                            <a href="#Reminder" data-toggle="modal" data-hover="tooltip" title="' . $this->lang->line('send_reminder') . '" data-placement="top" data-whatever="' . $key->ticket_id . '" class="btn btn-primary btn-circle btn-outline"><span class="glyphicon glyphicon-send"></a>
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
<!--  <script>
      $(document).ready(function(){
          $('.dataTables-example').DataTable({
              pageLength: 10,
              responsive: true,
              order: [],
              dom: '<"html5buttons"B>lTfgitp',
              buttons: [
                  {extend: 'copy', title: 'ExampleFile'},
                  {extend: 'csv', title: 'ExampleFile'},
                  {extend: 'excel', title: 'ExampleFile'},
                  {extend: 'pdf', title: 'ExampleFile'},

                  {extend: 'print',
                   customize: function (win){
                          $(win.document.body).addClass('white-bg');
                          $(win.document.body).css('font-size', '10px');

                          $(win.document.body).find('table')
                                  .addClass('compact')
                                  .css('font-size', 'inherit');
                  }
                  }
              ],
              dom: 'Bfrtip',
              columnDefs: [
              {
                  targets: 1,
                  className: 'noVis'
              }
              ],
              buttons: [
              {
                  extend: 'colvis',
                  columns: ':not(.noVis)'
              }
              ]

          });

      });

  </script>-->

<script>
    var table = $('.open-tickets').DataTable({
        "order": [],
        responsive: true,
        paging: true,
        "language": {
            "zeroRecords": "<?php echo $this->lang->line('search_result_zero_records'); ?>", //changes words used
            "lengthMenu": "<?php echo $this->lang->line('search_label_show'); ?> _MENU_ <?php echo $this->lang->line('search_label_ticket'); ?>",
            "info": "<?php echo $this->lang->line('search_label_showing'); ?> _START_ <?php echo $this->lang->line('search_label_to'); ?> _END_ <?php echo $this->lang->line('search_label_of'); ?> _TOTAL_ <?php echo $this->lang->line('search_label_ticket'); ?>", //changes words used
            "search": "", //changes words used originally - Search programs:
            "searchPlaceholder": "<?php echo $this->lang->line('search_field_placeholder'); ?>",
            "infoFiltered": "(filtered from _MAX_ total tickets)"
        },
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy', title: 'Opentickets'},
            {extend: 'csv', title: 'Opentickets'},
            {extend: 'excel', title: 'Opentickets'},
            {extend: 'pdf', title: 'Opentickets'},
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

    // table.column(1).visible(false);

    $("a.all").click(function (e) {
        e.preventDefault();
        table
            .search('')
            .columns(5)
            .search('')
            .draw();
    });

    $(".inprogress").click(function (e) {
        e.preventDefault();
        table
            .columns(5)
            .search("Accepted|Assigned", true, false)
            .draw();
    });

    $("a.unassigned").click(function (e) {
        e.preventDefault();
        table
            .columns(5)
            .search('New')
            .draw();
    });
</script>

</body>

</html>

<!-- Localized -->
<!--=============================Ticket Close Modal====================-->
<div class="modal fade" id="Close" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><i class="fa fa-ban"></i> <?php echo $this->lang->line('close_ticket'); ?></h2>
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
                <input type="submit" value="Close Ticket" class="btn btn-success"/>
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
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><i class="fa fa-trash"></i> <?php echo $this->lang->line('delete_ticket');?></h2>
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
                <input type="submit" value="Delete Ticket" class="btn btn-success"/>
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
<div class="modal fade" id="Reminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><i class="fa fa-paper-plane"></i> Send Reminder</h2>
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
                <input type="submit" value="Send Reminder" class="btn btn-success"/>
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

<script>
    <?php if($this->session->alert_msg != ''){ ?>
    $(document).ready(function () {
        var msg = "<?php echo $this->session->alert_msg; ?>";
        swal({
            title: msg,
            text: "",
            type: "success",
        });
    });
    <?php } ?>
    <?php $this->session->unset_userdata('alert_msg'); ?>
</script>