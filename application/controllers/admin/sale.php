<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Sale extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/income_model");
		$this->lang->load("income", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
		
		redirect(ADMIN_DIR."income/view/");
		
		}
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`income`.`status` IN (0, 1) ";
		$data = $this->income_model->get_income_list($where);
		 $this->data["income"] = $data->income;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Income');
		//$this->data["view"] = ADMIN_DIR."income/income";
		//$this->load->view(ADMIN_DIR."layout", $this->data);
		$this->load->view(ADMIN_DIR."income/income", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_income($income_id){
        
        $income_id = (int) $income_id;
        
        $this->data["income"] = $this->income_model->get_income($income_id);
        $this->data["title"] = $this->lang->line('Income Details');
		$this->data["view"] = ADMIN_DIR."income/view_income";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`income`.`status` IN (2) ";
		$data = $this->income_model->get_income_list($where);
		 $this->data["income"] = $data->income;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Income');
		$this->data["view"] = ADMIN_DIR."income/trashed_income";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($income_id, $page_id = NULL){
        
        $income_id = (int) $income_id;
        
        
        $this->income_model->changeStatus($income_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."income/view/".$page_id);
    }
    
    /**
      * function to restor income from trash
      * @param $income_id integer
      */
     public function restore($income_id, $page_id = NULL){
        
        $income_id = (int) $income_id;
        
        
        $this->income_model->changeStatus($income_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."income/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft income from trash
      * @param $income_id integer
      */
     public function draft($income_id, $page_id = NULL){
        
        $income_id = (int) $income_id;
        
        
        $this->income_model->changeStatus($income_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."income/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish income from trash
      * @param $income_id integer
      */
     public function publish($income_id, $page_id = NULL){
        
        $income_id = (int) $income_id;
        
        
        $this->income_model->changeStatus($income_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."income/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Income
      * @param $income_id integer
      */
     public function delete($income_id, $page_id = NULL){
        
        $income_id = (int) $income_id;
        //$this->income_model->changeStatus($income_id, "3");
        
		$this->income_model->delete(array( 'income_id' => $income_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."income/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Income
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New Income');$this->data["view"] = ADMIN_DIR."income/add_income";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_income_data(){
	  if($this->income_model->validate_form_data() === TRUE){
		  
		  $income_id = $this->income_model->save_data();
          if($income_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."sale/");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."sale/");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Income
      */
     public function edit($income_id){
		 $income_id = (int) $income_id;
        $this->data["income"] = $this->income_model->get($income_id);
		  
        $this->data["title"] = $this->lang->line('Edit Income');$this->data["view"] = ADMIN_DIR."income/edit_income";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($income_id){
		 
		 $income_id = (int) $income_id;
       
	   if($this->income_model->validate_form_data() === TRUE){
		  
		  $income_id = $this->income_model->update_data($income_id);
          if($income_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."income/edit/$income_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."income/edit/$income_id");
            }
        }else{
			$this->edit($income_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["income"] = $this->income_model->getBy($where, false, "income_id" );
				$j_array[]=array("id" => "", "value" => "income");
				foreach($data["income"] as $income ){
					$j_array[]=array("id" => $income->income_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
