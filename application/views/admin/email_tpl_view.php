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
        <h2><?php echo $this->lang->line('settings'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html"><?php echo $this->lang->line('home'); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line('email_templates'); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line('view'); ?></strong>
            </li>
        </ol>
    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('email_templates'); ?></h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th><?php echo $this->lang->line('id'); ?></th>
                                <th><?php echo $this->lang->line('template_name'); ?></th>
                                <th><?php echo $this->lang->line('lang'); ?></th>
                                <th><?php echo $this->lang->line('subject'); ?></th>
                                <th><?php echo $this->lang->line('edit'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($email_tpl as $key) {
                                if ($key->lang_id == '1') {
                                    $lang = 'English';
                                } else if ($key->lang_id == '2') {
                                    $lang = 'Swedish';
                                }
                                echo '<tr>
                          <td>' . $key->id . '</td>
						  <td>' . $key->tpl_name . '</td>
                          <td>' . $lang . '</td>
                          <td>' . $key->subject . '</td>
                          <td><a class="btn btn-success btn-xs waves-effect" href="' . base_url() . 'settings/email-templates/edit/' . $key->id . '"><i class="fa fa-edit"></i> Manage</a></td>
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