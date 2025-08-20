<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Income extends Admin_Controller
{

	/**
	 * constructor method
	 */
	public function __construct()
	{

		parent::__construct();
		$this->load->model("admin/income_model");
		$this->lang->load("income", 'english');
		$this->lang->load("system", 'english');
		//$this->output->enable_profiler(TRUE);
	}
	//---------------------------------------------------------------


	public function dashboard()
	{

		$query = "Select YEAR(`income`.`created_date`) as `year` FROM `income` WHERE `income`.`status` IN (0, 1) GROUP BY YEAR(`income`.`created_date`)";

		$result = $this->db->query($query);
		$years_report = $result->result();

		foreach ($years_report as $year_report) {
			$query = "Select sum(`total_price`) as `total_income` FROM `income` WHERE `income`.`status` IN (0, 1) AND YEAR(`income`.`created_date`)= '$year_report->year'";

			$result = $this->db->query($query);
			$year_report->income_per_year = $result->result()[0]->total_income;

			$query = "Select sum(`expense_amount`) as `expenses` FROM `expenses` WHERE `expenses`.`status` IN (0, 1) AND YEAR(`expenses`.`created_date`)= '$year_report->year'";

			$result = $this->db->query($query);
			$year_report->expense_per_year = $result->result()[0]->expenses;
		}

		$this->data['years_report'] = $years_report;


		$today = date("Y-m-d", time());


		$query = "Select sum(`total_price`) as `total_income`, 
                           sum(`online`) as `online`,
                           sum(`print`) as `print`,
                           sum(`courier`) as `courier`,
                           COUNT(CASE WHEN income.courier > 0 AND DATE(`income`.`created_date`) = '" . $today . "'  THEN 1 END) as `courier_count`,
                           sum(`special_charges`) as `special_charges`,
                           sum(`others`) as `others`
                           FROM `income`
                    WHERE `income`.`status` IN (0, 1) 
                    AND DATE(`income`.`created_date`) = '" . $today . "'";
		$result = $this->db->query($query);
		$total_income = $result->result()[0]->total_income;
		$online = $result->result()[0]->online;
		$print = $result->result()[0]->print;
		$courier = $result->result()[0]->courier;
		$special_charges = $result->result()[0]->special_charges;
		$others = $result->result()[0]->others;

		$courier_count = $result->result()[0]->courier_count;

		if ($total_income) {
			$this->data['total_income'] = $total_income;
		} else {
			$this->data['total_income'] = 0;
		}
		if ($online) {
			$this->data['online'] = $online;
		} else {
			$this->data['online'] = 0;
		}
		if ($print) {
			$this->data['print'] = $print;
		} else {
			$this->data['print'] = 0;
		}
		if ($courier) {
			$this->data['courier'] = $courier;
		} else {
			$this->data['courier'] = 0;
		}
		if ($special_charges) {
			$this->data['special_charges'] = $special_charges;
		} else {
			$this->data['special_charges'] = 0;
		}
		if ($others) {
			$this->data['others'] = $others;
		} else {
			$this->data['others'] = 0;
		}
		if ($courier_count) {
			$this->data['courier_count'] = $courier_count;
		} else {
			$this->data['courier_count'] = 0;
		}

		$query = "Select sum(`expense_amount`) as total_expenses FROM `expenses` WHERE `expenses`.`status` IN (0, 1) AND DATE(`expenses`.`created_date`) = '" . $today . "'";
		$result = $this->db->query($query);
		$total_expenses = $result->result()[0]->total_expenses;
		if ($total_expenses) {
			$this->data['total_expenses'] = $total_expenses;
		} else {
			$this->data['total_expenses'] = 0;
		}

		$this->data['total_net_income'] = $total_income - $total_expenses;

		// $query = "SELECT 
		//             `users`.`user_title`,
		//             (SELECT COUNT(`i`.`income_id`) FROM `income` AS i 
		//             WHERE `users`.`user_id` = `i`.`created_by` 
		//             AND DATE(`i`.created_date) = DATE(CURRENT_DATE())
		//             AND MONTH(`i`.created_date) = MONTH(CURRENT_DATE())
		//             AND YEAR(`i`.created_date) = YEAR(CURRENT_DATE())
		//             AND `i`.`status` IN (0, 1)) AS total,



		//             (SELECT COUNT(`i`.`income_id`) FROM `income` AS i 
		//             WHERE `users`.`user_id` = `i`.`created_by` 
		//             AND MONTH(`i`.created_date) = MONTH(CURRENT_DATE())
		//             AND YEAR(`i`.created_date) = YEAR(CURRENT_DATE())
		//             AND `i`.`status` IN (0, 1)) AS this_month,
		//             (SELECT COUNT(`i`.`income_id`) FROM `income` AS i 
		//             WHERE `users`.`user_id` = `i`.`created_by` 
		//             AND MONTH(`i`.created_date) = MONTH(CURRENT_DATE()- INTERVAL 1 MONTH)
		//             AND YEAR(`i`.created_date) = YEAR(CURRENT_DATE())
		//             AND `i`.`status` IN (0, 1)) AS previous_month				
		//             FROM
		//             `users`,
		//             `income` 
		//             WHERE `users`.`user_id` = `income`.`created_by`
		//             AND `income`.`status` IN (0, 1)
		//             AND `users`.`status`= 1
		//             GROUP BY `users`.`user_title`";
		$query = "SELECT * FROM `emplyees_report_view`";

		$result = $this->db->query($query);
		$this->data['today_user_entries'] = $result->result();



		$query = "SELECT 
  `expense_types`.`expense_type`,
  SUM(`expenses`.`expense_amount`) as expense_total 
FROM
  `expense_types`,
  `expenses` 
WHERE `expense_types`.`expense_type_id` = `expenses`.`expense_type_id`
AND DATE(`expenses`.`created_date`) = '" . $today . "' GROUP BY `expense_types`.`expense_type` ";
		$query_result = $this->db->query($query);
		$this->data['today_expenses'] = $query_result->result();







		$month = date("m", time());
		$year = date("Y", time());
		$today = date("d", time());

		// get current month expense types

		$query = "SELECT 
  `expense_types`.`expense_type`,
  SUM(`expenses`.`expense_amount`) as expense_total 
FROM
  `expense_types`,
  `expenses` 
WHERE `expense_types`.`expense_type_id` = `expenses`.`expense_type_id`
AND YEAR(`expenses`.`created_date`) = '" . $year . "' 
AND  MONTH(`expenses`.`created_date`) = '" . $month . "' GROUP BY `expense_types`.`expense_type` ";



		$query_result = $this->db->query($query);
		$this->data['expense_types'] = $query_result->result();


		$month_income_expence_report = array();

		for ($month = 1; $month <= 12; $month++) {
			$date_query = $year . "-" . $month . "-1";

			//Get income 
			$query = "SELECT SUM(`total_price`) as total_income , 
			               sum(`online`) as `online`,
                           sum(`print`) as `print`,
                           sum(`courier`) as `courier`,
                           COUNT(CASE WHEN income.courier > 0 AND DATE(`income`.`created_date`) = '" . $today . "'  THEN 1 END) as `courier_count`,
                           sum(`special_charges`) as `special_charges`,
                           sum(`others`) as `others`
                           FROM `income`
					  WHERE `income`.`status` IN (0, 1) 
					  AND YEAR(`income`.`created_date`) = '" . $year . "' 
					  AND  MONTH(`income`.`created_date`) = '" . $month . "'";

			$query_result = $this->db->query($query);
			$DateQuery = date("F, Y", strtotime($date_query));
			if ($query_result->result()[0]->total_income) {
				$month_income_expence_report[$DateQuery]['income'] = $query_result->result()[0]->total_income;
				$month_income_expence_report[$DateQuery]['courier_count'] = $query_result->result()[0]->courier_count;
				$month_income_expence_report[$DateQuery]['courier'] = $query_result->result()[0]->courier;
			} else {
				$month_income_expence_report[$DateQuery]['income'] = 0;
				$month_income_expence_report[$DateQuery]['courier_count'] = 0;
				$month_income_expence_report[$DateQuery]['courier'] = 0;
			}

			//get Expences 	
			$query = "SELECT SUM(`expense_amount`) as total_expense FROM `expenses` 
					  WHERE `expenses`.`status` IN (0, 1) 
					  AND YEAR(`expenses`.`created_date`) = '" . $year . "' 
					  AND  MONTH(`expenses`.`created_date`) = '" . $month . "'";
			$query_result = $this->db->query($query);

			if ($query_result->result()[0]->total_expense) {
				$month_income_expence_report[$DateQuery]['expense'] = $query_result->result()[0]->total_expense;
			} else {
				$month_income_expence_report[$DateQuery]['expense'] = 0;
			}

			$month_income_expence_report[$DateQuery]['net_income'] = ($month_income_expence_report[$DateQuery]['income'] - $month_income_expence_report[$DateQuery]['expense']);
		}


		$this->data['month_income_expence_report'] = $month_income_expence_report;

		$month = date("m", time());
		$year = date("Y", time());

		for ($day = 1; $day <= $today; $day++) {
			$date_query = $year . "-" . $month . "-" . $day;

			//Get income 
			$query = "SELECT SUM(`total_price`) as total_income,
			sum(`online`) as `online`,
                           sum(`print`) as `print`,
                           sum(`courier`) as `courier`,
                           COUNT(CASE WHEN income.courier > 0 AND DATE(`income`.`created_date`) = '" . $date_query . "'  THEN 1 END) as `courier_count`,
                           sum(`special_charges`) as `special_charges`,
                           sum(`others`) as `others`
			FROM `income` 
					  WHERE `income`.`status` IN (0, 1) 
					  AND DATE(`income`.`created_date`) = '" . $date_query . "'";
			$query_result = $this->db->query($query);
			$DateQuery = date("d M, Y", strtotime($date_query));
			if ($query_result->result()[0]->total_income) {
				$income_expence_report[$DateQuery]['income'] = $query_result->result()[0]->total_income;
				$income_expence_report[$DateQuery]['courier'] = $query_result->result()[0]->courier;
				$income_expence_report[$DateQuery]['courier_count'] = $query_result->result()[0]->courier_count;
			} else {
				$income_expence_report[$DateQuery]['income'] = 0;
				$income_expence_report[$DateQuery]['courier'] = 0;
				$income_expence_report[$DateQuery]['courier_count'] = 0;
			}

			//get Expences 	
			$query = "SELECT SUM(`expense_amount`) as total_expense FROM `expenses` 
					  WHERE `expenses`.`status` IN (0, 1) 
					  AND DATE(`expenses`.`created_date`) = '" . $date_query . "'";
			$query_result = $this->db->query($query);

			if ($query_result->result()[0]->total_expense) {
				$income_expence_report[$DateQuery]['expense'] = $query_result->result()[0]->total_expense;
			} else {
				$income_expence_report[$DateQuery]['expense'] = 0;
			}

			//get Expences 	
			$query = "SELECT SUM(`expense_amount`) as courier_expense FROM `expenses` 
					  WHERE `expenses`.`status` IN (0, 1) 
					  AND DATE(`expenses`.`created_date`) = '" . $date_query . "'
					  AND expense_type_id=11";
			$query_result = $this->db->query($query);

			if ($query_result->result()[0]->courier_expense) {
				$income_expence_report[$DateQuery]['courier_expense'] = $query_result->result()[0]->courier_expense;
			} else {
				$income_expence_report[$DateQuery]['courier_expense'] = 0;
			}

			$income_expence_report[$DateQuery]['net_income'] = ($income_expence_report[$DateQuery]['income'] - $income_expence_report[$DateQuery]['expense']);
		}



		$this->data['income_expence_report'] = $income_expence_report;


		/*	$today = date("Y-m-d", time());
		
		if($this->input->post("search")){
			$search = $this->input->post("search");
			
			if($this->input->post("search_by") == 'invoice_number'){
				$where = "`income`.`invoice_number` = '".$search."'";
				}
			if($this->input->post("search_by") == 'mobile_number'){
				$where = "`income`.`customer_mobile_number` = '".$search."'";
				}	
			
		}else{
			$where = "`income`.`status` IN (0, 1) AND DATE(`income`.`created_date`) = '".$today."'";
			}
		
		
		
		
		
		
		 $data = $this->income_model->get_income_list($where);
		 $this->data["income"] = $data->income;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Income');
		 
		 
		 $query = "Select sum(`total_price`) as total_income FROM `income` WHERE `income`.`status` IN (0, 1) AND DATE(`income`.`created_date`) = '".$today."'";
		 $result = $this->db->query($query);
		 $total_income = $result->result()[0]->total_income;
		 $this->data['total_income'] = $total_income;
		 
		 
		 //get all project data
		 
		 $query = "Select DISTINCT `project_name`  FROM `income` WHERE `income`.`status` IN (0, 1)";
		 $result = $this->db->query($query);
		 $projects = $result->result();
		 $this->data['project_names'] = $projects;
		*/
		//end here 




		$this->data["view"] = ADMIN_DIR . "income/dashboard";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
		//$this->load->view(ADMIN_DIR."income/dashboard", $this->data);




	}


	/**
	 * Default action to be called
	 */
	public function index()
	{

		$main_page = base_url() . ADMIN_DIR . $this->router->fetch_class() . "/view";
		redirect($main_page);

		exit();

		$query = "Select DISTINCT name, id , mobile_no From contacts";
		$result = $this->db->query($query);
		$contacts = $result->result();
		//var_dump($contacts );

		echo '<table border="1" >';
		$s_no = 1;
		$group = 1;
		$group_count = 1;
		foreach ($contacts as $contact) {

			$mobile_number = (int) $contact->mobile_no;


			if ($group_count <= 90) {
				$name = "JIY" . $group . " " . ucwords(strtolower($contact->name));
				$group_count++;
			} else {
				$group++;
				$group_count = 0;
			}

			if (@$contact->mobile_no[0] == 9 and @$contact->mobile_no[1] == 2) {
				$mobile_number = preg_replace("/[^0-9]/", "", substr($contact->mobile_no, 2));
				echo "<tr><td>" . $name . "</td><td> " . $mobile_number . "</td></tr>";
			} else {
				$mobile_number = preg_replace("/[^0-9]/", "", $contact->mobile_no);
				echo "<tr><td>" . $name . "</td><td> " . $mobile_number . "</td></tr>";
			}
		}
		echo "</table>";
		exit();

		$main_page = base_url() . ADMIN_DIR . $this->router->fetch_class() . "/view";
		redirect($main_page);
	}
	//---------------------------------------------------------------



	/**
	 * get a list of all items that are not trashed
	 */
	public function view()
	{


		//check for search here .......



		/// end here ..................


		$today = date("Y-m-d", time());

		if ($this->input->post("search")) {
			$search = $this->input->post("search");
			$where = '`income`.`customer_mobile_number` LIKE "%' . $search . '%" 
				          OR `income`.`customer_name`LIKE "%' . $search . '%"
				          OR `income`.`invoice_number` LIKE "%' . $search . '%"';
		} else {

			if ($this->session->userdata['user_id'] == 10 or $this->session->userdata['user_id'] == 18) {

				$where = "`income`.`status` IN (0, 1) AND DATE(`income`.`created_date`) = '" . $today . "'";
			} else {
				$where = "`income`.`status` IN (0, 1) AND DATE(`income`.`created_date`) = '" . $today . "' and `income`.`created_by` = " . $this->session->userdata['user_id'];
			}
		}


		$data = $this->income_model->get_income_list($where,false);
		//var_dump($data);

		//get uesr 

		$query = "Select user_id, user_title FROM users";
		$result = $this->db->query($query);
		$users = $result->result();
		$user_list = array();
		foreach ($users as $user) {
			$user_list[$user->user_id] = $user->user_title;
		}
		$this->data['user_list'] = $user_list;
		$this->data["income"] = $data;
		$this->data["pagination"] = $data->pagination;
		$this->data["title"] = $this->lang->line('Income');


		$query = "Select sum(`total_price`) as total_income FROM `income` WHERE `income`.`status` IN (0, 1) AND DATE(`income`.`created_date`) = '" . $today . "'";
		$result = $this->db->query($query);
		$total_income = $result->result()[0]->total_income;
		$this->data['total_income'] = $total_income;


		//get all project data

		$query = "Select DISTINCT `project_name`  FROM `income` WHERE `income`.`status` IN (0, 1)";
		$result = $this->db->query($query);
		$projects = $result->result();
		$this->data['project_names'] = $projects;

		//end here 




		//$this->data["view"] = ADMIN_DIR."income/income";
		//$this->load->view(ADMIN_DIR."layout", $this->data);
		//$this->load->view(ADMIN_DIR."income/income", $this->data);

		$this->data["view"] = ADMIN_DIR . "income/income";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}
	//-----------------------------------------------------

	/**
	 * get single record by id
	 */
	public function view_income($income_id)
	{

		$income_id = (int) $income_id;

		$this->data["income"] = $this->income_model->get_income($income_id);
		$this->data["title"] = $this->lang->line('Income Details');
		$this->data["view"] = ADMIN_DIR . "income/view_income";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}
	//-----------------------------------------------------

	/**
	 * get a list of all trashed items
	 */
	public function trashed()
	{

		$where = "`income`.`status` IN (2) ";
		$data = $this->income_model->get_income_list($where);
		$this->data["income"] = $data->income;
		$this->data["pagination"] = $data->pagination;
		$this->data["title"] = $this->lang->line('Trashed Income');
		$this->data["view"] = ADMIN_DIR . "income/trashed_income";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}
	//-----------------------------------------------------

	/**
	 * function to send a user to trash
	 */
	public function trash($income_id, $page_id = NULL)
	{

		$income_id = (int) $income_id;


		$this->income_model->changeStatus($income_id, "2");
		$this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
		redirect(ADMIN_DIR . "income/view/" . $page_id);
	}

	/**
	 * function to restor income from trash
	 * @param $income_id integer
	 */
	public function restore($income_id, $page_id = NULL)
	{

		$income_id = (int) $income_id;


		$this->income_model->changeStatus($income_id, "1");
		$this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
		redirect(ADMIN_DIR . "income/trashed/" . $page_id);
	}
	//---------------------------------------------------------------------------

	/**
	 * function to draft income from trash
	 * @param $income_id integer
	 */
	public function draft($income_id, $page_id = NULL)
	{

		$income_id = (int) $income_id;


		$this->income_model->changeStatus($income_id, "0");
		$this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
		redirect(ADMIN_DIR . "income/view/" . $page_id);
	}
	//---------------------------------------------------------------------------

	/**
	 * function to publish income from trash
	 * @param $income_id integer
	 */
	public function publish($income_id, $page_id = NULL)
	{

		$income_id = (int) $income_id;


		$this->income_model->changeStatus($income_id, "1");
		$this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
		redirect(ADMIN_DIR . "income/view/" . $page_id);
	}
	//---------------------------------------------------------------------------

	/**
	 * function to permanently delete a Income
	 * @param $income_id integer
	 */
	public function delete($income_id, $page_id = NULL)
	{

		//$income_id = (int) $income_id;
		//$this->income_model->changeStatus($income_id, "3");

		//$this->income_model->delete(array( 'income_id' => $income_id));
		//$this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
		//redirect(ADMIN_DIR."income/trashed/".$page_id);
	}
	//----------------------------------------------------



	/**
	 * function to add new Income
	 */
	public function add()
	{

		$this->data["title"] = $this->lang->line('Add New Income');
		$this->data["view"] = ADMIN_DIR . "income/add_income";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}
	//--------------------------------------------------------------------
	public function save_data()
	{
		if ($this->income_model->validate_form_data() === TRUE) {


			$mobile_number = preg_replace("/[^0-9,.]/", "", $this->input->post('customer_mobile_number'));
			$customer_name = ucwords(strtolower($this->input->post('customer_name')));

			if (strlen($mobile_number) == 11) {
				if (substr($mobile_number, 0, 2) == '03') {
					//check if the mobile number is already in database or not 
					$query = "SELECT count(*) as total FROM `mobile_numbers` WHERE `mobile_number`=" . $this->db->escape($mobile_number);
					$query_result = $this->db->query($query);
					$mobile_number_result = $query_result->result()[0];
					if ($mobile_number_result->total == 0) {
						$this->db->query("INSERT INTO `mobile_numbers`( `mobile_number`, `name`, `keywords`) 
					                  VALUES (" . $this->db->escape($mobile_number) . "," . $this->db->escape($customer_name) . ", 'ATS Customer' )");
					}
				}
			}


			//  exit();


			$income_id = $this->income_model->save_data();
			if ($income_id) {

				$customer_name = $this->input->post('customer_name');
				$message = 'Thank you Dear ' . $customer_name . ', for visiting ATS Office Chitral. Please take your invoice.';

				if (strlen($mobile_number) == 11) {
					if (substr($mobile_number, 0, 2) == '03') {

						/*$this->db->query("INSERT INTO `sms`( `message`, `mobile_number`, `status`,`priority`) 
			   VALUES ('".$message." ', ".$this->db->escape($mobile_number).", '0', '1')"); 
			   */
					}
				}
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));

				redirect(ADMIN_DIR . "income/view");
			} else {

				$this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
				redirect(ADMIN_DIR . "income/view");
			}
		} else {
			$this->add();
		}
	}


	/**
	 * function to edit a Income
	 */
	public function edit($income_id)
	{
		//$income_id = (int) $income_id;
		//$this->data["income"] = $this->income_model->get($income_id);

		//$this->data["title"] = $this->lang->line('Edit Income');$this->data["view"] = ADMIN_DIR."income/edit_income";
		//$this->load->view(ADMIN_DIR."layout", $this->data);
	}
	//--------------------------------------------------------------------

	public function update_data($income_id)
	{
		exit();

		$income_id = (int) $income_id;

		if ($this->income_model->validate_form_data() === TRUE) {

			$income_id = $this->income_model->update_data($income_id);
			if ($income_id) {

				$this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
				redirect(ADMIN_DIR . "income/edit/$income_id");
			} else {

				$this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
				redirect(ADMIN_DIR . "income/edit/$income_id");
			}
		} else {
			$this->edit($income_id);
		}
	}


	/**
	 * get data as a json array 
	 */
	public function get_json()
	{
		$where = array("status" => 1);
		$where[$this->uri->segment(3)] = $this->uri->segment(4);
		$data["income"] = $this->income_model->getBy($where, false, "income_id");
		$j_array[] = array("id" => "", "value" => "income");
		foreach ($data["income"] as $income) {
			$j_array[] = array("id" => $income->income_id, "value" => "");
		}
		echo json_encode($j_array);
	}
	//-----------------------------------------------------


	public function get_customer_information($customer_mobile_number)
	{
		$query = "SELECT `customer_name`, 
						 `customer_address`,
						 COUNT(`customer_mobile_number`) as total
				  FROM `income` 
				  WHERE `customer_mobile_number` = '" . $customer_mobile_number . "'";

		$result = $this->db->query($query);

		if ($result->num_rows) {
			$customer_information = $result->result()[0];
			$j_array['customer_name'] = ucwords($customer_information->customer_name);
			$j_array['customer_address'] = ucwords($customer_information->customer_address);
			$j_array['total'] = $customer_information->total;
			$j_array['info_data'] = "yes";
		} else {
			$j_array['customer_name'] = "";
			$j_array['customer_address'] = "";
			$j_array['info_data'] = "no";
		}
		echo json_encode($j_array);
	}




	public function get_project_address()
	{
		$project_name = $this->input->post("project_name");
		$query = "SELECT `project_address` 
				  FROM `income` 
				  WHERE `project_name` = '" . $project_name . "'";

		$result = $this->db->query($query);

		if ($result->num_rows) {
			$project_information = $result->result()[0];
			$j_array['project_address'] = ucwords($project_information->project_address);
			$j_array['info_data'] = "yes";
		} else {
			$j_array['project_address'] = "";
			$j_array['info_data'] = "no";
		}
		echo json_encode($j_array);
	}

	public function print_invoice($income_id)
	{
		$income_id = (int) $income_id;
		$this->data["income"] = $this->income_model->get_income($income_id);

		$this->load->view(ADMIN_DIR . "income/print_invoice", $this->data);
	}
}
