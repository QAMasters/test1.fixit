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
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('invoices'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('invoices'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('invoice_raised'); ?></strong>
            </li>
        </ol>
    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('invoice_raised'); ?></h5>
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
                            foreach ($inv_tic as $key) {
                                $ticket_age = ticket_age($key->created_on);
                                $created_on = creation_date_only($key->created_on);
                                $invoice_status = invoice_status($key->ticket_id);
                                echo '<tr style="cursor: pointer;">
                          <td onclick="window.document.location=\'edit/' . $key->ticket_id . '\'">' . $key->community . '</td>
                          <td onclick="window.document.location=\'edit/' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'edit/' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'edit/' . $key->ticket_id . '\'">' . $key->service . '</td>
                          <td onclick="window.document.location=\'edit/' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age . ' ' . $this->lang->line('day(s)') . '</td>
                          <td onclick="window.document.location=\'edit/' . $key->ticket_id . '\'"><span class="label label-' . status_label($invoice_status) . '">' . $invoice_status . '</span></td>
                          <td>
                          <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Change Status <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="invoice_status_change?ticket_id=' . $key->ticket_id . '&status=Paid">Paid</a></li>
                                <li><a href="invoice_status_change?ticket_id=' . $key->ticket_id . '&status=UnPaid">UnPaid</a></li>
                            </ul>
                        </div>
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

</div>
</div>

<?php include 'footer.php'; ?>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy', title: 'ExampleFile'},
                {extend: 'csv', title: 'ExampleFile'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

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