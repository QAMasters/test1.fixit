<?php

class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
        $this->load->model('F_Model');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('session');
        $pref_lang = $this->session->userdata('pref_lang');
        if ($pref_lang == 1) {
            $idiom = 'english';
        } else if ($pref_lang == 2) {
            $idiom = 'swedish';
        }
        $this->lang->load("all", $idiom);
        if ($this->session->role_id != '1') {
            redirect('access_denied');
        }
    }

    public function ticketconfig()
    {
        if ($this->session->email) {
            $ini_where = 'all';
            $ini_types = $this->F_Model->get_ini_types($ini_where);
            $data['ini_types'] = $ini_types->result();
            $community_where = 'all';
            $community = $this->F_Model->get_communities($community_where);
            $data['communities'] = $community->result();
            $data['items'] = $this->F_Model->material_select('all')->result();
            $this->load->view('admin/ticketconfig_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function add_ini_type()
    {
        if ($this->session->email) {
            $ini_type = $this->input->post('ini_type');
            if ($ini_type != '') {
                $data = array('ini_type' => $ini_type);
                $this->F_Model->add_ini_types($data);
            }
            redirect('settings/ticket-config');
        } else {
            redirect('index.php#Login');
        }
    }

    public function add_community()
    {
        if ($this->session->email) {
            $community = $this->input->post('community');
            if ($community != '') {
                $data = array('community' => $community);
                $this->F_Model->add_communities($data);
            }
            redirect('settings/ticket-config');
        } else {
            redirect('index.php#Login');
        }
    }

    public function email_tpl()
    {
        if ($this->session->email) {
            $where = 'all';
            $query = $this->F_Model->email_templates_list($where);
            $data['email_tpl'] = $query->result();
            $this->load->view('admin/email_tpl_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function email_tpl_edit($id)
    {
        if ($this->session->email) {
            if ($this->input->post('id')) {
                $id = $this->input->post('id');
                $data = array(
                    'subject' => $this->input->post('tpl_subject'),
                    'message' => $this->input->post('tpl_message')
                );
                $this->F_Model->email_templates_update($data, $id);
                $data['success'] = "Template Updated Successfully!";
            }
            $where = 'id = "' . $id . '"';
            $query = $this->F_Model->email_templates_list($where);
            $email_tpl = $query->row();
            if (count($email_tpl) == 1) {
                $data['email_tpl'] = $email_tpl;
                $this->load->view('admin/email_tpledit_view', $data);
            } else {
                $data['message'] = 'Template Not Found!';
                $this->load->view('admin/email_tpledit_view', $data);
            }
        } else {
            redirect('index.php#Login');
        }
    }

    public function appconfig()
    {
        if ($this->session->email) {
            $query = $this->F_Model->appconfig();
            $data['appconfig'] = $query->row();
            $bank_details = $this->F_Model->bank_details();
            $data['bank_details'] = $bank_details->row();
            $this->load->view('admin/appconfig_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function appconfig_update()
    {
        if ($this->session->email) {
            $comp_update = $this->input->post('comp_update');
            if (isset($comp_update)) {
                $data = array(
                    'c_name' => $this->input->post('c_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address')
                );
                $this->F_Model->appconfig_update($data);
            }
            $app_update = $this->input->post('app_update');
            if (isset($app_update)) {
                $data = array(
                    'sysURL' => $this->input->post('sysURL'),
                    'title' => $this->input->post('title'),
                    'footer' => $this->input->post('footer'),
                    'defaultlang' => $this->input->post('defaultlang')
                );
                $this->F_Model->appconfig_update($data);
            }
            $bank_update = $this->input->post('bank_update');
            if (isset($bank_update)) {
                $data = array(
                    'c_name' => $this->input->post('c_name'),
                    'phone' => $this->input->post('phone'),
                    'ac_num' => $this->input->post('ac_num'),
                    'email' => $this->input->post('email'),
                    'website' => $this->input->post('website'),
                    'd1' => $this->input->post('d1'),
                    'd2' => $this->input->post('d2'),
                    'd3' => $this->input->post('d3'),
                    'd4' => $this->input->post('d4'),
                    'd5' => $this->input->post('d5'),
                );
                $this->F_Model->bank_update($data);
            }
            $inv_update = $this->input->post('inv_update');
            if (isset($inv_update)) {
                $data = array(
                    'rot_data' => $this->input->post('rot_data'),
                );
                $this->F_Model->appconfig_update($data);
            }
            $logo_upload = $this->input->post('logo_upload');
            if (isset($logo_upload)) {
                $config['upload_path'] = './uploads/logo';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 3000;
                $config['file_ext_tolower'] = TRUE;
                $config['overwrite'] = FALSE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $file_data = $data['upload_data'];
                    $file_name = $file_data['file_name'];
                }
                $data = array(
                    'logo' => $file_name,
                );
                $this->F_Model->appconfig_update($data);
            }
            redirect(site_url('settings/appconfig'));
        } else {
            redirect('index.php#Login');
        }
    }

    public function material_import()
    {
        if ($this->session->email) {
            #print_r($_FILES['material_file']['name']);
            if ($_FILES['material_file']) {
                $valid_extension = array('xml');
                $file_data = explode('.', $_FILES['material_file']['name']);
                $file_extension = end($file_data);
                if (in_array($file_extension, $valid_extension)) {
                    $item_list = simplexml_load_file($_FILES['material_file']['tmp_name']);
                    for ($i = 0; $i < count($item_list); $i++) {

                        $total = ($item_list->item[$i]->Quantity * $item_list->item[$i]->Price);
                        $discount = ($item_list->item[$i]->Discount / 100) * $total;
                        $item_total = $total - $discount;
                        $data = array(
                            'item_name' => $item_list->item[$i]->ItemName,
                            'item_unit' => $item_list->item[$i]->Unit,
                            'item_quantity' => $item_list->item[$i]->Quantity,
                            'item_price' => $item_list->item[$i]->Price,
                            'item_discount' => $item_list->item[$i]->Discount,
                            'item_surcharge' => $item_list->item[$i]->Surcharge,
                            'item_total' => $item_total,
                        );
                        #print_r($data);
                        $query = $this->F_Model->material_select($data)->num_rows();
                        #echo $query;
                        if ($query == 0) {
                            $this->F_Model->material_import($data);
                        }
                    }
                }
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect('index.php#Login');
        }
    }
}

?>