<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Sms extends Public_Controller{
    
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
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $this->view();
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`status` IN (1) ";
		$data = $this->sms_model->get_sms_list($where,TRUE, TRUE);
		 $this->data["sms"] = $data->sms;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Sms";
         $this->data["view"] = PUBLIC_DIR."sms/sms";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_sms($sms_id){
        
        $sms_id = (int) $sms_id;
        
        $this->data["sms"] = $this->sms_model->get_sms($sms_id);
        $this->data["title"] = "Sms Details";
        $this->data["view"] = PUBLIC_DIR."sms/view_sms";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        
