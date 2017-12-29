<?php
$logo = base_url() . '/uploads/logo/' . $appconfig->logo;
$items = "";
$shipping = 0;
$total = 0.00;
$vat_tax = 0.00;
$tax_credit = 0;

foreach ($inv_items as $inv_item) {
    $items .= '<tr>
  <tr><td width="30%" height="30px">' . $inv_item->item_name . '</td>
  <td width="10%">' . $inv_item->unit . '</td>
  <td>' . $inv_item->quantity . '</td>
  <td width="10%">' . $inv_item->price . '</td>
  <td width="20%">' . $inv_item->discount . '</td>
  <td width="20%">' . $inv_item->surcharge . '</td>
  <td width="15%">' . $inv_item->sub_total . '</td>
  </tr>';
    if (strpos($inv_item->item_name, 'Frakt') !== false) {
        $shipping = $shipping + ($inv_item->quantity * $inv_item->price);
    }
    if (strpos($inv_item->item_name, 'Rot') !== false) {
        $tax_credit = $tax_credit + ($inv_item->quantity * $inv_item->price);
    }
    $total = $total + $inv_item->sub_total;

}
$vat_tax = (25 / 100) * $total;
$tax_credit1 = (((25 / 100) * $tax_credit) + $tax_credit);
$tax_credit2 = ((30 / 100) * $tax_credit1);


$grand_total = $total + $shipping + $vat_tax;
$grand_total1 = round($grand_total);
$rounding = abs($grand_total - $grand_total1);
$grand_total2 = $grand_total1 - $shipping;
$grand_total3 = $grand_total2 - $tax_credit2;


$rot_labels = '';
if ($rot->label1 != '') {
    $rot_labels = $rot_labels . "Fastighetsbeteckning : " . $rot->label1 . "<br>";
}
if ($rot->label2 != '') {
    $rot_labels = $rot_labels . "Lägenhetsbeteckning :" . $rot->label2 . "<br>";
}
if ($rot->label3 != '') {
    $rot_labels = $rot_labels . "Bostadsrättsförenings : " . $rot->label3 . "<br>";
}
if ($rot->personal_number != '') {
    $rot_labels = $rot_labels . "Personnummer : " . $rot->personal_number . "<br>";
}
if ($invoice->rot == "Enabled") {
    $rot_data = $appconfig->rot_data . "<br>" . $rot_labels;
} else if ($invoice->rot == "Disabled") {
    $rot_data = '';
}

$html = '<!DOCTYPE html>
<html>
<head>
<style>
.table tr td{
padding-left: 10px;
}

/* FOOTER */
.footer {
  background: none repeat scroll 0 0 white;
  border-top: 1px solid #e7eaec;
  bottom: 0;
  left: 0;
  padding: 10px 20px;
  position: absolute;
  right: 0;
}
.footer.fixed_full {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  padding: 10px 20px;
  background: white;
  border-top: 1px solid #e7eaec;
}
.footer.fixed {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  padding: 10px 20px;
  background: white;
  border-top: 1px solid #e7eaec;
  margin-left: 220px;
}
body.mini-navbar .footer.fixed,
body.body-small.mini-navbar .footer.fixed {
  margin: 0 0 0 70px;
}
body.mini-navbar.canvas-menu .footer.fixed,
body.canvas-menu .footer.fixed {
  margin: 0 !important;
}
body.fixed-sidebar.body-small.mini-navbar .footer.fixed {
  margin: 0 0 0 220px;
}
body.body-small .footer.fixed {
  margin-left: 0;
}
</style>
</head>
<body>
<div class="row">
<table width="100%">
<tr>
<td width="50%" rowspan="3"><img src="' . $logo . '" ></td>
<td width="50%" height="50px">
<table width="100%" class="table table-bordered">
<tr><td height="50px" colspan="4" align="center" style="font-size:14px;"><h2>Faktura</h2></td></tr>
<tr><td height="50px" align="center"><b>Fakturanummer</b><br>' . $invoice->invoice_id . '</td>
<td align="center"><b>Kundnummber</b><br>&nbsp;&nbsp;</td>
<td align="center"><b>Fakturadatum</b><br>' . $invoice->invoice_date . '</td>
<td align="center"><b>Sida</b><br>1</td></tr>
<tr><td colspan="4" height="100px" style="vertical-align: top; text-align: left;"><b>Faktureringsadress</b><br>' . $ticket->ini_name . '<br>' . $ticket->ini_address . '</td></tr>
</table>
</td></tr>
</table>
<br>
<table width="100%">
<tr><td width="50%" height="25px" style="padding-left: 2cm;"><b>Vår referns</b> : ' . $ticket->vendor . '</td>
<td width="50%" style="padding-left: 2cm;"><b>Betalningsvillkor</b>  : ' . $invoice->bill_due . ' days</td></tr>
<tr><td width="50%" height="25px" style="padding-left: 2cm;"><b>Er referens</b> : ' . $ticket->ini_name . '</td>
<td width="50%" style="padding-left: 2cm;"><b>Förfallodatum</b>  : ' . date('Y-m-d', strtotime($invoice->invoice_date . ' + ' . $invoice->bill_due . ' days')) . '</td></tr>
<tr><td width="50%" height="25px" style="padding-left: 2cm;"><b>Ert Ordernummer</b> : ' . $invoice->ticket_id . '</td></tr>
</table>
</div>
<br>

<div class="row">
<table class="table table-bordered" width="100%">
<tr><th width="30%" height="40px" align="center">Artikel</th>
<th width="10%" align="center">Enhet</th>
<th width="10%" align="center">Antal</th>
<th width="10%" align="center">Pris</th>
<th width="10%" align="center">Rabatt</th>
<th width="10%" align="center">Påslag</th>
<th width="15%" align="center">Total</th>
</tr>
<tr><td colspan="7" height="60px"><i>' . $invoice->description . '</i></td>
</tr>
' . $items . '
<tr><td colspan="7" height=""></td></tr>
<tr><td colspan="4" height="100px" rowspan="7" style="padding: 0px 0px 0px 10px;">' . $rot_data . '</td><td></td></tr>

<tr><td colspan="2" height="30px;">Frakt </td><td align="right" style="padding: 0px 20px 0px 0px;">' . $shipping . '</td></tr>
<tr><td colspan="2" height="30px;">Belopp fore moms </td><td align="right" style="padding: 0px 20px 0px 0px;">' . $total . '</td></tr>
<tr><td colspan="2" height="30px;">Moms </td><td align="right" style="padding: 0px 20px 0px 0px;">' . $vat_tax . '</td></tr>
<tr><td colspan="2" height="30px;">Öresutjämning </td><td align="right" style="padding: 0px 20px 0px 0px;">' . $rounding . '</td></tr>
<tr><td colspan="2" height="30px;">Skattereduktion </td><td align="right" style="padding: 0px 20px 0px 0px;">' . $tax_credit2 . '</td></tr>
<tr><td colspan="2" height="30px;"><b>Summa att betala </b></td><td align="right" style="padding: 0px 20px 0px 0px;">' . $grand_total3 . '</td>
</tr>
</table>
</div>
<div class="footer fixed">
  <table width="100%" class="table">
<tr><td height="30px">' . $bank_details->c_name . '</td>
<td>Telefon</td>' . $$bank_details->phone . '<td></td><td>Bankgiro</td><td>' . $bank_details->ac_num . '</td></tr>
<tr><td height="30px">' . $bank_details->d1 . '</td>
<td>E-post</td><td>' . $bank_details->email . '</td><td colspan="2">' . $bank_details->d2 . '</td></tr>
<tr><td height="30px">' . $bank_details->d3 . '</td>
<td>Hemsida</td><td>' . $bank_details->website . '</td><td colspan="2">' . $bank_details->d4 . '</td></tr>
<tr><td colspan="5" align="right" height="30px">' . $bank_details->d5 . '</td></tr>
</table>
</div>
</body>
</html>';


#echo $html;
$stylesheet = '<link href="' . base_url() . 'assets/css/bootstrap.min.css" rel="stylesheet">';
$this->m_pdf->pdf->WriteHTML($stylesheet, 1);
$this->m_pdf->pdf->WriteHTML($html);
$this->m_pdf->pdf->SetTitle('Ticket ID : ' . $ticket->ticket_id);

$this->m_pdf->pdf->SetWatermarkText('FIXIT');
$this->m_pdf->pdf->watermark_font = 'DejaVuSansCondensed';
$this->m_pdf->pdf->showWatermarkText = true;

if ($pdf == 'view') {
    $this->m_pdf->pdf->Output($ticket->ticket_id, "I");
} else if ($pdf == 'send_email') {
    $file_path = "./invoices/" . $ticket->ticket_id . ".pdf";
    $this->m_pdf->pdf->Output($file_path, "F");
    email_send($ticket->ticket_id, 'send_invoice');
    redirect($_SERVER['HTTP_REFERER']);
}

exit;
?>