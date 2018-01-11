<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
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
    }

    public function index()
    {
        $this->load->view('access_denied');
    }
}

?>