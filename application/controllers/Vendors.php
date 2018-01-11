<?php 
class Vendors extends CI_Controller {
	function __construct() { 
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->helper('site');      
		$this->load->model('F_Model');
		$this->load->helper('form');
		$this->load->helper('string');
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
	public function active_vendors() {
		if($this->session->email){
			$status = "status = '1' AND role_id='2'";
			$act_vendor = $this->F_Model->vendors($status);
			$data['act_vendor'] = $act_vendor->result();
			$this->load->view('admin/vendor_active_view', $data);
		}else{
			redirect('index.php#Login');
		}
	}
	public function inactive_vendors() {
		if($this->session->email){
			$status = "status = 'Disabled'";
			$inact_vendor = $this->F_Model->vendors($status);
			$data['inact_vendor'] = $inact_vendor->result();
			$this->load->view('admin/vendor_inactive_view', $data);
		}else{
			redirect('index.php#Login');
		}
	}
	public function vendor_new(){
		if($this->session->email){
			if($this->input->post('email')){
				$data = array(
					'fname' => $this->input->post('fname'),
					'lname' => $this->input->post('lname'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),				
					'password' => $this->input->post('password'),
					'pref_lang' => '1',
					'role_id' => '2',
					'status' => '1',
				);
				$this->F_Model->vendor_create($data);
				$data['success'] = 'Vendor Created Successfully';
				$this->load->view('admin/vendor_new_view', $data);
			}else{
				$this->load->view('admin/vendor_new_view');
			}
		}else{
			redirect('index.php#Login');
		}
	}
	public function vendor_edit($id){
		if($this->session->email){
			if($this->input->post('id')){
				$id = $this->input->post('id');
				if($this->input->post('status') == 'on'){
					$status = 1;
				}else{
					$status = 0;
				}
				$data = array(
					'fname' => $this->input->post('fname'),
					'lname' => $this->input->post('lname'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'status' => $status,
				);
				if($this->input->post('password') == null){
					unset($data['password']);
				}
				$result = $this->F_Model->vendor_update($data, $id);
				if($result == TRUE){
					$data['success'] = "Vendor Details Updated Successfully!";	
				}else{
					$data['error'] = "Something Went Wrong!";
				}
			}
			$where = "id = ".$id;
			$vendor = $this->F_Model->vendors($where);
			if($vendor->num_rows() == 1 ){
				$data['vendor'] = $vendor->row();
				$this->load->view('admin/vendor_edit_view',$data);
			}else{
				$data['notfound'] = 'one';
				$this->load->view('admin/vendor_edit_view',$data);
			}
		}else{
			redirect('index.php#Login');
		}
	}
}
?>