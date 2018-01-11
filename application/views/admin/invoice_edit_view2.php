<?php

$xheader = '
<link href="'.base_url().'assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<style>
#item-pnl {
    margin: 0 0 30px;
    border: solid 1px #eeeeee;
}
#item-pnl .items-pnl-head{
    margin: 0;
    color: #000000;
    font-weight: bold;
    background-color: #eeeeee;
}
#item-pnl .items-pnl-head .col{
    padding: 10px;
    text-align: center;
    border-right:#ffffff solid 1px ;
}
#item-pnl .items-pnl-body{
    margin: 0;
    color: #000000;
}
#item-pnl .items-pnl-body .col{
    padding: 10px;
}
#item-pnl .items-pnl-body .col p{
    text-align: center !important;
}
#item-pnl .items-pnl-body .col input[type]{
    text-align: center;
}
#item-pnl .items-pnl-body .col .firstCol{
    text-align: left !important;
}
#item-pnl .items-pnl-body .col .glyphicon-remove-circle{
    font-size: 22px;
    color: #680000;
    margin-top: 6px;
}
#item-pnl .items-pnl-body .input-group-addon{
    font-size:12px;
    padding:6px;
}
#item-pnl .items-pnl-body .col p{
    margin-top: 7px;
    font-size: 14px;
    font-weight: bold;
}
</style>

';
$xfooter='
    <script src="'.base_url().'inv/js/jquery.validate.min.js"></script>
    <script src="'.base_url().'inv/js/custom.js"></script>
    <script src="'.base_url().'inv/js/colorpicker.js"></script>
    <script src="'.base_url().'inv/js/eye.js"></script>
    <script src="j'.base_url().'inv/js/calender.js"></script>
';
include 'header.php';
?>
    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line('invoices');?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line('home');?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line('invoices');?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line('inv_req');?></strong>
                        </li>
                    </ol>
                </div>

            </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content p-xl">

        <form method="post" name="myform" id="invocie_form" enctype="multipart/form-data" onsubmit="return OnSubmitForm();">

            <div class="row">
                <div class="col-sm-6">
                    <img src="logo.png" width="300px" height="200px">
                </div>
                <div class="col-sm-6 table-responsive m-t">
                    <table class="table table-bordered">
                        <tr><td colspan="4" width="800px"><h1 align="center"><b>Faktura</b></h1></td></tr>
                        <tr><td align="center" width="25%" height="50px"><b>Fakturanummer</b> <br><?php echo $inv->invoice_id; ?></td>
                            <td align="center" width="25%"><b>Kundnummber</b> <br></td>
                            <td align="center" width="25%"><b>Fakturadatum</b> <br><input type="text" name="invoice_date" value="<?php echo $inv->invoice_date; ?>"></td>
                            <td align="center" width="25%"><b>Sida</b> <br>1</td></tr>
                        <tr style="vertical-align: top; text-align: left;"><td colspan="4" width="25%" height="100px"><b>Faktureringsadress</b><br><?php echo $tic->ini_name."<br>".$tic->ini_address;?></td></tr>
                    </table>
                </div>
            </div>
            <br>
            <table class="table table-borderless">
                <tr><td width="50%" height="20px"><b>var referns</b> : <?php echo $tic->vendor; ?></td><td width="50%"><b>Betalningsvillkor</b>  : 
                <select name="bill_due">
                <?php
                if($inv->bill_due_date == '10'){
                    echo '<option value="10" selected> 10 days </option><option value="20"> 20 days </option><option value="30"> 30 days </option>';
                }else if($inv->bill_due_date == '20'){
                    echo '<option value="10"> 10 days </option><option value="20" selected> 20 days </option><option value="30"> 30 days </option>';
                }else if($inv->bill_due_date == '30'){
                    echo '<option value="10"> 10 days </option><option value="20"> 20 days </option><option value="30" selected> 30 days </option>';
                }
                ?>
                    
                </select></td></tr>
                <tr><td width="50%" height="20px"><b>Er referens</b> : <?php echo $tic->ini_name; ?></td><td width="50%"><b>förfallodatum</b> : <?php echo $inv->bill_due_date;?></td></tr>
                <tr><td width="50%" height="20px"><b>Ert Ordernummer</b> : <?php echo $tic->ticket_id; ?></td><td width="50%"></td></tr>
            </table>
            <table class="table table-bordered">                            
                <tr><td>Description</td></tr>
                <tr><td><textarea class="form-control" name="description"><?php echo $inv->description?></textarea></td></tr>
            </table> 
            <h4>ROT Status: <?php echo $inv->rot; ?></h4>
            <a href='#Rot' data-toggle='modal' data-hover='tooltip' title='Close Ticket' data-placement='top' data-whatever="<?php echo $tic->ticket_id;?>" class='btn btn-primary'>View/Add ROT Data</a>

           <br><br>

            <div id="item-pnl">
                <div class="row items-pnl-head">
                    <div class="col-sm-1 col" >ACTION</div>
                    <div class="col-sm-5 col extendable" style="text-align: left">PRODUCTS</div>
                    <div class="col-sm-1 col" >UNIT</div>
                    <div class="col-sm-1 col" >QUANTITY</div>
                    <div class="col-sm-1 col">PRICE</div>
                    <div class="col-sm-1 col taxCol" >TAX</div>
                    <div class="col-sm-1 col disCol">DISCOUNT</div>
                    <div class="col-sm-1 col" style="border-right:0">TOTAL</div>
                </div>

                <div class="row items-pnl-body" id="item-row">
                    <div class="col-sm-1 col" >
                        <p>
                            <button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add more" id="add">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </p>
                    </div>
                    <div class="col-sm-5 col extendable ">
                        <input type="text" class="form-control firstCol req" name="proName[]" placeholder="Title">
                    </div>
                    <div class="col-sm-1 col extendable ">
                        <select name="quantity_type[]" class="form-control">
                            <option value="hours">hours</option>
                            <option value="pieces">pieces</option>
                        </select>
                    </div>
                    <div class="col-sm-1 col" >
                        <input type="text" class="form-control req amnt" value="1" name="amount[]"  id="amount-0" onkeypress="return isNumber(event)" onkeyup="calTotal('0'), calSubtotal()" autocomplete="off">
                    </div>
                    <div class="col-sm-1 col">
                        <div class="input-group">
                            <div class="input-group-addon currenty">$</div>
                            <input type="text" class="form-control req prc"  name="price[]" id="price-0" onkeypress="return isNumber(event)" onkeyup="calTotal('0'), calSubtotal()"  autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-1 col taxCol" >
                        <div class="input-group">
                            <input type="text" class="form-control vat" name="vat[]" id="vat-0" onkeypress="return isNumber(event)"   onkeyup="calTotal('0'), calSubtotal()" autocomplete="off">
                            <div class="input-group-addon default-addon-tax">%</div>
                        </div>
                    </div>
                    <div class="col-sm-1 col disCol">
                        <div class="input-group">
                            <input type="text" class="form-control discount"   name="discount[]" onkeypress="return isNumber(event)"  id="discount-0" onkeyup="calTotal('0'), calSubtotal()" autocomplete="off">
                            <div class="input-group-addon  default-addon">%</div>
                        </div>
                    </div>
                    <div class="col-sm-1 col">
                        <p><span class="currenty">$</span> <span  class='ttlText' id="result-0">0</span></p>
                        <input type="hidden" class="ttInput"  name="total[]" id="total-0" value="0">
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8" id="tax-row">
                    <div class="col-xs-2">
                        <!--<button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add Taxes, Shipping, Handling or Other Fees" id="addTax">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>-->
                    </div>
                    <div class="col-xs-5">
                        <h1 class="subtotalCap">Sub Total</h1>
                    </div>
                    <div class="col-xs-5">
                        <input type="hidden" value="0" id="subTotalInput" name="subtotal" >
                        <h1 class="subtotalCap">
                            <span class="currenty lightMode">$</span>
                            <span id="subTotal" class="lightMode">0</span>
                        </h1>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8">
                    <div class="totalbill-row">
                        <div class="col-xs-5 col-sm-offset-2" >
                            <h1>Total : </h1>
                        </div>
                        <div class="col-xs-5" >
                            <h1><span class="currenty">$</span> <span id="totalBill">0</span></h1>
                            <input type="hidden" value="0" name="totalBill" id="totalBillInput">
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" value="0" id="taxCounter" >
            <input type="hidden" value="0" name="counter" id="counter">
            <input type="hidden" value="$" name="currency" id="currencyInput" >
            <input type="hidden" value="%" name="taxformat" id="taxFormatInput">
            <input type="hidden" value="%" name="discountFormat" id="DisFormatInput">
            <input type="hidden" value="yes" name="applyTax" id="applyTaxInput">
            <input type="hidden" value="yes" name="applyDiscount" id="applyDiscount">
            <input type="hidden" value="true"  name="AccessFlag">

        </form>
    </div>

    </div>
<?php
include 'footer.php';
?>

</body>
</html>