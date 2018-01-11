<?php 
class F_Model extends CI_Model {
	function __construct() {
		parent::__construct(); 
	} 
	public function tickets($where) {
		$this->db->order_by('updated', 'DESC');
		$this->db->where($where);
		$query = $this->db->get('tickets');		
			return $query;
	}
	public function vendors($where) {
		if($where != 'all'){
			$this->db->where($where);
		}		
		$query = $this->db->get('vendors');
		return $query;
	}	
	public function create_ticket($data){
		$this->db->insert('tickets', $data);
	}
	public function fetch_service(){
		$this->db->from('services');
		
		$result = $this->db->get();
		$return = array();
		$return[''] = 'Select';
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
				$return[$row['service']] = $row['service'];
			}
		}
        return $return;
	}
	public function fetch_sub_service($service){
		$this->db->where('service', $service);
		$this->db->from('services');		
		$result = $this->db->get();
		$return = '<option value="">Select</option>';
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
				$return .= '<option value="'.$row['sub_service'].'">'.$row['sub_service'].'</option>';
			}
		}

        return $return;
	}
	public function edit_sub_service($service){
		$this->db->where('service', $service);
		$this->db->from('services');		
		$result = $this->db->get();
		$return = array();
		$return[''] = 'Select';
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
				$return[$row['sub_service']] = $row['sub_service'];
			}
		}
        return $return;
	}
	public function ticket_update($data,$where){
		$this->db->where($where);
		$this->db->update('tickets', $data);
	}
	public function vendor_update($data,$id){
		$this->db->where('email', $data['email']);
		$query = $this->db->get('vendors');
		if($query->num_rows() == 1){
			$this->db->where('id', $id);
			$this->db->where('email', $data['email']);
			$query1 = $this->db->get('vendors');
			if ($query1->num_rows() == 1){
				$this->db->where('id', $id);
				$this->db->update('vendors', $data);
				return TRUE;
			}else{
				return FALSE;
			}
		}
		else if ($query->num_rows() == 0){
			$this->db->where('id', $id);
			$this->db->update('vendors', $data);
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function vendor_create($data) {		
		$this->db->insert('vendors', $data);
	}
	public function email_templates_list($where) {
		if($where != 'all'){
			$this->db->where($where);
		}
		$query = $this->db->get('email_templates');
		return $query;
	}
	public function email_templates_update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('email_templates', $data);
	}
	public function appconfig(){
		$query = $this->db->get('appconfig');
		return $query;
	}
	public function appconfig_update($data){
		$this->db->where('lang_id', '1');
		$query = $this->db->update('appconfig',$data);
		return $query;
	}	
	public function lang_change($data){
		$this->db->where('id', 1);
		$query = $this->db->update('admins',$data);
		return $query;
	}
	public function lang_select($where){
		$this->db->where($where);
		$query = $this->db->get('admins');
		return $query->row();
	}
	public function get_invoices($where){
		$this->db->where($where);
		$query = $this->db->get('invoices');
		return $query;
	}
	public function gen_invoice($data){
		#$this->db->where($where);
		$this->db->insert('invoices', $data);
		return $query;
	}
	public function get_max_inv(){
		$this->db->select('MAX(invoice_id) as max_inv');
		$query = $this->db->get('invoices');
		return $query->row();
	}
	public function inv_items($where){
		$this->db->where($where);
		$query = $this->db->get('invoice_items');
		return $query->result();
	}
	public function get_rot($where){
		$this->db->where($where);
		$query = $this->db->get('rot');
		return $query->row();
	}
	public function login($where){
		$this->db->where($where);
		$query = $this->db->get('admins');
		return $query;	
	}


	public function get_events($start, $end){
    	return $this->db->where("start >=", $start)->where("end <=", $end)->get("calendar_events");
	}
	public function add_event($data){
    	$this->db->insert("calendar_events", $data);
	}
	public function get_event($id){
    	return $this->db->where("ID", $id)->get("calendar_events");
	}
	public function update_event($id, $data){
    	$this->db->where("ID", $id)->update("calendar_events", $data);
	}
	public function delete_event($id){
    	$this->db->where("ID", $id)->delete("calendar_events");
	}
}
?>