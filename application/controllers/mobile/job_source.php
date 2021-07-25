<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Job_source extends Admin_Controller_Mobile{
    
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
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`job_source`.`status` IN (0, 1) ";
		$data = $this->job_source_model->get_job_source_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_job_source($job_source_id){
        
        $job_source_id = (int) $job_source_id;
		$data = $this->job_source_model->get_job_source($job_source_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`job_source`.`status` IN (2) ";
		$data = $this->job_source_model->get_job_source_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($job_source_id){
        
        $job_source_id = (int) $job_source_id;
		$this->job_source_model->changeStatus($job_source_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor job_source from trash
      * @param $job_source_id integer
      */
     public function restore($job_source_id){
        
        $job_source_id = (int) $job_source_id;
		$this->job_source_model->changeStatus($job_source_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft job_source from trash
      * @param $job_source_id integer
      */
     public function draft($job_source_id){
        
        $job_source_id = (int) $job_source_id;
		$this->job_source_model->changeStatus($job_source_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish job_source from trash
      * @param $job_source_id integer
      */
     public function publish($job_source_id){
        
        $job_source_id = (int) $job_source_id;
		$this->job_source_model->changeStatus($job_source_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
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
						$this->job_source_model->delete_file($file_path);$this->job_source_model->delete(array( 'job_source_id' => $job_source_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$job_source_id = $this->job_source_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($job_source_id){
		$job_source_id = $this->job_source_model->update_data($job_source_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
