<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Jobs extends Public_Controller{
    
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
        $this->view();
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`jobs`.`status` IN (1) ";
		$data = $this->job_model->get_job_list($where,TRUE, TRUE);
		 $this->data["jobs"] = $data->jobs;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Jobs";
         $this->data["view"] = PUBLIC_DIR."jobs/jobs";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_job($job_id){
        
        $job_id = (int) $job_id;
        
        $this->data["jobs"] = $this->job_model->get_job($job_id);
        $this->data["title"] = "Jobs Details";
        $this->data["view"] = PUBLIC_DIR."jobs/view_job";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        
