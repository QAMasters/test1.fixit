<?php

$xheader = '
    <!-- Morris -->
    <link href="' . base_url() . 'assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- c3 Charts -->
    <link href="' . base_url() . 'assets/plugins/c3/c3.min.css" rel="stylesheet">
    <link href="' . base_url() . 'assets/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!--New-->
    <link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet">
';
$xfooter = '
    <!-- Morris -->
    <script src="' . base_url() . 'assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/morris/morris.js"></script>
    
    <!-- d3 and c3 charts -->
    <script src="' . base_url() . 'assets/plugins/d3/d3.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/c3/c3.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script> 
    <script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.colVis.min.js"></script>
    <!--New-->
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    
    ';
include 'header.php';
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="widget style1 blue-bg">
                <div class="row"><a href="tickets/open" style="color: #FFFFFF;">
                        <div class="col-xs-4">
                            <i class="fa fa-envelope-open-o fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span><?php echo $this->lang->line('open_tickets'); ?></span>
                            <h2 class="font-bold"><?php echo $open_tic_count; ?></h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="widget red-bg">
                <div class="row"><a href="tickets/closed" style="color: #FFFFFF;">
                        <div class="col-xs-4">
                            <i class="fa fa-envelope-o fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span><?php echo $this->lang->line('closed_tickets'); ?></span>
                            <h2 class="font-bold"><?php echo $closed_tic_count; ?></h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="widget yellow-bg">
                <div class="row"><a href="tickets/open" style="color: #FFFFFF;">
                        <div class="col-xs-4">
                            <i class="fa fa-spinner fa-spin fa-5x fa-fw"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span><?php echo $this->lang->line('inpro_tickets'); ?></span>
                            <h2 class="font-bold"><?php echo $inpro_tic_count; ?></h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="widget style1 navy-bg">
                <div class="row"><a href="vendors/active" style="color: #FFFFFF;">
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span><?php echo $this->lang->line('active_vendors'); ?></span>
                            <h2 class="font-bold"><?php echo $vendors_count; ?></h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('recent_tickets'); ?></h5>
                </div>
                <div class="ibox-content">
                    <ul class="list-inline">
                        <li><a href="#" class="all btn btn-success btn-sm""><?php echo $this->lang->line('all'); ?></a>
                        </li>
                        <li><a href="#"
                               class="inprogress btn btn-success btn-sm""><?php echo $this->lang->line('show_inprogress'); ?></a>
                        </li>
                        <li><a href="#"
                               class="unassigned btn btn-success btn-sm""><?php echo $this->lang->line('show_unassigned'); ?></a>
                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example1" width="100%"
                               border="0" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                                <th><?php echo $this->lang->line('community'); ?></th>
                                <th><?php echo $this->lang->line('name'); ?></th>
                                <th><?php echo $this->lang->line('phone'); ?></th>
                                <th><?php echo $this->lang->line('services'); ?></th>
                                <th><?php echo $this->lang->line('creation_date'); ?></th>
                                <th><?php echo $this->lang->line('status'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($rec_tic as $key) {
                                $ticket_age = ticket_age($key->created_on);
                                $created_on = creation_date_only($key->created_on);

                                $this->db->where('id = "' . $key->vendor . '"');
                                $vendor = $this->db->get('users')->row();
                                if (substr($key->status, 0, 11) == 'Assigned to') {
                                    $vendor = $vendor->fname;
                                } else if (substr($key->status, 0, 11) == 'Accepted by') {
                                    $vendor = get_user_name($key->vendor)->fname;
                                } else {
                                    $vendor = '';
                                }
                                echo '<tr style="cursor: pointer;">
                          <td>' . $key->community . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $this->lang->line($key->service) . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age . ' ' . $this->lang->line('day(s)') . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'"><span class="label label-' . status_label($key->status) . '">' . $key->status . ' ' . $vendor . '</span></td> 
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

    <?php if ($this->session->role_id == 1) { ?>

        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('services'); ?></h5>
                    </div>
                    <div class="ibox-content">
                        <div id="donut"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('monthly_stats'); ?></h5>
                        <div class="pull-right">
                        </div>
                    </div>
                    <div class="ibox-content" style="position: relative">
                        <div id="line1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('invoice_stats'); ?></h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <div id="donut2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('invoices_status'); ?></h5>
                    </div>
                    <style>
                        .dataTables_wrapper {
                            padding-bottom: 10px;
                        }
                    </style>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover invoice_table" width="100%"
                               border="0" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                                <th><?php echo $this->lang->line('name'); ?></th>
                                <th><?php echo $this->lang->line('status'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($inv_tic as $key) {
                                echo '<tr>
                                    <td>' . $key->ticket_id . '</td>
                                    <td><span class="label label-' . status_label($key->inv_status) . '">' . $this->lang->line(strtolower($key->inv_status)) . '</span></td>                          
                                    </tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php include 'footer.php'; ?>

    <?php include 'charts.php'; ?>

    </body>
    </html>

    <script>
        var table = $('.dataTables-example1').DataTable({
            ordering: false,
            responsive: true,
            paging: true,
            "pageLength": 10,
            "lengthChange": false,
            "dom": "lfrti",
            "info": false,
            "language": {
                "zeroRecords": "<?php echo $this->lang->line('search_result_zero_records'); ?>", //changes words used
                "lengthMenu": "<?php echo $this->lang->line('search_label_show'); ?> _MENU_ <?php echo $this->lang->line('search_label_ticket'); ?>",
                "info": "<?php echo $this->lang->line('search_label_showing'); ?> _START_ <?php echo $this->lang->line('search_label_to'); ?> _END_ <?php echo $this->lang->line('search_label_of'); ?> _TOTAL_ <?php echo $this->lang->line('search_label_ticket'); ?>", //changes words used
                "search": "", //changes words used originally - Search programs:
                "searchPlaceholder": "<?php echo $this->lang->line('search_field_placeholder'); ?>",
                "infoFiltered": "(filtered from _MAX_ total tickets)"
            }

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

    <script>
        $(document).ready(function () {
            $('.invoice_table').DataTable({
                "searching": false,
                "ordering": false,
                "paging": true,
                "info": false,
                "lengthChange": false,
                "dom": "lfrti",
            });
        });
    </script>