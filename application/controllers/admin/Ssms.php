<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Sms extends Admin_Controller{
    
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
        $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`sms`.`status` IN (0, 1) ";
		$data = $this->sms_model->get_sms_list($where);
		 $this->data["sms"] = $data->sms;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Sms');
		$this->data["view"] = ADMIN_DIR."sms/sms";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_sms($sms_id){
        
        $sms_id = (int) $sms_id;
        
        $this->data["sms"] = $this->sms_model->get_sms($sms_id);
        $this->data["title"] = $this->lang->line('Sms Details');
		$this->data["view"] = ADMIN_DIR."sms/view_sms";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`sms`.`status` IN (2) ";
		$data = $this->sms_model->get_sms_list($where);
		 $this->data["sms"] = $data->sms;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Sms');
		$this->data["view"] = ADMIN_DIR."sms/trashed_sms";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($sms_id, $page_id = NULL){
        
        $sms_id = (int) $sms_id;
        
        
        $this->sms_model->changeStatus($sms_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."sms/view/".$page_id);
    }
    
    /**
      * function to restor sms from trash
      * @param $sms_id integer
      */
     public function restore($sms_id, $page_id = NULL){
        
        $sms_id = (int) $sms_id;
        
        
        $this->sms_model->changeStatus($sms_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."sms/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft sms from trash
      * @param $sms_id integer
      */
     public function draft($sms_id, $page_id = NULL){
        
        $sms_id = (int) $sms_id;
        
        
        $this->sms_model->changeStatus($sms_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."sms/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish sms from trash
      * @param $sms_id integer
      */
     public function publish($sms_id, $page_id = NULL){
        
        $sms_id = (int) $sms_id;
        
        
        $this->sms_model->changeStatus($sms_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."sms/view/".$page_id);
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
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."sms/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Sms
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New Sms');$this->data["view"] = ADMIN_DIR."sms/add_sms";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->sms_model->validate_form_data() === TRUE){
		  
		 //$query="SELECT `mobile_number`, `keywords`  FROM `mobile_numbers` ORDER BY `mobile_numbers`.`keywords` DESC ";
		 
		 $query="SELECT `mobile_number`,`name` FROM `mobile_numbers` WHERE `mobile_numbers`.`keywords` ='ATS Customer' ORDER BY `mobile_number_id` DESC limit 3000";
		 
		 //$query="SELECT `mobile_number` FROM `mobile_numbers` WHERE `mobile_numbers`.`keywords` !='ATS Customer'";
		 $query_result = $this->db->query($query);
		 $mobile_numbers = $query_result->result();
		 foreach($mobile_numbers as $mobile_number){
		     if($mobile_number->keywords=='ATS Customer'){
		         $priority = 1;
		     }else{
		        $priority = 0;
		     }
		    
		    $message = $this->db->escape(ucwords(strtolower(substr($mobile_number->name, 0, 13)))." Dear, ".$this->input->post("message"));
			$query="INSERT INTO `sms`(`message`, `mobile_number`, `priority`, `len`) 
			VALUES (".$message.", '".$mobile_number->mobile_number."', '".$priority."', '".strlen($message)."' );";
			 $this->db->query($query);
			 }
		  
		 // $sms_id = $this->sms_model->save_data();
          if($sms_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."sms/edit/$sms_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."sms/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Sms
      */
     public function edit($sms_id){
		 $sms_id = (int) $sms_id;
        $this->data["sms"] = $this->sms_model->get($sms_id);
		  
        $this->data["title"] = $this->lang->line('Edit Sms');$this->data["view"] = ADMIN_DIR."sms/edit_sms";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($sms_id){
		 
		 $sms_id = (int) $sms_id;
       
	   if($this->sms_model->validate_form_data() === TRUE){
		  
		  $sms_id = $this->sms_model->update_data($sms_id);
          if($sms_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."sms/edit/$sms_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."sms/edit/$sms_id");
            }
        }else{
			$this->edit($sms_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["sms"] = $this->sms_model->getBy($where, false, "sms_id" );
				$j_array[]=array("id" => "", "value" => "sms");
				foreach($data["sms"] as $sms ){
					$j_array[]=array("id" => $sms->sms_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
