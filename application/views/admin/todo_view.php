<?php

$xheader = '

';
$xfooter = '';
include 'header.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>TO DO List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>dashboard">Home</a>
            </li>
            <li class="active">
                <strong>Todo List</strong>
            </li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">EXAMPLE
        <div class="panel-controls"><a href="javascript:void(0);" class="panel-collapsable" data-toggle="tooltip"
                                       data-title="Collapse/Expand" data-placement="bottom" data-original-title=""
                                       title=""><i class="fa fa-chevron-up"></i></a><a href="javascript:void(0);"
                                                                                       class="panel-fullscreen"
                                                                                       data-toggle="tooltip"
                                                                                       data-title="Toggle Fullscreen"
                                                                                       data-placement="bottom"
                                                                                       data-original-title=""
                                                                                       title=""><i
                        class="fa fa-expand"></i></a><a href="javascript:void(0);" class="panel-close"
                                                        data-toggle="tooltip" data-title="Close" data-placement="bottom"
                                                        data-original-title="" title=""><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="input-group m-b-15">
            <input type="text" placeholder="Please add to-do item..." class="input input-sm form-control js-input">
            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-default js-btn-add-item"> <i
                                            class="fa fa-plus m-r-5"></i>Add item</button>
                            </span>
        </div>

        <ul class="todo-list ui-sortable">
            <li class="closed">
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" checked="checked"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>Lorem ipsum dolor sit amet, mel id minimum maluisset.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
            <li>
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>Nec graeci essent luptatum cu, te mei sale essent impedit.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
            <li>
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>Mel ex graecis accusam atomorum. In vitae decore maiorum est.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
            <li>
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>Duo an suscipit scriptorem, ne nec melius periculis definiebas.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
            <li>
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>Has dictas constituto disputando an.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
            <li>
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>At errem altera assueverit sed, qui laoreet delectus incorrupte cu.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
            <li>
                <a href="javascript:void(0);" title="Move"><i
                            class="fa fa-arrows move-handle ui-sortable-handle"></i></a>
                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox"
                                                                                     style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <span>Purto fastidii nam ut, no mei sale postea temporibus.</span>
                <span class="controls pull-right">
                                    <a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" title="Delete"><i
                                                class="fa fa-trash js-delete-todo"></i></a>
                                </span>
            </li>
        </ul>
    </div>
</div>


<?php include 'footer.php'; ?>


</body>

</html>

<!-- Localized -->