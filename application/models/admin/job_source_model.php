<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Job_source_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "job_source";
        $this->pk = "job_source_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "job_source_title",
                            "label"  =>  "Job Source Title",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["job_source_title"]  =  $this->input->post("job_source_title");
                    
                    if($_FILES["job_source_logo"]["size"] > 0){
                        $inputs["job_source_logo"]  =  $this->router->fetch_class()."/".$this->input->post("job_source_logo");
                    }
                    
	return $this->job_source_model->save($inputs);
	}	 	

public function update_data($job_source_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["job_source_title"]  =  $this->input->post("job_source_title");
                    
                    if($_FILES["job_source_logo"]["size"] > 0){
						//remove previous file....
						$job_source = $this->get_job_source($job_source_id);
						$file_path = $job_source[0]->job_source_logo;
						$this->delete_file($file_path);
                        $inputs["job_source_logo"]  =  $this->router->fetch_class()."/".$this->input->post("job_source_logo");
                    }
                    
	return $this->job_source_model->save($inputs, $job_source_id);
	}	
	
    //----------------------------------------------------------------
 public function get_job_source_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("job_source.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->job_source_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->job_source_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->job_source_model->joinGet($fields, "job_source", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->job_source = $this->job_source_model->joinGet($fields, "job_source", $join_table, $where);
			return $data;
		}else{
			return $this->job_source_model->joinGet($fields, "job_source", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_job_source($job_source_id){
	
		$fields = array("job_source.*");
		$join_table = array();
		$where = "job_source.job_source_id = $job_source_id";
		
		return $this->job_source_model->joinGet($fields, "job_source", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

