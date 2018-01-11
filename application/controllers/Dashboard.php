<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
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
		}else{
			$idiom = 'swedish';
		}
		$this->lang->load("all", $idiom);
	}
	public function index() {
		if($this->session->email){
			$rec = "status = 'Accepted by' OR status = 'Assigned to' OR status = 'New'";
			//$this->db->limit(10);
			$rec_tic = $this->F_Model->tickets($rec);
			$data['rec_tic'] = $rec_tic->result();

			$open = "status != 'Deleted' AND status != 'Closed' AND status != 'Invoice Raised' AND status != 'Invoice Requested' AND status != 'Draft'";
			$open_tic = $this->F_Model->tickets($open);
			$data['open_tic'] = $open_tic->result();
			$data['open_tic_count'] = $open_tic->num_rows();
			$closed = "status = 'Closed'";
			$closed_tic = $this->F_Model->tickets($closed);
			$data['closed_tic_count'] = $closed_tic->num_rows();
			$inpro = "status != 'Closed' AND status != 'Deleted' AND status != 'New' AND status != 'Invoice Raised' AND status != 'Invoice Requested' AND status != 'Draft'";
			$inpro_tic = $this->F_Model->tickets($inpro);
			$data['inpro_tic_count'] = $inpro_tic->num_rows();
			$vendor_where = "status = 1 AND role_id = 2";
			$vendors = $this->F_Model->vendors($vendor_where);
			$data['vendors_count'] = $vendors->num_rows();
			$inv = 'inv_status = "Paid" OR inv_status = "UnPaid"';
			$this->db->limit(5);
			$inv_tic = $this->F_Model->get_invoices($inv);
			$data['inv_tic'] = $inv_tic->result();
			$this->load->view('admin/dashboard_view',$data);
		}else{
			redirect('index.php#Login');
		}
	}
}
?>