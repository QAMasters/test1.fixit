<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct() { 
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->helper('site');      	
		$this->load->helper('form');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->model('F_Model');
	}
	public function index() {
		if($this->input->post('email')){
			$where = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
				);
			$query = $this->F_Model->login($where);
			if ($query->num_rows() == 1){
				$user_info = $query->row();
				$_SESSION['id'] = $user_info->id;
				$_SESSION['email'] = $user_info->email;
				$_SESSION['pref_lang'] = $user_info->pref_lang;
				$_SESSION['fname'] = $user_info->fname;
				$_SESSION['lname'] = $user_info->lname;
				$_SESSION['role_id'] = $user_info->role_id;
				redirect('dashboard');
			}else{
				$_SESSION['login_error'] = "Invalid Email or Password";
				redirect('index.php#Login');
			}
		}
		#redirect('index.php#Login');
	}
	public function logout() {
		unset(
			$_SESSION['email']
		);
		redirect(base_url());
	}

}
?>