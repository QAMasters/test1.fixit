<?php

$xheader = '
<link href="' . base_url() . 'assets/plugins/dataTables/datatables.min.css" rel="stylesheet">
';
$xfooter = '
<script src="' . base_url() . 'assets/plugins/dataTables/datatables.min.js"></script>
';
include 'header.php';
?>
<div class="wrapper wrapper-content">
    <div class="col-lg-12">

        <div class="widget p-lg text-center">
            <div class="m-b-md">
                <h1 class="font-bold no-margins">
                    <?php echo $this->lang->line('db_backup'); ?>
                </h1>
            </div>
            <div class="m-b-md">
                <h1 class="font-bold no-margins">
                    <i class="fa fa-database fa-3x"></i>
                </h1>
            </div>
            <div class="m-b-md">
                <h1 class="font-bold no-margins">
                    <a href="backup/run" class="btn btn-danger btn-lg"><i
                                class="fa fa-history"></i> <?php echo $this->lang->line('db_backup'); ?></a>
                </h1>
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