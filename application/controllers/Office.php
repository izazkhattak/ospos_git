<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Office extends Secure_Controller
{
	function __construct()
	{
		parent::__construct('office', NULL, 'office');
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

	/*	Desactivado hasta encontrar la solucion
		$this->db->select('ROUND(SUM(item_unit_price * quantity_purchased * (1 - discount_percent / 100)),2) as totals');
		$this->db->from('sales_items');      
		$sales = $this->db->get()->result_array();
	*/



		$this->load->view('home/office',[
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
}
?>
