<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller
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
    }

    public function change($id)
    {
        if ($id == 'en') {
            $pref_lang = '1';
        } else if ($id == 'sw') {
            $pref_lang = '2';
        }
        #echo "lang ".$pref_lang;
        $data = array(
            'pref_lang' => $pref_lang,
        );
        $query = $this->F_Model->lang_change($data);
        $this->session->set_userdata('pref_lang', $pref_lang);
        redirect($_SERVER['HTTP_REFERER']);
        #print_r($query);
    }
}

?>