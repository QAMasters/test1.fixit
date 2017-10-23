<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
        $this->load->model('F_Model');
        $this->load->helper('form');
        $this->load->helper('string');
    }

    public function index()
    {
        $open = "status != 'Deleted' AND status != 'Closed'";
        $open_tic = $this->F_Model->tickets($open);
        $data['open_tic'] = $open_tic;
        $data['open_tic_count'] = count($open_tic);
        $closed = "status = 'Closed'";
        $closed_tic = $this->F_Model->tickets($closed);
        $data['closed_tic_count'] = count($closed_tic);
        $inpro = "status != 'Closed' AND status != 'Deleted' AND status != 'New'";
        $inpro_tic = $this->F_Model->tickets($inpro);
        $data['inpro_tic_count'] = count($inpro_tic);
        $vendors = $this->F_Model->vendors('all');
        $data['vendors_count'] = count($vendors);
        $this->load->view('dashboard_view', $data);
    }

    public function open_tickets()
    {
        $open = "status != 'Deleted' AND status != 'Closed'";
        $open_tic = $this->F_Model->tickets($open);
        $data['open_tic'] = $open_tic;
        $this->load->view('ticket_open_view', $data);
    }

    public function closed_tickets()
    {
        $closed = "status = 'Closed'";
        $closed_tic = $this->F_Model->tickets($closed);
        $data['closed_tic'] = $closed_tic;
        $this->load->view('ticket_closed_view', $data);
    }

    public function deleted_tickets()
    {
        $deleted = "status = 'Deleted'";
        $deleted_tic = $this->F_Model->tickets($deleted);
        $data['deleted_tic'] = $deleted_tic;
        $this->load->view('ticket_deleted_view', $data);
    }

    public function new_tickets()
    {

        if ($this->input->post('i_name')) {
            $data = array(
                'ticket_id' => gen_tic_id(),
                'ini_name' => $this->input->post('i_name'),
                'ini_phone' => $this->input->post('i_phone'),
                'ini_email' => $this->input->post('i_email'),
                'ini_address' => $this->input->post('i_address'),
                'ini_doornum' => $this->input->post('i_door_code'),
                'ini_type' => $this->input->post('i_type'),
                'keys_tube' => $this->input->post('i_keys_tube'),
                'pets_home' => $this->input->post('i_pets_home'),
                'pref_time' => $this->input->post('i_pref_time'),
                'service' => $this->input->post('service'),
                'sub_service' => $this->input->post('sub_service'),
                'description' => $this->input->post('i_desc'),
                'status' => 'New',
                'created_on' => current_time()
            );
            $this->F_Model->create_ticket($data);
            $data['message'] = 'Ticket Created Successfully';
            $data['services'] = $this->F_Model->fetch_service();
            $this->load->view('ticket_new_view', $data);
        } else {
            $services = $this->F_Model->fetch_service();
            $data['services'] = $services;
            $this->load->view('ticket_new_view', $data);
        }
    }

    public function fetch_sub_service()
    {
        $message = $this->input->post('get_option');
        $sub_services = $this->F_Model->fetch_sub_service($message);
        $data['sub_services'] = $sub_services;
        print_r($sub_services);
    }

    public function ticket_edit($id)
    {
        $ticket = $this->F_Model->get_ticket($id);
        if (count($ticket) == 1) {
            $data['ticket'] = $ticket;
            $data['services'] = $this->F_Model->fetch_service();
            $data['sub_services'] = $this->F_Model->edit_sub_service($data['ticket']->service);
            #$data['sub_service'] = $sub_service;
            $this->load->view('ticket_edit_view', $data);
        } else {
            $data['notfound'] = 'one';
            $data['services'] = $this->F_Model->fetch_service();
            $this->load->view('ticket_new_view', $data);
        }
    }

    public function ticket_update()
    {
        if ($this->input->post('ticket_id')) {
            $ticket_id = $this->input->post('ticket_id');
            $data = array(
                'ticket_id' => $this->input->post('ticket_id'),
                'ini_name' => $this->input->post('i_name'),
                'ini_phone' => $this->input->post('i_phone'),
                'ini_email' => $this->input->post('i_email'),
                'ini_address' => $this->input->post('i_address'),
                'ini_doornum' => $this->input->post('i_door_code'),
                'ini_type' => $this->input->post('i_type'),
                'keys_tube' => $this->input->post('i_keys_tube'),
                'pets_home' => $this->input->post('i_pets_home'),
                'pref_time' => $this->input->post('i_pref_time'),
                'service' => $this->input->post('service'),
                'sub_service' => $this->input->post('sub_service'),
                'description' => $this->input->post('i_desc')
            );
            $this->F_Model->ticket_update($data, $ticket_id);
            redirect('/tickets/' . $ticket_id . '/success');
        } else {
            $this->load->view('Notfound_view', $data);
        }
    }

    public function active_vendors()
    {
        $status = "status = 'Enabled'";
        $act_vendor = $this->F_Model->vendors($status);
        $data['act_vendor'] = $act_vendor;
        $this->load->view('vendor_active_view', $data);
    }

    public function inactive_vendors()
    {
        $status = "status = 'Disabled'";
        $inact_vendor = $this->F_Model->vendors($status);
        $data['inact_vendor'] = $inact_vendor;
        $this->load->view('vendor_inactive_view', $data);
    }

    public function vendor_new()
    {
        if ($this->input->post('email')) {
            #$id = $this->F_Model->vendor_maxid()->id+1;
            $data = array(
                #'id' => $id,
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'status' => 'Enabled',
                'pref_lang' => 'en',
            );
            $this->F_Model->vendor_create($data);
            $data['success'] = 'Vendor Created Successfully';
            $this->load->view('vendor_new_view', $data);
        } else {
            $this->load->view('vendor_new_view');
        }
    }

    public function vendor_edit($id)
    {
        $where = "id = " . $id;
        $vendor = $this->F_Model->get_vendor($where);
        if (count($vendor) == 1) {
            $data['vendor'] = $vendor;
            $this->load->view('vendor_edit_view', $data);
        } else {
            $data['notfound'] = 'one';
            $this->load->view('vendor_edit_view', $data);
        }

    }

    public function vendor_update()
    {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );
            if (empty($this->input->post('password'))) {
                unset($data['password']);
            }
            $result = $this->F_Model->vendor_update($data, $id);
            if ($result == TRUE) {
                redirect('/vendor/edit/' . $id . '/success');
            } else {
                redirect('/vendor/edit/' . $id . '/error');
            }
        } else {
            $this->load->view('Notfound_view', $data);
        }
    }

    public function test()
    {
        $this->load->view('test_view');
    }
}

?>