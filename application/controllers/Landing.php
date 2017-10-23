<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
        $this->load->helper('email');
        $this->load->helper('landing');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->helper('directory');
        $this->load->model('F_Model');

        if (!isset($_COOKIE["lang"])) {
            $pref_lang = 'sw';
        } else {
            $pref_lang = $_COOKIE["lang"];
        }
        if ($pref_lang == 'en') {
            $idiom = 'english';
        } else if ($pref_lang == 'sw') {
            $idiom = 'swedish';
        }
        $this->lang->load("all", $idiom);
    }

    public function index()
    {
        $this->load->view('landing/index_view');
    }

    public function create_ticket()
    {
        $create = $this->input->post('create');
        if (isset($create)) {
            $ticket_id = gen_tic_id();
            $start_date = $this->input->post('i_pref_s_time');
            $end_date = $this->input->post('i_pref_e_time');
            if (!empty($start_date)) {
                $sd = DateTime::createFromFormat("Y-m-d H:i", $start_date);
                $start_date = $sd->format('Y-m-d H:i:s');
                $start_date_timestamp = $sd->getTimestamp();
            }
            if (!empty($end_date)) {
                $ed = DateTime::createFromFormat("Y-m-d H:i", $end_date);
                $end_date = $ed->format('Y-m-d H:i:s');
                $end_date_timestamp = $ed->getTimestamp();
            }
            $ini_type = $this->input->post('ini_type');
            $where = 'ini_type = "' . $ini_type . '"';
            $ini_type_count = $this->F_Model->get_ini_types($where)->num_rows();
            if ($ini_type_count == '0') {
                $data = array('ini_type' => $ini_type);
                $this->F_Model->add_ini_types($data);
            }
            $community = $this->input->post('community');
            $where = 'community = "' . $community . '"';
            $community_count = $this->F_Model->get_communities($where)->num_rows();
            if ($community_count == '0') {
                $data = array('community' => $community,);
                $this->F_Model->add_communities($data);
            }
            if ($this->input->post('emergency') == 'on') {
                $emergency = 1;
            } else {
                $emergency = 0;
            }
            $data = array(
                'ticket_id' => $ticket_id,
                'ini_name' => $this->input->post('i_name'),
                'ini_phone' => $this->input->post('i_phone'),
                'ini_email' => $this->input->post('i_email'),
                'ini_address' => $this->input->post('i_address'),
                'ini_doornum' => $this->input->post('i_door_code'),
                'ini_type' => $ini_type,
                'keys_tube' => $this->input->post('i_keys_tube'),
                'pets_home' => $this->input->post('i_pets_home'),
                'pets_data' => $this->input->post('pets_data'),
                'pref_s_time' => $this->input->post('i_pref_s_time'),
                'pref_e_time' => $this->input->post('i_pref_e_time'),
                'community' => $community,
                'service' => $this->input->post('service'),
                'sub_service' => $this->input->post('sub_service'),
                'description' => $this->input->post('i_desc'),
                'status' => 'New',
                'created_by' => '0',
                'created_on' => current_time(),
                'Updated' => current_time(),
                'emergency' => $emergency
            );
            $this->F_Model->create_ticket($data);
            if ($_FILES['image']) {
                ticket_image_upload($ticket_id);
            }
            $this->F_Model->add_event(array(
                    "title" => $ticket_id,
                    "description" => $this->input->post('i_desc'),
                    "start" => $start_date,
                    "end" => $end_date
                )
            );
            email_send($ticket_id, 'ticket_create');
            $data['message'] = 'Ticket Created Successfully';
            $data['text'] = 'Ticket ID is <b>' . $ticket_id . '</b>. Details sent via email, please check your email!';
            $data['new_ticket_id'] = $ticket_id;
        }
        $ini_where = 'all';
        $data['ini_types'] = $this->F_Model->get_ini_types($ini_where)->result();
        $community_where = 'all';
        $data['communities'] = $this->F_Model->get_communities($community_where)->result();

        $get_service = $this->input->get('service');
        if (!empty($get_service)) {
            $data['selected_service'] = $this->input->get('service');

            $data['selected_sub_service'] = $this->F_Model->edit_sub_service($data['selected_service']);
        } else {
            $data['selected_service'] = '';
            $data['selected_sub_service'] = '';
        }

        $new_ticket_id = $this->input->post('new_ticket_id');
        if (!empty($new_ticket_id)) {
            $where = 'ticket_id = "' . $new_ticket_id . '" AND status != "Invoice Raised" AND status != "Invoice Requested"';
            $data['n_ticket'] = $this->F_Model->tickets($where)->row();
            print_r($data['n_ticket']->service);
            $data['selected_service'] = $data['n_ticket']->service;
            $data['selected_sub_service'] = $this->F_Model->edit_sub_service($data['selected_service']);
            $data['selected_sub_service1'] = $data['n_ticket']->sub_service;
        } else {
            $data['selected_sub_service1'] = '';
        }

        $services = $this->F_Model->fetch_service();
        $data['services'] = $services;
        $this->load->view('landing/ticket_create_view', $data);
    }

    public function track_ticket()
    {
        $data['services'] = $this->F_Model->fetch_service();
        $data['ini_types'] = $this->F_Model->get_ini_types('all')->result();
        $data['communities'] = $this->F_Model->get_communities('all')->result();
        $ticket_id = $this->input->get('ticket_id');
        $phone = $this->input->get('phone');
        $update = $this->input->post('update');
        if (isset($update)) {
            $ticket_id = $this->input->post('ticket_id');
            $ini_type = $this->input->post('ini_type');
            $where = 'ini_type = "' . $ini_type . '"';
            $ini_type_count = $this->F_Model->get_ini_types($where)->num_rows();
            if ($ini_type_count == '0') {
                $data = array('ini_type' => $ini_type);
                $this->F_Model->add_ini_types($data);
            }
            $community = $this->input->post('community');
            $where = 'community = "' . $community . '"';
            $community_count = $this->F_Model->get_communities($where)->num_rows();
            if ($community_count == '0') {
                $data = array('community' => $community);
                $this->F_Model->add_communities($data);
            }
            if ($this->input->post('emergency') == 'on') {
                $emergency = 1;
            } else {
                $emergency = 0;
            }
            $data = array(
                'ini_name' => $this->input->post('i_name'),
                'ini_phone' => $this->input->post('i_phone'),
                'ini_email' => $this->input->post('i_email'),
                'ini_address' => $this->input->post('i_address'),
                'ini_doornum' => $this->input->post('i_door_code'),
                'ini_type' => $ini_type,
                'keys_tube' => $this->input->post('i_keys_tube'),
                'pets_home' => $this->input->post('i_pets_home'),
                'pets_data' => $this->input->post('pets_data'),
                'pref_s_time' => $this->input->post('i_pref_s_time'),
                'pref_e_time' => $this->input->post('i_pref_e_time'),
                'community' => $community,
                'service' => $this->input->post('service'),
                'sub_service' => $this->input->post('sub_service'),
                'description' => $this->input->post('i_desc'),
                'Updated' => current_time(),
                'emergency' => $emergency
            );
            $where = 'ticket_id = "' . $ticket_id . '"';
            $this->F_Model->ticket_update($data, $where);
            if ($_FILES['image']) {
                ticket_image_upload($ticket_id);
            }
            $data['message'] = "Ticket Updated Successfully!";
        }
        $where = 'ticket_id = "' . $ticket_id . '" AND status != "Invoice Raised" AND status != "Invoice Requested"';
        $ticket = $this->F_Model->tickets($where);
        if ($ticket->num_rows() == 1) {
            $data['ticket'] = $ticket->row();
            $data['services'] = $this->F_Model->fetch_service();
            $data['ini_types'] = $this->F_Model->get_ini_types('all')->result();
            $data['communities'] = $this->F_Model->get_communities('all')->result();
            $data['sub_services'] = $this->F_Model->edit_sub_service($data['ticket']->service);
            $where = 'ticket_id = "' . $ticket_id . '"';
            $comments = $this->F_Model->getcomments($where);
            $data['comments'] = $comments->result();
            $this->load->view('landing/ticket_track_view', $data);
        } else {
            #redirect('create-ticket1');
        }
    }

    public function change_lang()
    {
        setcookie("lang", "", time() - 3600);
        $pref_lang = $this->input->get('lang');
        setcookie("lang", $pref_lang, time() + (86400 * 30), "/");
        #echo $_COOKIE["lang"];
    }
}

?>