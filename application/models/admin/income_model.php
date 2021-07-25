<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Income_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "income";
        $this->pk = "income_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "customer_name",
                            "label"  =>  "Customer Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "customer_mobile_number",
                            "label"  =>  "Customer Mobile Number",
                            "rules"  =>  "required"
                        ),
                        
                       /* array(
                            "field"  =>  "customer_address",
                            "label"  =>  "Customer Address",
                            "rules"  =>  "required"
                        ),*/
                        
                        array(
                            "field"  =>  "project_name",
                            "label"  =>  "Project Name",
                            "rules"  =>  "required"
                        ),
                        
                       /* array(
                            "field"  =>  "project_address",
                            "label"  =>  "Project Address",
                            "rules"  =>  "required"
                        ),*/
                        
                        array(
                            "field"  =>  "total_price",
                            "label"  =>  "Total Price",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "discount",
                            "label"  =>  "Discount",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "courier_type",
                            "label"  =>  "Courier Type",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["customer_name"]  =  $this->input->post("customer_name");
                    
                    $inputs["customer_mobile_number"]  =  preg_replace('/\s+/', '',$this->input->post("customer_mobile_number"));
                    
                    $inputs["customer_address"]  =  $this->input->post("customer_address");
                    
                    $inputs["project_name"]  =  $this->input->post("project_name");
                   
                   $inputs["project_address"]  =  $this->input->post("project_address");
                    
                    $inputs["total_price"]  =  $this->input->post("total_price");
                    
                    $inputs["discount"]  =  $this->input->post("discount");
                    
                    $inputs["courier_type"]  =  $this->input->post("courier_type");
                    
                    
                    $inputs["online"]  =  $this->input->post("online");
                    $inputs["print"]  =  $this->input->post("print");
                    $inputs["courier"]  =  $this->input->post("courier");
                    $inputs["special_charges"]  =  $this->input->post("special_charges");
                    $inputs["others"]  =  $this->input->post("others");
                    if($this->input->post("reference")){
                         $inputs["reference"]  =  $this->input->post("reference");
                    }
                   
					
					$today = date("Y-m-d", time());
					$query = "Select count(`total_price`) as total 
							  FROM `income` 
							  WHERE `income`.`status` IN (0, 1) 
							  AND DATE(`income`.`created_date`) = '".$today."'";
					$result = $this->db->query($query);
					$total = $result->result()[0]->total;
					$invoice_number = date("ymd", time())."".$total;
					
					$inputs["invoice_number"]  =  $invoice_number;
					
					$inputs['created_by'] = $this->session->userdata['user_id'];
					
					$inputs['created_date'] = date('Y-m-d H:i:s');
					
					
                    
	return $this->income_model->save($inputs);
	}	 	

public function update_data($income_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["customer_name"]  =  $this->input->post("customer_name");
                    
                    $inputs["customer_mobile_number"]  =  preg_replace('/\s+/', '',$this->input->post("customer_mobile_number"));
                    
                    $inputs["customer_address"]  =  $this->input->post("customer_address");
                    
                    $inputs["project_name"]  =  $this->input->post("project_name");
                    
                    $inputs["project_address"]  =  $this->input->post("project_address");
                    
                    $inputs["total_price"]  =  $this->input->post("total_price");
                    
                    $inputs["discount"]  =  $this->input->post("discount");
                    
                    $inputs["courier_type"]  =  $this->input->post("courier_type");
                    $inputs['created_date'] = date('Y-m-d H:i:s');
                    
	return $this->income_model->save($inputs, $income_id);
	}	
	
    //----------------------------------------------------------------
 public function get_income_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("income.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->income_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->income_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->income_model->joinGet($fields, "income", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->income = $this->income_model->joinGet($fields, "income", $join_table, $where, false, false, "`income`.`income_id` DESC");
			return $data;
		}else{
			return $this->income_model->joinGet($fields, "income", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_income($income_id){
	
		$fields = array("income.*");
		$join_table = array();
		$where = "income.income_id = $income_id";
		
		return $this->income_model->joinGet($fields, "income", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

