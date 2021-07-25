<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Android_mobile_service extends Admin_Controller_Mobile{
    
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
    

    public function view(){
		
       echo "Test";
    }
	public function get_jobs(){
		$where = "`jobs`.`status` IN (1) ORDER BY `job_id` DESC ";
		$data = $this->job_model->get_job_list($where, false);
		echo json_encode($data);
		/*$data = array();
		$data['message'] = "No New Jobs Avaliables.";
		$data['jobs'] = false;
		$where = "`jobs`.`status` IN (1) ";
		$jobs = $this->job_model->get_job_list($where, false);
		if($jobs){
			$data['message'] = count($jobs)." Jobs Found.";
			$data['jobs'] = $jobs;
			}
		echo json_encode($data);*/
		}
		
	public function view_job($job_id){
        
        $job_id = (int) $job_id;
		$data = $this->job_model->get_job($job_id);
        echo json_encode($data);
    }
   
     
}        
