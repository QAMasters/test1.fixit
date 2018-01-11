<?php 
   class F_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function open_tickets() {
         $this->db->where('status', 'New');
         $query = $this->db->get('tickets');
         return $query->result_array(); 
      } 
   
      public function delete($roll_no) { 
         if ($this->db->delete("stud", "roll_no = ".$roll_no)) { 
            return true; 
         } 
      } 
   
      public function update($data,$old_roll_no) { 
         $this->db->set($data); 
         $this->db->where("roll_no", $old_roll_no); 
         $this->db->update("stud", $data); 
      } 
   } 
?> 