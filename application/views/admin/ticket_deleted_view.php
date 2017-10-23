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
                <a href="index.html"><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('tickets'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('deleted_tickets'); ?></strong>
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
                    <h5><?php echo $this->lang->line('deleted_tickets'); ?></h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th><?php echo $this->lang->line('ticket_id'); ?></th>
                                <th><?php echo $this->lang->line('name'); ?></th>
                                <th><?php echo $this->lang->line('phone'); ?></th>
                                <th><?php echo $this->lang->line('services'); ?></th>
                                <th><?php echo $this->lang->line('creation_date'); ?></th>
                                <th><?php echo $this->lang->line('status'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($deleted_tic as $key) {
                                $ticket_age = ticket_age($key->created_on);
                                $created_on = creation_date_only($key->created_on);
                                echo '<tr>
                          <td>' . $key->ticket_id . '</td>
                          <td>' . $key->ini_name . '</td>
                          <td>' . $key->ini_phone . '</td>
                          <td>' . $key->service . '</td>
                          <td>' . $created_on . ' - ' . $ticket_age . ' day(s)</td>
                          <td><span class="label label-' . status_label($key->status) . '">' . $key->status . '</span></td>                          
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
                {extend: 'copy', title: 'Deletedtickets'},
                {extend: 'csv', title: 'Deletedtickets'},
                {extend: 'excel', title: 'Deletedtickets'},
                {extend: 'pdf', title: 'Deletedtickets'},

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