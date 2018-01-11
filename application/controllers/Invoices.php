<?php 
class Invoices extends CI_Controller {
	function __construct() { 
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->helper('site');
		$this->load->helper('email');    
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
	public function requested() {
		if($this->session->email){
			$inv = "status = 'Invoice Requested'";
			$inv_tic = $this->F_Model->tickets($inv);
			$data['inv_tic'] = $inv_tic->result();
			$this->load->view('admin/invoice_req_view', $data);
		}else{
			redirect('index.php#Login');
		}
	}

	public function generate($id) {
		if($this->session->email){
			$data = array(
				'status' => 'Invoice Raised',
				);
			$where = 'ticket_id = "'.$id.'"';
			$inv_tic = $this->F_Model->ticket_update($data,$where);
			$max_inv = $this->F_Model->get_max_inv();			
			$invoice_id=intval($max_inv->max_inv)+1;
			if($invoice_id < 1024){
				$invoice_id=1024;
			}
			$inv = array(
				'ticket_id' => $id,
				'invoice_date' => date("Y-m-d"),
				'bill_due' => 30,
				'rot' => 'Disabled',
				'inv_status' => 'UnPaid',
				);
			$this->F_Model->gen_invoice($inv);
			$rot_data = array(
				'ticket_id' => $id,
				'label1' => '',
				'label2' => '',
				'label3' => '',
				'personal_number' => ''
				);
			$this->F_Model->add_rot($rot_data);
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			redirect('index.php#Login');
		}
	}
	public function raised() {
		if($this->session->email){
			$inv = "status = 'Invoice Raised'";
			$inv_tic = $this->F_Model->tickets($inv);
			$inv_tic = $this->F_Model->tickets($inv);
			$data['inv_tic'] = $inv_tic->result();
			$this->load->view('admin/invoice_raised_view', $data);
		}else{
			redirect('index.php#Login');
		}
	}
	public function edit($id) {
		if($this->session->email){			
			$where = 'ticket_id = "'.$id.'"';
			$tic = $this->F_Model->tickets($where);
			$data['tic'] = $tic->row();
			$inv = $this->F_Model->get_invoices($where);
			$data['inv'] = $inv->row();
			$inv_row = $inv->row();
			$data['inv_items'] = $this->F_Model->inv_items($where);
			$data['rot'] = $this->F_Model->get_rot($where);
			$data['appconfig'] = $this->F_Model->appconfig()->row();
			$this->load->view('admin/invoice_edit_view', $data);
		}else{
			redirect('index.php#Login');
		}
	}
	public function invoice_update() {
		if($this->session->email){
			if($this->input->post('ticket_id')){
				$ticket_id = $this->input->post('ticket_id');
				$where = 'ticket_id = "'.$ticket_id.'"';				
				$data = array(
					'bill_due' => $this->input->post('bill_due'),
					'description' => $this->input->post('description'),
					'bill_due_date' => $this->input->post('bill_due_date'),
					'invoice_date' => $this->input->post('invoice_date')
				);
				$this->F_Model->invoice_update($data,$where);
				$this->F_Model->invoice_items_delete($where);
				foreach($this->input->post('invoice_product') as $key => $item_name){
					$invoice_product = $this->input->post('invoice_product');
					$invoice_product_qty = $this->input->post('invoice_product_qty');
					$invoice_product_price = $this->input->post('invoice_product_price');
					$invoice_product_discount = $this->input->post('invoice_product_discount');
					$invoice_product_surcharge = $this->input->post('invoice_product_surcharge');
					$invoice_product_sub = $this->input->post('invoice_product_sub');
					$unit = $this->input->post('unit');
					if($invoice_product_sub[$key] == 'NaN'){
						$invoice_product_sub_key = '0.00';
					}else{
						$invoice_product_sub_key = $invoice_product_sub[$key];
					}
					$data = array(
						'ticket_id' => $ticket_id,
						'item_name' => $invoice_product[$key],
						'quantity' => $invoice_product_qty[$key],
						'unit' => $unit[$key],
						'price' => $invoice_product_price[$key],
						'discount' => $invoice_product_discount[$key],
						'surcharge' => $invoice_product_surcharge[$key],
						'sub_total' => $invoice_product_sub_key
					);
					if($invoice_product[$key] != ''){
						$this->F_Model->invoice_items($data);
					}
				}  
			}
			redirect($_SERVER['HTTP_REFERER']);			
		}else{
			redirect('index.php#Login');
		}
	}
	public function material_search() {
		if($this->session->email){
			if($this->input->get('term')){
				#echo "seach item ".$this->input->get('term');
				$like = $this->input->get('term');
				$query = $this->F_Model->material_auto_select($like)->result();
				$data = array();
				foreach ($query as $d) {
					$data[] = array(
						"label" => $d->item_name,
						"unit" => $d->item_unit,
						"quantity" => $d->item_quantity,
						"price" => $d->item_price,
						"discount" => $d->item_discount,
						"surcharge" => $d->item_surcharge,
						"sub" => $d->item_total,
					);
				}
				echo json_encode($data);
			}			
		}else{
			redirect('index.php#Login');
		}
	}
	public function invoice_pdf() {
		if($this->session->email){
			$this->load->library('m_pdf');
			$ticket_id = $this->input->get('ticket_id');
			$where = 'ticket_id = "'.$ticket_id.'"';
			$data['ticket'] = $this->F_Model->tickets($where)->row();
			$data['invoice'] = $this->F_Model->get_invoices($where)->row();
			$data['appconfig'] = $this->F_Model->appconfig()->row();
			$data['inv_items'] = $this->F_Model->inv_items($where);
			$data['bank_details'] = $this->F_Model->bank_details()->row();
			$data['rot'] = $this->F_Model->get_rot($where);
			$data['pdf'] = "view";
			$this->load->view('admin/invoice_pdf_view',$data);
		}else{
			redirect('index.php#Login');
		}
	}
	public function send_email() {
		if($this->session->email){
			$this->load->library('m_pdf');
			$ticket_id = $this->input->get('ticket_id');
			$where = 'ticket_id = "'.$ticket_id.'"';
			$data['ticket'] = $this->F_Model->tickets($where)->row();
			$data['invoice'] = $this->F_Model->get_invoices($where)->row();
			$data['appconfig'] = $this->F_Model->appconfig()->row();
			$data['inv_items'] = $this->F_Model->inv_items($where);
			$data['bank_details'] = $this->F_Model->bank_details()->row();
			$data['rot'] = $this->F_Model->get_rot($where);
			$data['pdf'] = "send_email";
			$this->load->view('admin/invoice_pdf_view',$data);
		}else{
			redirect('index.php#Login');
		}
	}
	public function update_rot() {
		if($this->session->email){
			if($this->input->post('ticket_id')){
				$ticket_id = $this->input->post('ticket_id');
				$where = 'ticket_id = "'.$ticket_id.'"';
				$data = array(
					'rot' => 'Enabled',
				);
				$this->F_Model->invoice_update($data,$where);
				//print_r($q);
				$rot_data = array(
					'label1' => $this->input->post('label1'),
					'label2' => $this->input->post('label2'),
					'label3' => $this->input->post('label3'),
					'personal_number' => $this->input->post('personal_number'),
				);
				$this->F_Model->update_rot($where,$rot_data);
			}
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			redirect('index.php#Login');
		}
	}
	public function invoice_status_change() {
		if($this->session->email){
			if($this->input->get('ticket_id')){
				$ticket_id = $this->input->get('ticket_id');
				$status = $this->input->get('status');
				$where = 'ticket_id = "'.$ticket_id.'"';
				$data = array(
					'inv_status' => $status,
				);
				$this->F_Model->invoice_update($data,$where);
				
			}
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			redirect('index.php#Login');
		}
	}
	public function invoice_date_change() {
		if($this->session->email){
			$ticket_id = $this->input->get('ticket_id');
			$date = $this->input->get('date');
			if($ticket_id != '' AND $date != ''){
				$where = 'ticket_id = "'.$ticket_id.'"';
				$data = array(
					'invoice_date' => $date,
				);
				$this->F_Model->invoice_update($data,$where);
				
			}
		}else{
			redirect('index.php#Login');
		}
	}
	public function change_bill_due() {
		if($this->session->email){
			$ticket_id = $this->input->get('ticket_id');
			$bill_due = $this->input->get('bill_due');
			if($ticket_id != '' AND $bill_due != ''){
				$where = 'ticket_id = "'.$ticket_id.'"';
				$data = array(
					'bill_due' => $bill_due,
				);
				$this->F_Model->invoice_update($data,$where);
				
			}
		}else{
			redirect('index.php#Login');
		}
	}
}
?>