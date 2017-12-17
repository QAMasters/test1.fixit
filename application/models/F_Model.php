<?php

class F_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function tickets($where)
    {
        $this->db->where($where);
        $this->db->order_by('updated', 'DESC');
        #$this->db->where($where);
        $query = $this->db->get('tickets');
        return $query;
    }

    public function ticket_history($where)
    {
        $this->db->where($where);
        #$this->db->order_by('updated', 'DESC');
        #$this->db->where($where);
        $query = $this->db->get('history');
        return $query;
    }

    public function add_history($data)
    {
        $this->db->insert('history', $data);
    }

    public function prev_ticket($where)
    {
        $this->db->order_by('updated', 'DESC');
        $this->db->where($where);
        $query = $this->db->get('tickets');
        return $query;
    }

    public function next_ticket($where)
    {
        $this->db->order_by('updated', 'DESC');
        $this->db->limit(1);
        $this->db->where($where);
        $query = $this->db->get('tickets');
        return $query;
    }

    public function vendors($where)
    {
        if ($where != 'all') {
            $this->db->where($where);
        }
        $query = $this->db->get('users');
        return $query;
    }

    public function create_ticket($data)
    {
        $this->db->insert('tickets', $data);
    }

    public function fetch_service()
    {
        $this->db->from('services');
        $this->db->order_by("service", "asc");
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $return[$row['service']] = $row['service'];
            }
        }
        return $return;
    }

    public function fetch_sub_service($service)
    {
        $this->db->where('service', $service);
        $this->db->from('services');
        $this->db->order_by("service asc,sub_service asc");
        $result = $this->db->get();
        $return = '<option value="">Select</option>';
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $return .= '<option value="' . $row['sub_service'] . '">' . $row['sub_service'] . '</option>';
            }
        }

        return $return;
    }

    public function edit_sub_service($service)
    {
        $this->db->where('service', $service);
        $this->db->from('services');
        $result = $this->db->get();
        $return = array();
        $return[''] = 'Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $return[$row['sub_service']] = $row['sub_service'];
            }
        }
        return $return;
    }

    public function ticket_update($data, $where)
    {
        $this->db->where($where);
        $this->db->update('tickets', $data);
    }

    public function get_ini_types($where)
    {
        if ($where != 'all') {
            $this->db->where($where);
        }
        $query = $this->db->get('initiator_type');
        return $query;
    }

    public function add_ini_types($data)
    {
        $this->db->insert('initiator_type', $data);
    }

    public function get_communities($where)
    {
        if ($where != 'all') {
            $this->db->where($where);
        }
        $query = $this->db->get('communities');
        return $query;
    }

    public function add_communities($data)
    {
        $this->db->insert('communities', $data);
    }

    public function getcomments($where)
    {
        $this->db->where($where);
        $query = $this->db->get('comments');
        return $query;
    }

    public function addcomment($data)
    {
        $this->db->insert('comments', $data);
    }

    public function vendor_update($data, $id)
    {
        $this->db->where('email', $data['email']);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            $this->db->where('id', $id);
            $this->db->where('email', $data['email']);
            $query1 = $this->db->get('users');
            if ($query1->num_rows() == 1) {
                $this->db->where('id', $id);
                $this->db->update('users', $data);
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($query->num_rows() == 0) {
            $this->db->where('id', $id);
            $this->db->update('users', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function vendor_create($data)
    {
        $this->db->insert('users', $data);
    }

    public function email_templates_list($where)
    {
        if ($where != 'all') {
            $this->db->where($where);
        }
        $query = $this->db->get('email_templates');
        return $query;
    }

    public function email_templates_update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('email_templates', $data);
    }

    public function appconfig()
    {
        $query = $this->db->get('appconfig');
        return $query;
    }

    public function appconfig_update($data)
    {
        $this->db->where('lang_id', '1');
        $query = $this->db->update('appconfig', $data);
        return $query;
    }

    public function bank_details()
    {
        $query = $this->db->get('bank_details');
        return $query;
    }

    public function bank_update($data)
    {
        $query = $this->db->update('bank_details', $data);
        return $query;
    }

    public function lang_change($data)
    {
        $this->db->where('id', 1);
        $query = $this->db->update('users', $data);
        return $query;
    }

    public function lang_select($where)
    {
        $this->db->where($where);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_invoices($where)
    {
        $this->db->where($where);
        $query = $this->db->get('invoices');
        return $query;
    }

    public function invoice_update($data, $where)
    {
        $this->db->where($where);
        $query = $this->db->update('invoices', $data);
        return $query;
    }

    public function invoice_items($data)
    {
        #$this->db->where($where);
        $query = $this->db->insert('invoice_items', $data);
        return $query;
    }

    public function invoice_items_delete($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('invoice_items');
        return $query;
    }

    public function gen_invoice($data)
    {
        #$this->db->where($where);
        $this->db->insert('invoices', $data);
        //return $query;
    }

    public function get_max_inv()
    {
        $this->db->select('MAX(invoice_id) as max_inv');
        $query = $this->db->get('invoices');
        return $query->row();
    }

    public function inv_items($where)
    {
        $this->db->where($where);
        $query = $this->db->get('invoice_items');
        return $query->result();
    }

    public function get_rot($where)
    {
        $this->db->where($where);
        $query = $this->db->get('rot');
        return $query->row();
    }

    public function add_rot($data)
    {
        $query = $this->db->insert('rot', $data);
    }

    public function update_rot($where, $data)
    {
        $this->db->where($where);
        $query = $this->db->update('rot', $data);
    }

    public function login($where)
    {
        $this->db->where($where);
        $query = $this->db->get('users');
        return $query;
    }

    public function get_events($start, $end)
    {
        return $this->db->where("start >=", $start)->where("end <=", $end)->get("calendar_events");
    }

    public function add_event($data)
    {
        $this->db->insert("calendar_events", $data);
    }

    public function get_event($id)
    {
        return $this->db->where("ID", $id)->get("calendar_events");
    }

    public function update_event($where, $data)
    {
        $this->db->where($where);
        $this->db->update("calendar_events", $data);
    }

    public function delete_event($id)
    {
        $this->db->where("ID", $id)->delete("calendar_events");
    }

    public function profile($where)
    {
        $this->db->where($where);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function profile_update($where, $data)
    {
        $this->db->where($where);
        $query = $this->db->update('users', $data);
    }

    public function material_select($where)
    {
        #$this->db->where($where);
        if ($where != 'all') {
            $this->db->where($where);
        }
        $query = $this->db->get('material');
        return $query;
    }

    public function material_auto_select($like)
    {
        #$this->db->select('item_name');
        $this->db->like('item_name', $like);
        $query = $this->db->get('material');
        return $query;
    }

    public function material_import($data)
    {
        $this->db->insert('material', $data);
    }

    public function material_update($where, $data)
    {
        $this->db->where($where);
        $this->db->update('material', $data);
    }

    public function delete_calendar_event($where)
    {
        $this->db->where($where);
        $this->db->delete('calendar_events');
    }
}

?>