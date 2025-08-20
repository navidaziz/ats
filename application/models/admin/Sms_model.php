<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Sms_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "sms";
        $this->pk = "sms_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "message",
                            "label"  =>  "Message",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	
	 $query="SELECT * FROM `mobile_numbers`";
		  $query_result = $this->db->query($query);
		  $mobile_numbers = $query_result->result();
		  foreach($mobile_numbers as $mobile_number){
				$inputs = array();
				$inputs["message"]  =  $this->input->post("message");
				$inputs["mobile_number"]  =  $mobile_number->mobile_number;
    			$this->sms_model->save($inputs);
			  }
		  
		  
	
	
	
	return true;
	}	 	

public function update_data($sms_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["message"]  =  $this->input->post("message");
                    
	return $this->sms_model->save($inputs, $sms_id);
	}	
	
    //----------------------------------------------------------------
 public function get_sms_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("sms.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->sms_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->sms_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->sms_model->joinGet($fields, "sms", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->sms = $this->sms_model->joinGet($fields, "sms", $join_table, $where);
			return $data;
		}else{
			return $this->sms_model->joinGet($fields, "sms", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_sms($sms_id){
	
		$fields = array("sms.*");
		$join_table = array();
		$where = "sms.sms_id = $sms_id";
		
		return $this->sms_model->joinGet($fields, "sms", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

