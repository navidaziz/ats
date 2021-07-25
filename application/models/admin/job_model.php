<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Job_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "jobs";
        $this->pk = "job_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "job_source_id",
                            "label"  =>  "Job Source Id",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "job_title",
                            "label"  =>  "Job Title",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "job_detail",
                            "label"  =>  "Job Detail",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "job_end_date",
                            "label"  =>  "Job End Date",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "job_summary",
                            "label"  =>  "Job Summary",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["job_source_id"]  =  $this->input->post("job_source_id");
                    
                    $inputs["job_title"]  =  $this->input->post("job_title");
                    
                    $inputs["job_detail"]  =  $this->input->post("job_detail");
                    
                    $inputs["job_end_date"]  =  $this->input->post("job_end_date");
                    
                    if($_FILES["job_image"]["size"] > 0){
                        $inputs["job_image"]  =  $this->router->fetch_class()."/".$this->input->post("job_image");
                    }
                    
                    $inputs["job_summary"]  =  $this->input->post("job_summary");
                    
	return $this->job_model->save($inputs);
	}	 	

public function update_data($job_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["job_source_id"]  =  $this->input->post("job_source_id");
                    
                    $inputs["job_title"]  =  $this->input->post("job_title");
                    
                    $inputs["job_detail"]  =  $this->input->post("job_detail");
                    
                    $inputs["job_end_date"]  =  $this->input->post("job_end_date");
                    
                    if($_FILES["job_image"]["size"] > 0){
						//remove previous file....
						$jobs = $this->get_job($job_id);
						$file_path = $jobs[0]->job_image;
						$this->delete_file($file_path);
                        $inputs["job_image"]  =  $this->router->fetch_class()."/".$this->input->post("job_image");
                    }
                    
                    $inputs["job_summary"]  =  $this->input->post("job_summary");
                    
	return $this->job_model->save($inputs, $job_id);
	}	
	
    //----------------------------------------------------------------
 public function get_job_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("jobs.job_id"
				,"jobs.job_source_id"
				,"jobs.job_title"
					,"jobs.job_detail"
					,"jobs.job_end_date","jobs.job_image","jobs.job_summary"
                , "job_source.job_source_title"
				 , "job_source.job_source_logo"
            );
		$join_table = array(
            "job_source" => "job_source.job_source_id = jobs.job_source_id",
        );
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->job_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->job_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->job_model->joinGet($fields, "jobs", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->jobs = $this->job_model->joinGet($fields, "jobs", $join_table, $where);
			return $data;
		}else{
			return $this->job_model->joinGet($fields, "jobs", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_job($job_id){
	
		$fields = array("jobs.*"
                , "job_source.job_source_title"
				 , "job_source.job_source_logo"
            );
		$join_table = array(
            "job_source" => "job_source.job_source_id = jobs.job_source_id",
        );
		$where = "jobs.job_id = $job_id";
		
		return $this->job_model->joinGet($fields, "jobs", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

