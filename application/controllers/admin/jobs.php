<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Jobs extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/job_model");
		$this->lang->load("jobs", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`jobs`.`status` IN (0, 1) ";
		$data = $this->job_model->get_job_list($where);
		 $this->data["jobs"] = $data->jobs;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Jobs');
		$this->data["view"] = ADMIN_DIR."jobs/jobs";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_job($job_id){
        
        $job_id = (int) $job_id;
        
        $this->data["jobs"] = $this->job_model->get_job($job_id);
        $this->data["title"] = $this->lang->line('Job Details');
		$this->data["view"] = ADMIN_DIR."jobs/view_job";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`jobs`.`status` IN (2) ";
		$data = $this->job_model->get_job_list($where);
		 $this->data["jobs"] = $data->jobs;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Jobs');
		$this->data["view"] = ADMIN_DIR."jobs/trashed_jobs";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($job_id, $page_id = NULL){
        
        $job_id = (int) $job_id;
        
        
        $this->job_model->changeStatus($job_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."jobs/view/".$page_id);
    }
    
    /**
      * function to restor job from trash
      * @param $job_id integer
      */
     public function restore($job_id, $page_id = NULL){
        
        $job_id = (int) $job_id;
        
        
        $this->job_model->changeStatus($job_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."jobs/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft job from trash
      * @param $job_id integer
      */
     public function draft($job_id, $page_id = NULL){
        
        $job_id = (int) $job_id;
        
        
        $this->job_model->changeStatus($job_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."jobs/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish job from trash
      * @param $job_id integer
      */
     public function publish($job_id, $page_id = NULL){
        
        $job_id = (int) $job_id;
        
        
        $this->job_model->changeStatus($job_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."jobs/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Job
      * @param $job_id integer
      */
     public function delete($job_id, $page_id = NULL){
        
        $job_id = (int) $job_id;
        //$this->job_model->changeStatus($job_id, "3");
        //Remove file....
						$jobs = $this->job_model->get_job($job_id);
						$file_path = $jobs[0]->job_image;
						$this->job_model->delete_file($file_path);
		$this->job_model->delete(array( 'job_id' => $job_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."jobs/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Job
      */
     public function add(){
		
    $this->data["job_source"] = $this->job_model->getList("job_source", "job_source_id", "job_source_title", $where ="`job_source`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New Job');$this->data["view"] = ADMIN_DIR."jobs/add_job";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->job_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("job_image")){
                       $_POST['job_image'] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $job_id = $this->job_model->save_data();
          if($job_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."jobs/edit/$job_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."jobs/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Job
      */
     public function edit($job_id){
		 $job_id = (int) $job_id;
        $this->data["job"] = $this->job_model->get($job_id);
		  
    $this->data["job_source"] = $this->job_model->getList("job_source", "job_source_id", "job_source_title", $where ="`job_source`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit Job');$this->data["view"] = ADMIN_DIR."jobs/edit_job";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($job_id){
		 
		 $job_id = (int) $job_id;
       
	   if($this->job_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("job_image")){
                         $_POST["job_image"] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $job_id = $this->job_model->update_data($job_id);
          if($job_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."jobs/edit/$job_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."jobs/edit/$job_id");
            }
        }else{
			$this->edit($job_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["jobs"] = $this->job_model->getBy($where, false, "job_id" );
				$j_array[]=array("id" => "", "value" => "job");
				foreach($data["jobs"] as $job ){
					$j_array[]=array("id" => $job->job_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
