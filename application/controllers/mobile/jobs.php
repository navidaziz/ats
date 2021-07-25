<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Jobs extends Admin_Controller_Mobile{
    
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
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`jobs`.`status` IN (0, 1) ";
		$data = $this->job_model->get_job_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_job($job_id){
        
        $job_id = (int) $job_id;
		$data = $this->job_model->get_job($job_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`jobs`.`status` IN (2) ";
		$data = $this->job_model->get_job_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($job_id){
        
        $job_id = (int) $job_id;
		$this->job_model->changeStatus($job_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor job from trash
      * @param $job_id integer
      */
     public function restore($job_id){
        
        $job_id = (int) $job_id;
		$this->job_model->changeStatus($job_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft job from trash
      * @param $job_id integer
      */
     public function draft($job_id){
        
        $job_id = (int) $job_id;
		$this->job_model->changeStatus($job_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish job from trash
      * @param $job_id integer
      */
     public function publish($job_id){
        
        $job_id = (int) $job_id;
		$this->job_model->changeStatus($job_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
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
						$this->job_model->delete_file($file_path);$this->job_model->delete(array( 'job_id' => $job_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$job_id = $this->job_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($job_id){
		$job_id = $this->job_model->update_data($job_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
