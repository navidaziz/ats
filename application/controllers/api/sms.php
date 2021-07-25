<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Sms extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/sms_model");
		$this->lang->load("sms", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`sms`.`status` IN (0, 1) ";
		$data = $this->sms_model->get_sms_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_sms($sms_id){
        
        $sms_id = (int) $sms_id;
		$data = $this->sms_model->get_sms($sms_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`sms`.`status` IN (2) ";
		$data = $this->sms_model->get_sms_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($sms_id){
        
        $sms_id = (int) $sms_id;
		$this->sms_model->changeStatus($sms_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor sms from trash
      * @param $sms_id integer
      */
     public function restore($sms_id){
        
        $sms_id = (int) $sms_id;
		$this->sms_model->changeStatus($sms_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft sms from trash
      * @param $sms_id integer
      */
     public function draft($sms_id){
        
        $sms_id = (int) $sms_id;
		$this->sms_model->changeStatus($sms_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish sms from trash
      * @param $sms_id integer
      */
     public function publish($sms_id){
        
        $sms_id = (int) $sms_id;
		$this->sms_model->changeStatus($sms_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Sms
      * @param $sms_id integer
      */
     public function delete($sms_id, $page_id = NULL){
        
        $sms_id = (int) $sms_id;
        //$this->sms_model->changeStatus($sms_id, "3");
        $this->sms_model->delete(array( 'sms_id' => $sms_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$sms_id = $this->sms_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($sms_id){
		$sms_id = $this->sms_model->update_data($sms_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
