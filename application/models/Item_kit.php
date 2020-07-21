<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Item_kit class
 */

class Item_kit extends CI_Model
{
	/*
	Determines if a given item_id is an item kit
	*/
	public function exists($item_kit_id)
	{
		$this->db->from('item_kits');
		$this->db->where('item_kit_id', $item_kit_id);

		return ($this->db->get()->num_rows() == 1);
	}

	/*
	Check if a given item_id is an item kit
	*/
	public function is_valid_item_kit($item_kit_id)
	{
		if(!empty($item_kit_id))
		{
			//KIT #
			$pieces = explode(' ', $item_kit_id);

			if(count($pieces) == 2 && preg_match('/(KIT)/i', $pieces[0]))
			{
				return $this->exists($pieces[1]);
			}
		}

		return FALSE;
	}

	/*
	Gets total of rows
	*/
	public function get_total_rows()
	{
		$this->db->from('item_kits');

		return $this->db->count_all_results();
	}

	/*
	Gets information about a particular item kit
	*/
	public function get_info($item_kit_id)
	{
		$this->db->select('
		item_kit_id,
		item_kits.name as name,
		items.name as item_name,
		item_kits.description,
		items.description as item_description,
		item_kits.item_id as kit_item_id,
		kit_discount,
		kit_discount_type,
		price_option,
		print_option,
		item_kits.category,
		supplier_id,
		item_number,
		cost_price,
		unit_price,
		reorder_level,
		receiving_quantity,
		kit_filename,
		allow_alt_description,
		is_serialized,
		items.deleted,
		item_type,
		stock_type');

		$this->db->from('item_kits');
		$this->db->join('items', 'item_kits.item_id = items.item_id', 'left');
		$this->db->where('item_kit_id', $item_kit_id);

		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $item_kit_id is NOT an item kit
			$item_obj = new stdClass();

			//Get all the fields from items table
			foreach($this->db->list_fields('item_kits') as $field)
			{
				$item_obj->$field = '';
			}

			return $item_obj;
		}
	}

	public function get_info_by_id_or_number($item_id, $include_deleted = TRUE)
	{
		$this->db->from('item_kits');

		$this->db->group_start();

		$this->db->where('item_kits.item_kit_id', $item_id);

		// check if $item_id is a number and not a string starting with 0
		// because cases like 00012345 will be seen as a number where it is a barcode
		if(ctype_digit($item_id) && substr($item_id, 0, 1) != '0')
		{
			$this->db->or_where('item_kits.item_kit_id', (int) $item_id);
		}

		$this->db->group_end();

		// if(!$include_deleted)
		// {
		// 	$this->db->where('item_kits.deleted', 0);
		// }

		// limit to only 1 so there is a result in case two are returned
		// due to barcode and item_id clash
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			$item_kit_cart_data = $query->row();
			
			$this->db->select('item_id , quantity');
			$this->db->from('item_kit_items');
			$this->db->where("item_kit_id", $item_kit_cart_data->item_kit_id);
			$query1 = $this->db->get()->result();
			
			$qty = array();
			$item_kit_detail = array();
			foreach($query1 as $items){
				$qty[] = $items->quantity;
				
				// $this->db->select("*");
				$this->db->where("item_id", $items->item_id);
				$items_data = $this->db->get('items')->row();
				// echo "<pre>"; print_r($items_data); echo "</pre>"; exit;
				$cost_price[] = $items_data->cost_price;
				$unit_price[] = $items_data->unit_price;	
				$item_kit_cart_data->item_data[] = $items_data;
			}
			
			$item_kit_cart_data->cost_price = array_sum($cost_price);
			$item_kit_cart_data->unit_price = array_sum($unit_price);
			$item_kit_cart_data->qty = array_sum($qty);
			
			return $query->row();
		}

		return '';
	}

	/*
	Gets information about multiple item kits
	*/
	public function get_multiple_info($item_kit_ids)
	{
		$this->db->from('item_kits');
		$this->db->where_in('item_kit_id', $item_kit_ids);
		$this->db->order_by('name', 'asc');

		return $this->db->get();
	}

	/*
	Inserts or updates an item kit
	*/
	public function save(&$item_kit_data, $item_kit_id = FALSE)
	{
		if(!$item_kit_id || !$this->exists($item_kit_id))
		{
			if($this->db->insert('item_kits', $item_kit_data))
			{
				$item_kit_data['item_kit_id'] = $this->db->insert_id();

				return TRUE;
			}

			return FALSE;
		}

		$this->db->where('item_kit_id', $item_kit_id);

		return $this->db->update('item_kits', $item_kit_data);
	}
	public function get_categories()
	{
		$this->db->select('category as kit_category, category');
		$this->db->from('item_kits');
		$this->db->distinct();
		$this->db->order_by('category', 'asc');

		return $this->db->get();
	}

	public function get_category_suggestions($search)
	{
		$suggestions = array();
		$this->db->select('category');
		$this->db->from('item_kits');
		$this->db->like('category', $search);
		$this->db->order_by('category', 'asc');
		$this->db->distinct();
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('label' => $row->category);
		}

		return $suggestions;
	}

	/*
	Deletes one item kit
	*/
	public function delete($item_kit_id)
	{
		return $this->db->delete('item_kits', array('item_kit_id' => $id));
	}

	/*
	Deletes a list of item kits
	*/
	public function delete_list($item_kit_ids)
	{
		$this->db->where_in('item_kit_id', $item_kit_ids);

		return $this->db->delete('item_kits');
	}

	public function get_category_search_suggestions($search, $limit = 25)
	{
		$suggestions = array();

		$this->db->from('item_kits');
		$this->db->like('category', $search);
		$this->db->order_by('name', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			if($row->kit_filename != ""){
				$suggestions[] = array('value' => 'KIT ' . $row->item_kit_id, 'label' => $row->name, 'icon' => site_url('items/pic_thumb/'.$row->kit_filename));
			}else{
				$suggestions[] = array('value' => 'KIT ' . $row->item_kit_id, 'label' => $row->name, 'icon' => site_url('items/pic_thumb/no-img.png'));
			}
		}

		//only return $limit suggestions
		if(count($suggestions) > $limit)
		{
			$suggestions = array_slice($suggestions, 0, $limit);
		}

		return $suggestions;
	}

	public function get_search_suggestions($search, $limit = 25)
	{
		$suggestions = array();

		$this->db->from('item_kits');

		//KIT #
		if(stripos($search, 'KIT ') !== FALSE)
		{
			$this->db->like('item_kit_id', str_ireplace('KIT ', '', $search));
			$this->db->order_by('item_kit_id', 'asc');
			foreach($this->db->get()->result() as $row)
			{
				if($row->kit_filename != ""){
					$suggestions[] = array('value' => 'KIT '. $row->item_kit_id, 'label' => 'KIT ' . $row->item_kit_id, 'icon' => site_url('items/pic_thumb/'.$row->kit_filename));

				}else{
					$suggestions[] = array('value' => 'KIT '. $row->item_kit_id, 'label' => 'KIT ' . $row->item_kit_id, 'icon' => site_url('items/pic_thumb/no-img.png'));

				}
			}
		}
		else
		{
			$this->db->like('name', $search);
			$this->db->order_by('name', 'asc');
			foreach($this->db->get()->result() as $row)
			{
				if($row->kit_filename != ""){
					$suggestions[] = array('value' => 'KIT ' . $row->item_kit_id, 'label' => $row->name, 'icon' => site_url('items/pic_thumb/'.$row->kit_filename));

				}else{
					$suggestions[] = array('value' => 'KIT ' . $row->item_kit_id, 'label' => $row->name, 'icon' => site_url('items/pic_thumb/no-img.png'));

				}
			}
		}

		//only return $limit suggestions
		if(count($suggestions) > $limit)
		{
			$suggestions = array_slice($suggestions, 0, $limit);
		}

		return $suggestions;
	}

 	/*
	Gets rows
	*/
	public function get_found_rows($search)
	{
		return $this->search($search, 0, 0, 'name', 'asc', TRUE);
	}

	/*
	Perform a search on items
	*/
	public function search($search, $rows = 0, $limit_from = 0, $sort = 'name', $order = 'asc', $count_only = FALSE)
	{
		// get_found_rows case
		if($count_only == TRUE)
		{
			$this->db->select('COUNT(item_kits.item_kit_id) as count');
		}

		$this->db->from('item_kits AS item_kits');
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);

		//KIT #
		if(stripos($search, 'KIT ') !== FALSE)
		{
			$this->db->or_like('item_kit_id', str_ireplace('KIT ', '', $search));
		}

		// get_found_rows case
		if($count_only == TRUE)
		{
			return $this->db->get()->row()->count;
		}

		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();
	}
}
?>
