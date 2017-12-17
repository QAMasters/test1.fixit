<?php

class Tickets extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
        $this->load->helper('email');
        $this->load->model('F_Model');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->helper('directory');
        $this->load->library('session');
        $pref_lang = $this->session->userdata('pref_lang');
        if ($pref_lang == 1) {
            $idiom = 'english';
        } else if ($pref_lang == 2) {
            $idiom = 'swedish';
        }
        $this->lang->load("all", $idiom);
    }

    public function gen_pdf()
    {
        if ($this->session->email) {
            $this->load->library('m_pdf');
            $ticket_id = $this->input->get('ticket_id');
            $where = 'ticket_id = "' . $ticket_id . '"';
            $data['ticket'] = $this->F_Model->tickets($where)->row();
            $comment_where = 'ticket_id = "' . $ticket_id . '" AND private = "0"';
            $data['comments'] = $this->F_Model->getcomments($comment_where)->result();
            $data['pdf'] = "view";
            $this->load->view('admin/ticket_pdf_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function share_ticket()
    {
        if ($this->session->email) {
            $this->load->library('m_pdf');
            $ticket_id = $this->input->post('ticket_id');
            $where = 'ticket_id = "' . $ticket_id . '"';
            $data['ticket'] = $this->F_Model->tickets($where)->row();
            $comment_where = 'ticket_id = "' . $ticket_id . '" AND private = "0"';
            $data['comments'] = $this->F_Model->getcomments($comment_where)->result();
            $data['pdf'] = "send_email";
            $data['share_email'] = $this->input->post('email');
            $this->load->view('admin/ticket_pdf_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function draft_tickets()
    {
        if ($this->session->email) {
            $draft = "status = 'Draft' AND created_by = '" . $this->session->id . "'";
            $draft_tic = $this->F_Model->tickets($draft);
            $data['draft_tic'] = $draft_tic->result();
            $this->load->view('admin/ticket_draft_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function my_tickets()
    {
        if ($this->session->email) {
            $open = "vendor = '" . $this->session->id . "' AND status != 'Closed' AND status != 'Deleted' AND status != 'Invoice Requested' AND status != 'Invoice Raised' AND status != 'Rejected by'";
            $open_tic = $this->F_Model->tickets($open);
            $data['open_tic'] = $open_tic->result();
            $this->load->view('admin/ticket_my_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function open_tickets()
    {
        if ($this->session->email) {
            if ($this->session->role_id == 1) {
                $open = "status != 'Draft' AND status != 'Deleted' AND status != 'Closed' AND status != 'Invoice Requested' AND status != 'Invoice Raised'";
            } else if ($this->session->role_id == 2) {
                $open = "status != 'Draft' AND status != 'Deleted' AND status != 'Closed' AND status != 'Invoice Requested' AND status != 'Invoice Raised' AND vendor != '" . $this->session->id . "'";
            }
            $open_tic = $this->F_Model->tickets($open);
            $data['open_tic'] = $open_tic->result();
            $this->load->view('admin/ticket_open_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function closed_tickets()
    {
        if ($this->session->email) {
            $closed = "status = 'Closed'";
            $closed_tic = $this->F_Model->tickets($closed);
            $data['closed_tic'] = $closed_tic->result();
            $this->load->view('admin/ticket_closed_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function deleted_tickets()
    {
        if ($this->session->email) {
            $deleted = "status = 'Deleted'";
            $deleted_tic = $this->F_Model->tickets($deleted);
            $data['deleted_tic'] = $deleted_tic->result();
            $this->load->view('admin/ticket_deleted_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function history()
    {
        if ($this->session->email) {
            if ($this->input->post('ticket_id')) {
                $where = 'ticket_id = "' . $this->input->post('ticket_id') . '"';
                $ticket = $this->F_Model->ticket_history($where);
                $count = $ticket->num_rows();
                $data['count'] = $count;
                if ($count != '0') {
                    $data['ticket_id'] = $this->input->post('ticket_id');
                    $data['ticket_history'] = $ticket->result();
                } else {
                    $data['message'] = 'Ticket Details not found';
                }
                $this->load->view('admin/ticket_history_view', $data);
            } else {
                $this->load->view('admin/ticket_history_view');
            }
        } else {
            redirect('index.php#Login');
        }
    }

    public function new_tickets()
    {
        if ($this->session->email) {
            $ticket_id = gen_tic_id();

            $create_ticket = $this->input->post('create_ticket');
            $save_draft = $this->input->post('save_draft');

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
            if (isset($create_ticket)) {
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
                    'created_by' => $this->session->id,
                    'created_on' => current_time(),
                    'Updated' => current_time(),
                    'emergency' => $emergency
                );
                $this->F_Model->create_ticket($data);
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
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
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Ticket Created by' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                $this->session->set_userdata('alert_msg', 'Ticket Created Successfully');
                redirect('tickets/open');
            } else if (isset($save_draft)) {
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
                    'ticket_id' => gen_tic_id(),
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
                    'status' => 'Draft',
                    'created_by' => $this->session->id,
                    'created_on' => current_time(),
                    'Updated' => current_time(),
                    'emergency' => $emergency
                );
                $this->F_Model->create_ticket($data);
                if (isset($_FILES['image']) && !empty($_FILES['image'])) {
                    ticket_image_upload($ticket_id);
                }
                redirect('tickets/drafts');
            } else {
                $data['ini_types'] = $this->F_Model->get_ini_types('all')->result();
                $data['communities'] = $this->F_Model->get_communities('all')->result();
                $data['services'] = $this->F_Model->fetch_service();
                $this->load->view('admin/ticket_new_view', $data);
            }
        } else {
            redirect('index.php#Login');
        }
    }

    public function publish()
    {
        if ($this->session->email) {
            $publish = $this->input->get('publish');
            if ($publish == 'true') {
                $ticket_id = $this->input->get('ticket_id');
                $data = array(
                    'status' => 'New',
                    'created_on' => current_time(),
                    'Updated' => current_time()
                );
                $where = 'ticket_id = "' . $ticket_id . '"';
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'ticket_create');
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Ticket Created by' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                redirect('tickets/open');
            }
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
        if ($this->session->email) {
            if ($this->input->post('ticket_id')) {
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

                $start_date = $this->input->post('i_pref_s_time');
                $end_date = $this->input->post('i_pref_e_time');
                if (!empty($start_date)) {
                    $sd = DateTime::createFromFormat("Y-m-d H:i", $start_date);
                    $start_date = $sd->format('Y-m-d H:i:s');
                }
                if (!empty($end_date)) {
                    $ed = DateTime::createFromFormat("Y-m-d H:i", $end_date);
                    $end_date = $ed->format('Y-m-d H:i:s');
                }
                $cal_where = 'title = "' . $ticket_id . '"';
                $this->F_Model->update_event($cal_where, array(
                        "start" => $start_date,
                        "end" => $end_date
                    )
                );
                if ($_FILES['image']) {
                    ticket_image_upload($ticket_id);
                }
                email_send($ticket_id, 'ticket_update');
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Ticket Updated by ' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                $data['success'] = "Ticket Updated Successfully!";
            }
            $where = 'ticket_id = "' . $id . '" AND status != "Invoice Raised" AND status != "Invoice Requested"';
            $ticket = $this->F_Model->tickets($where);
            if ($ticket->num_rows() == 1) {
                $data['ticket'] = $ticket->row();
                $current_status = $data['ticket']->status;
                if ($current_status == 'Closed' OR $current_status == 'Deleted') {
                    $status_where = 'status = "' . $current_status . '"';
                } else if ($current_status == 'Draft') {
                    $status_where = "status = 'Draft' AND created_by = '" . $this->session->id . "'";
                } else if ($this->session->role_id == 1) {
                    $status_where = 'status != "Invoice Raised" AND status != "Invoice Requested" AND status != "Draft" AND status != "Closed" AND status != "Deleted"';
                } else if ($this->session->role_id == 2) {
                    if ($data['ticket']->vendor == $this->session->id) {
                        $status_where = 'status != "Invoice Raised" AND status != "Invoice Requested" AND status != "Draft" AND status != "Closed" AND status != "Deleted" AND vendor ="' . $this->session->id . '" ';
                    } else {
                        $status_where = 'status != "Invoice Raised" AND status != "Invoice Requested" AND status != "Draft" AND status != "Closed" AND status != "Deleted" AND vendor !="' . $this->session->id . '" ';
                    }
                }
                $data['tickets_array'] = $this->F_Model->tickets($status_where)->result();
                //print_r($data['tickets_array']);
                $data['services'] = $this->F_Model->fetch_service();
                $data['sub_services'] = $this->F_Model->edit_sub_service($data['ticket']->service);
                $where = "status = 1 AND role_id = 2";
                $act_vendor = $this->F_Model->vendors($where)->result();
                $vendor_array = [];
                foreach ($act_vendor as $key) {
                    $vendor_array[$key->id] = $key->fname;
                }
                $data['vendor_array'] = $vendor_array;

                $where = 'ticket_id = "' . $id . '"';
                $comments = $this->F_Model->getcomments($where);
                $data['comments'] = $comments->result();
                $data['ini_types'] = $this->F_Model->get_ini_types('all')->result();
                $data['communities'] = $this->F_Model->get_communities('all')->result();
                $data['inv_items'] = $this->F_Model->inv_items($where);
                $this->load->view('admin/ticket_edit_view', $data);
            } else {
                $data['notfound'] = 'one';
                $data['services'] = $this->F_Model->fetch_service();
                $data['ini_types'] = $this->F_Model->get_ini_types('all')->result();
                $data['communities'] = $this->F_Model->get_communities('all')->result();
                $this->load->view('admin/ticket_new_view', $data);
            }

        } else {
            redirect('index.php#Login');
        }
    }

    public function addcomment()
    {
        if ($this->session->email) {
            if ($this->input->post('comment')) {
                $ticket_id = $this->input->post('ticket_id');
                if ($this->input->post('private') == 'on') {
                    $private = 1;
                } else {
                    $private = 0;
                }
                $data = array(
                    'ticket_id' => $this->input->post('ticket_id'),
                    'commented_by' => $this->session->id,
                    'comments' => $this->input->post('comment'),
                    'commented_on' => current_time(),
                    'private' => $private
                );
                $this->F_Model->addcomment($data);
                email_send($ticket_id, 'add_comment');
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Comment Added by ' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                echo "Comment Added Successfully!";
            }
        } else {
            redirect('index.php#Login');
        }
    }

    public function status_change()
    {
        if ($this->session->email) {
            if ($this->input->post('ticket_id') AND $this->input->post('ticketclose')) {
                $ticket_id = $this->input->post('ticket_id');
                $where = 'ticket_id = "' . $ticket_id . '"';
                $data = array(
                    'status' => 'Closed',
                    'closed_on' => current_time(),
                    'Updated' => current_time()
                );
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'ticket_close');
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Ticket Closed by ' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ($this->input->post('ticket_id') AND $this->input->post('ticketdelete')) {
                $ticket_id = $this->input->post('ticket_id');
                $where = 'ticket_id = "' . $ticket_id . '"';
                $data = array(
                    'status' => 'Deleted',
                    'closed_on' => current_time(),
                    'Updated' => current_time()
                );
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'ticket_delete');
                $where = 'title = "' . $ticket_id . '"';
                $this->F_Model->delete_calendar_event($where);
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Ticket Deleted by ' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ($this->input->post('ticket_id') AND $this->input->post('ticketreopen')) {
                $ticket_id = $this->input->post('ticket_id');
                $where = 'ticket_id = "' . $ticket_id . '"';
                $data = array(
                    'status' => 'New',
                    'closed_on' => current_time(),
                    'Updated' => current_time()
                );
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'ticket_reopen');
                $his_data = array(
                    'ticket_id' => $ticket_id,
                    'time' => current_time(),
                    'comments' => 'Ticket Re-Opened by ' . get_user_name($this->session->id)->fname,
                );
                $this->F_Model->add_history($his_data);
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ($this->input->post('ticket_id') AND $this->input->post('vendorchange')) {
                $ticket_id = $this->input->post('ticket_id');
                $vendor = $this->input->post('vendor');
                $where = 'ticket_id = "' . $ticket_id . '"';
                $data = array(
                    'status' => 'Assigned to ',
                    'vendor' => $vendor,
                    'Updated' => current_time()
                );
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'assign_vendor');
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ($this->input->post('ticket_id') AND $this->input->post('ticketaccept')) {
                $ticket_id = $this->input->post('ticket_id');
                $where = 'ticket_id = "' . $ticket_id . '"';
                $data = array(
                    'status' => 'Accepted by ',
                    'vendor' => $this->session->id,
                    'Updated' => current_time()
                );
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'vendor_accept');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $reject = $this->input->post('ticketreject');
            if (isset($reject)) {
                $ticket_id = $this->input->post('ticket_id');
                $where = 'ticket_id = "' . $ticket_id . '"';
                $data = array(
                    'status' => 'Rejected by ' . $this->session->fname,
                    'vendor' => '',
                    'Updated' => current_time()
                );
                $this->F_Model->ticket_update($data, $where);
                email_send($ticket_id, 'vendor_reject');
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ($this->input->get('ticket_id') AND $this->input->get('status')) {
                $ticket_id = $this->input->get('ticket_id');
                $status = $this->input->get('status');
                if ($status == "done") {
                    $where = 'ticket_id = "' . $ticket_id . '"';
                    $data = array(
                        'status' => 'Work Done',
                        'vendor' => $this->session->id,
                        'Updated' => current_time()
                    );
                    $this->F_Model->ticket_update($data, $where);
                    email_send($ticket_id, 'vendor_accept');
                } else if ($status == "raiseinvoice") {
                    $where = 'ticket_id = "' . $ticket_id . '"';
                    $data = array(
                        'status' => 'Invoice Requested',
                        'vendor' => $this->session->id,
                        'Updated' => current_time()
                    );
                    $this->F_Model->ticket_update($data, $where);
                    email_send($ticket_id, 'vendor_accept');
                }
                redirect('tickets/open');
            }
            if ($this->input->post('ticket_id') AND $this->input->post('ticketreminder')) {
                $ticket_id = $this->input->post('ticket_id');
                email_send($ticket_id, 'send_reminder');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect('index.php#Login');
        }
    }

    public function ini_type()
    {
        $query = $this->input->get('query');
        $ini_type = $this->F_Model->ini_type($query);
        #$data['ini_type'] = $ini_type;
        #print_r($ini_type);
        echo json_encode($ini_type);
    }

    public function event_download()
    {
        #include 'ICS.php';
        if ($this->input->get('ticket_id')) {
            $ticket_id = $this->input->get('ticket_id');
            $where = 'ticket_id = "' . $ticket_id . '"';
            $ticket = $this->F_Model->tickets($where)->row();;
            $this->load->view('admin/ICS');
            header('Content-type: text/calendar; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . $ticket_id . '.ics');
            $properties = array(
                'description' => 'test notest',
                'dtstart' => $ticket->pref_s_time,
                'dtend' => $ticket->pref_e_time,
                'summary' => $ticket_id,
                'url' => 'http://pradeep.com'
            );
            $ics = new ICS($properties);
            echo $ics->to_string();
        } else {

        }
    }

    public function add_material()
    {
        if ($this->input->post('ticket_id')) {
            $ticket_id = $this->input->post('ticket_id');
            $where = 'ticket_id = "' . $ticket_id . '"';
            $this->F_Model->invoice_items_delete($where);
            foreach ($this->input->post('invoice_product') as $key => $item_name) {
                $invoice_product = $this->input->post('invoice_product');
                $invoice_product_qty = $this->input->post('invoice_product_qty');
                $invoice_product_price = $this->input->post('invoice_product_price');
                $invoice_product_discount = $this->input->post('invoice_product_discount');
                $invoice_product_sub = $this->input->post('invoice_product_sub');
                $unit = $this->input->post('unit');
                $data = array(
                    'ticket_id' => $ticket_id,
                    'item_name' => $invoice_product[$key],
                    'quantity' => $invoice_product_qty[$key],
                    'unit' => $unit[$key],
                    'price' => $invoice_product_price[$key],
                    'discount' => $invoice_product_discount[$key],
                    'sub_total' => $invoice_product_sub[$key]
                );
                if ($invoice_product[$key] != '') {
                    $this->F_Model->invoice_items($data);
                }
            }

            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}

?>