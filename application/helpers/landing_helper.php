<?php
if (!function_exists('ticket_status_id')) {
    function ticket_status_id($id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('ticket_id =', $id);
        $query = $ci->db->get('tickets');
        $status = $query->row()->status;
        if (substr($status, 0, 3) == 'New') {
            $status_id = '1';
        } else if (substr($status, 0, 3) == 'Ass' OR substr($status, 0, 3) == 'Rej' OR substr($status, 0, 3) == 'Acc') {
            $status_id = '2';
        } else if (substr($status, 0, 14) == 'Invoice Raised') {
            $status_id = '3';
        } else if (substr($status, 0, 17) == 'Invoice Requested') {
            $status_id = '5';
        } else if (substr($status, 0, 6) == 'Closed') {
            $status_id = '5';
        }
        return $status_id;
    }
}

?>