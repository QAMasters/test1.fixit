<?php
if (!function_exists('ticket_age')) {
    function ticket_age($creation_date)
    {
        $current_date = date("Y-m-d");
        $created_on1 = substr($creation_date, 0, 10);
        $date1 = date_create($created_on1);
        $date2 = date_create($current_date);
        $diff = date_diff($date1, $date2);
        $ticket_age = $diff->format("%a");
        return $ticket_age;
    }
}
if (!function_exists('creation_date_only')) {
    function creation_date_only($creation_date)
    {
        $created_on1 = substr($creation_date, 0, 10);
        return $created_on1;
    }
}
if (!function_exists('status_label')) {
    function status_label($status)
    {
        if ($status == 'New') {
            $label = 'success';
            return $label;
        }
        if (substr($status, 0, 11) == 'Assigned to') {
            $label = 'primary';
            return $label;
        }
        if (substr($status, 0, 11) == 'Accepted by') {
            $label = 'primary';
            return $label;
        }
        if (substr($status, 0, 11) == 'Rejected by') {
            $label = 'danger';
            return $label;
        }
        if (substr($status, 0, 6) == 'Closed') {
            $label = 'warning';
            return $label;
        }
        if (substr($status, 0, 7) == 'Deleted') {
            $label = 'default';
            return $label;
        }
        if (substr($status, 0, 17) == 'Invoice Requested') {
            $label = 'info';
            return $label;
        }
        if (substr($status, 0, 14) == 'Invoice Raised') {
            $label = 'warning';
            return $label;
        }
        if (substr($status, 0, 14) == 'Paid') {
            $label = 'primary';
            return $label;
        }
        if (substr($status, 0, 14) == 'UnPaid') {
            $label = 'danger';
            return $label;
        }
    }
}
if (!function_exists('vendor_status_lbl')) {
    function vendor_status_lbl($status)
    {
        if ($status == 'Enabled') {
            $label = 'primary';
            return $label;
        }
        if ($status == 'Disabled') {
            $label = 'warning';
            return $label;
        }
    }
}
if (!function_exists('vendor_status')) {
    function vendor_status($code)
    {
        $ci =& get_instance();
        $pref_lang = $ci->session->userdata('pref_lang');
        if ($pref_lang == 1) {
            $idiom = 'english';
        } else if ($pref_lang == 2) {
            $idiom = 'swedish';
        }
        $ci->lang->load("all", $idiom);

        if ($code == '1') {
            $status = 'Enabled';
            return $status;
        }
        if ($code == '0') {
            $status = 'Disabled';
            return $status;
        }
    }
}
if (!function_exists('gen_tic_id')) {
    function gen_tic_id()
    {
        $un_id = uniqid();
        $ticket_id = 'TKT' . strtoupper($un_id);
        return $ticket_id;
    }
}
if (!function_exists('current_time')) {
    function current_time()
    {
        $current_time = date("Y-m-d H:i:s");
        return $current_time;
    }
}
if (!function_exists('get_user_name')) {
    function get_user_name($id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM `users` WHERE `id` = '" . $id . "'";
        $query = $ci->db->query($sql);
        return $query->row();
    }
}
if (!function_exists('draft_tic_count')) {
    function draft_tic_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status =', 'Draft');
        $ci->db->where('created_by = "' . $ci->session->id . '"');
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('my_tic_count')) {
    function my_tic_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status !=', 'Closed');
        $ci->db->where('status !=', 'Deleted');
        $ci->db->where('status !=', 'Invoice Requested');
        $ci->db->where('status !=', 'Invoice Raised');
        $ci->db->where('status !=', 'Rejected by');
        $ci->db->where('vendor = "' . $ci->session->id . '"');
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('open_tickets_count')) {
    function open_tickets_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status !=', 'Draft');
        $ci->db->where('status !=', 'Closed');
        $ci->db->where('status !=', 'Deleted');
        $ci->db->where('status !=', 'Invoice Requested');
        $ci->db->where('status !=', 'Invoice Raised');
        if ($ci->session->role_id == 2) {
            $ci->db->where('vendor !=', $ci->session->id);
        }
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('closed_tickets_count')) {
    function closed_tickets_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status', 'Closed');
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('deleted_tickets_count')) {
    function deleted_tickets_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status', 'Deleted');
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('alert_invoices')) {
    function alert_invoices()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status', 'Invoice Requested');
        $ci->db->from('tickets');
        $ci->db->limit(3);
        $query = $ci->db->get();
        return $query->result();
    }
}
if (!function_exists('alert_invoices_count')) {
    function alert_invoices_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status', 'Invoice Requested');
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('alert_tickets')) {
    function alert_tickets()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status', 'New');
        $ci->db->order_by("emergency", "desc");
        $ci->db->order_by("created_on", "desc");
        $ci->db->from('tickets');
        $ci->db->limit(3);
        $query = $ci->db->get();
        return $query->result();
    }
}
if (!function_exists('alert_tickets_count')) {
    function alert_tickets_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status', 'New');
        $query = $ci->db->count_all_results('tickets');
        return $query;
    }
}
if (!function_exists('vendor_active_count')) {
    function vendor_active_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status =', '1');
        $ci->db->where('role_id =', '2');
        $query = $ci->db->count_all_results('users');
        return $query;
    }
}
if (!function_exists('vendor_inactive_count')) {
    function vendor_inactive_count()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->where('status =', '0');
        $ci->db->where('role_id =', '2');
        $query = $ci->db->count_all_results('users');
        return $query;
    }
}

if (!function_exists('ticket_image_upload')) {
    function ticket_image_upload($ticket_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $config['upload_path'] = './uploads/ticket_images';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1000;
        $config['file_name'] = md5($ticket_id);
        $config['file_ext_tolower'] = TRUE;
        $config['overwrite'] = FALSE;
        $ci->load->library('upload', $config);
        if (!$ci->upload->do_upload('image')) {
            $error = array('error' => $ci->upload->display_errors());
            #print_r($error);
            #$this->load->view('admin/profile_view', $error);
        } else {
            $data = array('upload_data' => $ci->upload->data());
            $file_data = $data['upload_data'];
        }
    }
}

if (!function_exists('site_data')) {
    function site_data()
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get('appconfig');
        return $query->row();
    }
}

?>