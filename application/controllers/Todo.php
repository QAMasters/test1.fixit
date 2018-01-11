<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Todo extends CI_Controller {
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
	}
	public function index() {
		if($this->session->email){
			$this->load->view('admin/todo_view');
		}else{
			redirect('index.php#Login');
		}
	}
}
?>