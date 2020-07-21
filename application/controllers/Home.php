<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Home extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct(NULL, NULL, 'home');
	}

	public function index()
	{
		/*V1.1*/
		$this->db->select('count(*) as counts');
		$this->db->from('items');
		$this->db->where('deleted=0');      
		$count_items = $this->db->get()->result_array();


		$this->db->select('count(*) as counts');
		$this->db->from('item_kits');     
		$count_item_kits = $this->db->get()->result_array();

		$this->db->select('count(*) as counts');
		$this->db->from('customers');
		$this->db->where('deleted=0');      
		$customers = $this->db->get()->result_array();

		$this->db->select('count(*) as counts');
		$this->db->from('employees');
		$this->db->where('deleted=0');      
		$employees = $this->db->get()->result_array();

	
		$this->db->select('ROUND(SUM(item_unit_price),2) as totals');
		$this->db->from('sales_items');      
		$sales = $this->db->get()->result_array();
	



		$this->load->view('home/home',[
				'count_items'=>$count_items,
				'count_item_kits'=>$count_item_kits,
				'customers'=>$customers,
				'employees'=>$employees,
				'sales'=>$sales

			]);
	/*V1.1*/
	}

	public function logout()
	{
		$this->Employee->logout();
	}

	/*
	Load "change employee password" form
	*/
	public function change_password($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $person_info;

		$this->load->view('home/form_change_password', $data);
	}

	/*
	Change employee password
	*/
	public function save($employee_id = -1)
	{
		if($this->input->post('current_password') != '' && $employee_id != -1)
		{
			if($this->Employee->check_password($this->input->post('username'), $this->input->post('current_password')))
			{
				$employee_data = array(
					'username' => $this->input->post('username'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'hash_version' => 2
				);

				if($this->Employee->change_password($employee_data, $employee_id))
				{
					echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('employees_successful_change_password'), 'id' => $employee_id));
				}
				else//failure
				{
					echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_unsuccessful_change_password'), 'id' => -1));
				}
			}
			else
			{
				echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_current_password_invalid'), 'id' => -1));
			}
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_current_password_invalid'), 'id' => -1));
		}
	}

	public function setLanguage(){
		$exploded = explode(":", $_GET['lang']);
		$batch_save_data = array(
			'language_code' => $exploded[0],
			'language' => $exploded[1]
		);

		//ONLINE
		$_SESSION['language_code']=$exploded[0];
		$_SESSION['language']=$exploded[1];
		
		//$result = $this->Appconfig->batch_save($batch_save_data);
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function setTheme(){
		$batch_save_data = array(
			'theme' => $_GET['theme']
		);
		//ONLINE
		$_SESSION['theme']=$_GET['theme'];

		// disable this code online only
		//$result = $this->Appconfig->batch_save($batch_save_data);
		redirect($_SERVER['HTTP_REFERER']);
	}
}
?>
