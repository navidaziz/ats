<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Job_source extends Public_Controller{
    
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
        $this->view();
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`status` IN (1) ";
		$data = $this->job_source_model->get_job_source_list($where,TRUE, TRUE);
		 $this->data["job_source"] = $data->job_source;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Job Source";
         $this->data["view"] = PUBLIC_DIR."job_source/job_source";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_job_source($job_source_id){
        
        $job_source_id = (int) $job_source_id;
        
        $this->data["job_source"] = $this->job_source_model->get_job_source($job_source_id);
        $this->data["title"] = "Job Source Details";
        $this->data["view"] = PUBLIC_DIR."job_source/view_job_source";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        
