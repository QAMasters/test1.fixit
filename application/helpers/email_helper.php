<?php
if (!function_exists('mail_conf')) {
    function mail_conf($recipient, $subject, $body, $bcc, $attachment)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->library('My_PHPMailer');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('noreplay@reitsolution.se', 'FIXIT');
        $mail->AddAddress($recipient);
        if ($attachment != '') {
            $mail->AddAttachment($attachment);
        }
        if (!empty($bcc)) {
            $mail->addBCC($bcc);
        }
        $ci->db->where('role_id =', '1');
        $admins = $ci->db->get('users')->result();
        foreach ($admins as $admin) {
            $admin_email = $admin->email;
            $mail->addBCC($admin_email);
        }
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        //Send email via SMTP
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "mailout.one.com";
        $mail->Port = 587;
        $mail->Username = "noreplay@reitsolution.se";
        $mail->Password = "India2017";
        #$mail->SMTPDebug = 1;
        $mail->send();
    }
}
if (!function_exists('email_send')) {
    function email_send($ticket_id, $tpl_name)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->library('session');
        $ci->load->library('My_PHPMailer');
        $response = false;
        $ci->db->where('ticket_id =', $ticket_id);
        $ticket = $ci->db->get('tickets')->row();
        $ci->db->where('tpl_name =', $tpl_name);
        $ci->db->where('lang_id =', $ci->session->userdata('pref_lang'));
        $tpl = $ci->db->get('email_templates')->row();
        $subject = str_replace("{{ticket_id}}", $ticket_id, $tpl->subject);
        $body = str_replace("{{ticket_id}}", $ticket_id, $tpl->message);
        $body = str_replace("{{ini_name}}", $ticket->ini_name, $body);
        $body = str_replace("{{session_user}}", $ci->session->userdata('fname'), $body);
        $body = str_replace("{{base_url}}", base_url(), $body);
        $body = str_replace("{{ini_phone}}", $ticket->ini_phone, $body);
        $recipient = $ticket->ini_email;
        #$subject = trim("[Ticket: ".$ticket_id." ]");
        if ($tpl_name == 'share_ticket') {
            $attachment = "./tickets/" . $ticket_id . ".pdf";
        } else {
            $attachment = '';
        }

        mail_conf($recipient, $subject, $body, '', $attachment);
    }
}

if (!function_exists('share_ticket_email')) {
    function share_ticket_email($ticket_id, $tpl_name, $share_email)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->library('session');
        $ci->load->library('My_PHPMailer');
        $response = false;
        $ci->db->where('ticket_id =', $ticket_id);
        $ticket = $ci->db->get('tickets')->row();
        $ci->db->where('tpl_name =', $tpl_name);
        $ci->db->where('lang_id =', $ci->session->userdata('pref_lang'));
        $tpl = $ci->db->get('email_templates')->row();
        $subject = str_replace("{{ticket_id}}", $ticket_id, $tpl->subject);
        $body = str_replace("{{ticket_id}}", $ticket_id, $tpl->message);
        $body = str_replace("{{ini_name}}", $ticket->ini_name, $body);
        $body = str_replace("{{session_user}}", $ci->session->userdata('fname'), $body);
        $body = str_replace("{{base_url}}", base_url(), $body);
        $body = str_replace("{{ini_phone}}", $ticket->ini_phone, $body);
        $recipient = $share_email;
        #$subject = trim("[Ticket: ".$ticket_id." ]");
        if ($tpl_name == 'share_ticket') {
            $attachment = "./tickets/" . $ticket_id . ".pdf";
        } else {
            $attachment = '';
        }

        mail_conf($recipient, $subject, $body, '', $attachment);
    }
}
?>