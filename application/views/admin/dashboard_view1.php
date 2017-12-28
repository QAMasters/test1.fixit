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
                        <li><a href="#" class="all btn btn-success btn-sm"">All</a></li>
                        <li><a href="#" class="filter btn btn-success btn-sm"">Deleted</a></li>
                        <li><a href="#" class="filter btn btn-success btn-sm"">Closed</a></li>
                        <li><a href="#" class="filter btn btn-success btn-sm"">Invoice Raised</a></li>
                        <li><a href="#" class="filter btn btn-success btn-sm"">Assigned</a></li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example1" width="100%"
                               border="0" cellspacing="0" cellpadding="0">
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
                            foreach ($rec_tic as $key) {
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
                          <td>' . $key->ticket_id . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->service . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age . ' day(s)</td>
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
                        <!--<div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                        </div>-->
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
                    <h5><?php echo $this->lang->line('invoices'); ?></h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example1" width="100%"
                           border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th><?php echo $this->lang->line('invoice_id'); ?></th>
                            <th><?php echo $this->lang->line('ticket_id'); ?></th>
                            <th><?php echo $this->lang->line('status'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($inv_tic as $key) {
                            echo '<tr>
                                    <td>' . $key->invoice_id . '</td>
                                    <td>' . $key->ticket_id . '</td>
                                    <td><span class="label label-' . status_label($key->inv_status) . '">' . $key->inv_status . '</span></td>                          
                                    </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('recent_tickets'); ?></h5>                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
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
    foreach ($rec_tic as $key) {
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
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ticket_id . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ini_name . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->ini_phone . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $key->service . '</td>
                          <td onclick="window.document.location=\'' . base_url() . 'tickets/' . $key->ticket_id . '\'">' . $created_on . ' - ' . $ticket_age . ' day(s)</td>
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
    </div>-->


    <?php include 'footer.php'; ?>

    <?php include 'charts.php'; ?>

    </body>
    </html>

    <!-- Localized -->
    <!--<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                order: [],
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
    <!--  <script>
          $(document).ready(function(){
              $('.dataTables-example1').DataTable({
                  order: []
              });
  
          });
  
      </script>
  -->
    <script>
        var table = $('.dataTables-example1').DataTable({
            ordering: false,
            responsive: true,
            paging: false,
            "language": {
                "zeroRecords": "Sorry, Nothing Found here", //changes words used
                "lengthMenu": "Show _MENU_ tickets per page", //changes words usedwords used
                "info": "Showing _START_ to _END_ of _TOTAL_ Tickets", //changes words used
                "search": "", //changes words used originally - Search programs:
                "searchPlaceholder": "Search",
                "infoFiltered": "(filtered from _MAX_ total tickets)"
            }
        });

        // table.column(1).visible(false);


        $(".filter").click(function (e) {
            e.preventDefault();
            table
                .columns(5)
                .search($(this).text())
                .draw();
        });

        $("a.all").click(function (e) {
            e.preventDefault();
            table
                .search('')
                .columns(5)
                .search('')
                .draw();
        });
    </script>