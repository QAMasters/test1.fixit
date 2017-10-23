<?php

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
        $this->load->model('F_Model');
        #$this->load->helper('form');
        $this->load->helper('string');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $pref_lang = $this->session->userdata('pref_lang');
        if ($pref_lang == 1) {
            $idiom = 'english';
        } else if ($pref_lang == 2) {
            $idiom = 'swedish';
        }
        $this->lang->load("all", $idiom);
    }

    public function index()
    {
        if ($this->session->email) {
            if ($this->input->post('id')) {
                $where = 'id = "' . $this->input->post('id') . '"';
                $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                );
                $this->F_Model->profile_update($where, $data);
                $query = $this->F_Model->login($where);
                $user_info = $query->row();
                $_SESSION['email'] = $user_info->email;
                $_SESSION['fname'] = $user_info->fname;
                $_SESSION['lname'] = $user_info->lname;
            }
            $where = 'id = "' . $this->session->id . '"';
            $profile = $this->F_Model->profile($where);
            $data['profile'] = $profile;
            $data['error'] = '';
            $this->load->view('admin/profile_view', $data);
        } else {
            redirect('index.php#Login');
        }
    }

    public function do_upload()
    {
        if ($this->session->email) {
            $config['upload_path'] = './uploads/users';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1000;
            $config['file_name'] = md5($this->session->id);
            $config['file_ext_tolower'] = TRUE;
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profilepic')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                #$this->load->view('admin/profile_view', $error);
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_data = $data['upload_data'];
                #echo $file_data['file_name'];

                $where = 'id = "' . $this->session->id . '"';
                $data = array(
                    'profilepic' => $file_data['file_name']
                );
                $profile = $this->F_Model->profile_update($where, $data);
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect('index.php#Login');
        }
    }

}

?>