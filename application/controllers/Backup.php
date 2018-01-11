<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Backup extends CI_Controller {
	function __construct() { 
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->helper('site');      	
		$this->load->helper('form');
		$this->load->helper('string');	
		$this->load->model('F_Model');
		$this->load->library('session');
		$pref_lang = $this->session->userdata('pref_lang');
		if($pref_lang == 1){
			$idiom = 'english';
		}else if($pref_lang == 2){
			$idiom = 'swedish';
		}
		$this->lang->load("all", $idiom);
		if($this->session->role_id != '1'){
			redirect('access_denied');
		}
	}
	public function index() {
		if($this->session->email){
			$this->load->view('admin/backup_view');
		}else{
			redirect('index.php#Login');
		}
	}
	public function run_backup() {
		if($this->session->email){
			$this->load->view('admin/backup_run_view');
		}else{
			redirect('index.php#Login');
		}
	}
}
?>