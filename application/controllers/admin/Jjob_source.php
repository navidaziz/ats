<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Job_source extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/job_source_model");
		$this->lang->load("job_source", 'english');
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
		
        $where = "`job_source`.`status` IN (0, 1) ";
		$data = $this->job_source_model->get_job_source_list($where);
		 $this->data["job_source"] = $data->job_source;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Job Source');
		$this->data["view"] = ADMIN_DIR."job_source/job_source";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_job_source($job_source_id){
        
        $job_source_id = (int) $job_source_id;
        
        $this->data["job_source"] = $this->job_source_model->get_job_source($job_source_id);
        $this->data["title"] = $this->lang->line('Job Source Details');
		$this->data["view"] = ADMIN_DIR."job_source/view_job_source";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`job_source`.`status` IN (2) ";
		$data = $this->job_source_model->get_job_source_list($where);
		 $this->data["job_source"] = $data->job_source;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Job Source');
		$this->data["view"] = ADMIN_DIR."job_source/trashed_job_source";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($job_source_id, $page_id = NULL){
        
        $job_source_id = (int) $job_source_id;
        
        
        $this->job_source_model->changeStatus($job_source_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."job_source/view/".$page_id);
    }
    
    /**
      * function to restor job_source from trash
      * @param $job_source_id integer
      */
     public function restore($job_source_id, $page_id = NULL){
        
        $job_source_id = (int) $job_source_id;
        
        
        $this->job_source_model->changeStatus($job_source_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."job_source/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft job_source from trash
      * @param $job_source_id integer
      */
     public function draft($job_source_id, $page_id = NULL){
        
        $job_source_id = (int) $job_source_id;
        
        
        $this->job_source_model->changeStatus($job_source_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."job_source/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish job_source from trash
      * @param $job_source_id integer
      */
     public function publish($job_source_id, $page_id = NULL){
        
        $job_source_id = (int) $job_source_id;
        
        
        $this->job_source_model->changeStatus($job_source_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."job_source/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Job_source
      * @param $job_source_id integer
      */
     public function delete($job_source_id, $page_id = NULL){
        
        $job_source_id = (int) $job_source_id;
        //$this->job_source_model->changeStatus($job_source_id, "3");
        //Remove file....
						$job_source = $this->job_source_model->get_job_source($job_source_id);
						$file_path = $job_source[0]->job_source_logo;
						$this->job_source_model->delete_file($file_path);
		$this->job_source_model->delete(array( 'job_source_id' => $job_source_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."job_source/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Job_source
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New Job Source');$this->data["view"] = ADMIN_DIR."job_source/add_job_source";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->job_source_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("job_source_logo")){
                       $_POST['job_source_logo'] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $job_source_id = $this->job_source_model->save_data();
          if($job_source_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."job_source/edit/$job_source_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."job_source/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Job_source
      */
     public function edit($job_source_id){
		 $job_source_id = (int) $job_source_id;
        $this->data["job_source"] = $this->job_source_model->get($job_source_id);
		  
        $this->data["title"] = $this->lang->line('Edit Job Source');$this->data["view"] = ADMIN_DIR."job_source/edit_job_source";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($job_source_id){
		 
		 $job_source_id = (int) $job_source_id;
       
	   if($this->job_source_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("job_source_logo")){
                         $_POST["job_source_logo"] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $job_source_id = $this->job_source_model->update_data($job_source_id);
          if($job_source_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."job_source/edit/$job_source_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."job_source/edit/$job_source_id");
            }
        }else{
			$this->edit($job_source_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["job_source"] = $this->job_source_model->getBy($where, false, "job_source_id" );
				$j_array[]=array("id" => "", "value" => "job_source");
				foreach($data["job_source"] as $job_source ){
					$j_array[]=array("id" => $job_source->job_source_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
