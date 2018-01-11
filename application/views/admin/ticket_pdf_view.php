
<?php 
if($ticket->emergency == '1'){
  $emergency = 'Emergency Ticket'; 
}else{
  $emergency = '';
}
#print_r($comments);
$comments_count = 0;
foreach ($comments as $key) {

  $list_comments .= '<tr>
      <td width="70%" height="40px">'.$key->comments.'</td>
      <td>'.get_user_name($key->commented_by)->fname.'</td>
    </tr>';
  $comments_count = $comments_count+1;
}
if($comments_count != 0){
  $comments_data = '<div class="container">
    <center><h3 style="text-align:center">Comments</h3></center>
    <table class="table table-bordered table-stripped">
    <thead><tr>
  <td width="70%" height="40px" style="text-align:center">Comments</td><td style="text-align:center">Commented By</td></tr></thead>
  <tbody>
    '.$list_comments.'   
  </tbody>
</table></div>';  
}else{
  $comments_data = '';
}

$html ='<!DOCTYPE html>
<html>
<head>
<style>
.table tr td{
padding-left: 10px;
}
</style>
</head>
<body>
<div class="container">
    <center><h3 style="text-align:center">Ticket Details <font color="red"> '.$emergency.'</font></h3></center>
    <table class="table table-bordered table-stripped">
  <tbody>
    <tr>
      <td width="50%" height="40px">Ticket ID:'.$ticket->ticket_id.'</td>
      <td>Status: '.$ticket->status.'</td>
    </tr>
    <tr>
      <td height="40px"><strong>Vendor:</strong> '.get_user_name($ticket->vendor)->fname.'</td>
      <td></td>
    </tr>
    <tr>
      <td height="40px"><strong>Name:</strong> '.$ticket->ini_name.'</td>
      <td><strong>Phone:</strong> '.$ticket->ini_phone.'</td>
    </tr>
    <tr>
      <td height="40px"><strong>Email:</strong> '.$ticket->ini_email.'</td>
      <td></td>
    </tr>
    <tr>
      <td height="40px"><strong>Address:</strong> '.$ticket->ini_address.'</td>
      <td><strong>Door Code:</strong> '.$ticket->ini_doornum.'</td>
    </tr>
    <tr>
      <td height="40px"><strong>Initiator Type:</strong> '.$ticket->ini_type.'</td>
      <td><strong>Preferred Time:</strong> '.$ticket->pref_s_time." TO ".$ticket->pref_e_time.'</td>
    </tr>
    <tr>
      <td height="40px"><strong>Keys in Tube:</strong> '.$ticket->keys_tube.'</td>
      <td><strong>Pets at Home:</strong> '.$ticket->pets_home.'</td>
    </tr>
    <tr>
      <td height="40px"><strong>Community:</strong> '.$ticket->community.'</td>
      <td><strong></strong> </td>
    </tr>
    <tr>
      <td height="40px"><strong>Location:</strong> '.$ticket->service.'</td>
      <td><strong>Problem:</strong> '.$ticket->sub_service.'</td>
    </tr>
    <tr>
      <td height="40px"><strong>Description:</strong> '.$ticket->description.'</td>
      <td><strong></strong> </td>
    </tr>
  </tbody>
</table>
</div>
'.$comments_data.'
</body>
</html>';

#echo $html;
$stylesheet = '<link href="'.base_url().'assets/css/bootstrap.min.css" rel="stylesheet">';
$this->m_pdf->pdf->WriteHTML($stylesheet, 1);
$this->m_pdf->pdf->WriteHTML($html);
$this->m_pdf->pdf->SetTitle('Ticket ID : '.$ticket->ticket_id);
if($pdf == 'view'){
  $this->m_pdf->pdf->Output($ticket->ticket_id, "I");
}else if($pdf == 'send_email'){
  $file_path= "./tickets/".$ticket->ticket_id.".pdf";
  $this->m_pdf->pdf->Output($file_path, "F");
  share_ticket_email($ticket->ticket_id,'share_ticket',$share_email);
  redirect($_SERVER['HTTP_REFERER']);
}

exit;
?>