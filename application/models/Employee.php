<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee class
 */

class Employee extends Person
{
	/*
	Determines if a given person_id is an employee
	*/
	public function exists($person_id)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.person_id', $person_id);

		return ($this->db->get()->num_rows() == 1);
	}

	/*
	Gets total of rows
	*/
	public function get_total_rows()
	{
		$this->db->from('employees');
		$this->db->where('deleted', 0);

		return $this->db->count_all_results();
	}

	/*
	Returns all the employees
	*/
	public function get_all($limit = 10000, $offset = 0)
	{
		$this->db->from('employees');
		$this->db->where('deleted', 0);
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->order_by('last_name', 'asc');
		$this->db->limit($limit);
		$this->db->offset($offset);

		return $this->db->get();
	}

	/*
	Gets information about a particular employee
	*/
	public function get_info($employee_id)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.person_id', $employee_id);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $employee_id is NOT an employee
			$person_obj = parent::get_info(-1);

			//Get all the fields from employee table
			//append those fields to base parent object, we we have a complete empty object
			foreach($this->db->list_fields('employees') as $field)
			{
				$person_obj->$field = '';
			}

			return $person_obj;
		}
	}

	/*
	Gets information about multiple employees
	*/
	public function get_multiple_info($employee_ids)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where_in('employees.person_id', $employee_ids);
		$this->db->order_by('last_name', 'asc');

		return $this->db->get();
	}

	/*
	Inserts or updates an employee
	*/
	public function save_employee(&$person_data, &$employee_data, &$grants_data, $employee_id = FALSE)
	{
		$success = FALSE;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if(ENVIRONMENT != 'testing' && parent::save($person_data, $employee_id))
		{
			if(!$employee_id || !$this->exists($employee_id))
			{
				$employee_data['person_id'] = $employee_id = $person_data['person_id'];
				$success = $this->db->insert('employees', $employee_data);
			}
			else
			{
				$this->db->where('person_id', $employee_id);
				$success = $this->db->update('employees', $employee_data);
			}

			//We have either inserted or updated a new employee, now lets set permissions.
			if($success)
			{
				//First lets clear out any grants the employee currently has.
				$success = $this->db->delete('grants', array('person_id' => $employee_id));

				//Now insert the new grants
				if($success)
				{
					foreach($grants_data as $grant)
					{
						$success = $this->db->insert('grants', array('permission_id' => $grant['permission_id'], 'person_id' => $employee_id, 'menu_group' => $grant['menu_group']));
					}
				}
			}
		}

		$this->db->trans_complete();

		$success &= $this->db->trans_status();

		return $success;
	}

	/*
	Deletes one employee
	*/
	public function delete($employee_id)
	{
		$success = FALSE;

		//Don't let employees delete theirself
		if($employee_id == $this->get_logged_in_employee_info()->person_id)
		{
			return FALSE;
		}

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		//Delete permissions
		if($this->db->delete('grants', array('person_id' => $employee_id)))
		{
			$this->db->where('person_id', $employee_id);
			$success = $this->db->update('employees', array('deleted' => 1));
		}

		$this->db->trans_complete();

		return $success;
	}

	/*
	Deletes a list of employees
	*/
	public function delete_list($employee_ids)
	{
		$success = FALSE;

		//Don't let employees delete theirself
		if(in_array($this->get_logged_in_employee_info()->person_id, $employee_ids))
		{
			return FALSE;
		}

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->db->where_in('person_id', $employee_ids);
		//Delete permissions
		if($this->db->delete('grants'))
		{
			//delete from employee table
			$this->db->where_in('person_id', $employee_ids);
			$success = $this->db->update('employees', array('deleted' => 1));
		}

		$this->db->trans_complete();

		return $success;
 	}

	/*
	Get search suggestions to find employees
	*/
	public function get_search_suggestions($search, $limit = 5)
	{
		$suggestions = array();

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->group_start();
			$this->db->like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->or_like('CONCAT(first_name, " ", last_name)', $search);
		$this->db->group_end();
		$this->db->where('deleted', 0);
		$this->db->order_by('last_name', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->first_name.' '.$row->last_name);
		}

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->like('email', $search);
		$this->db->order_by('email', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->email);
		}

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->like('username', $search);
		$this->db->order_by('username', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->username);
		}

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->like('phone_number', $search);
		$this->db->order_by('phone_number', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->phone_number);
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
		return $this->search($search, 0, 0, 'last_name', 'asc', TRUE);
	}

	/*
	Performs a search on employees
	*/
	public function search($search, $rows = 0, $limit_from = 0, $sort = 'last_name', $order = 'asc', $count_only = FALSE)
	{
		// get_found_rows case
		if($count_only == TRUE)
		{
			$this->db->select('COUNT(employees.person_id) as count');
		}

		$this->db->from('employees AS employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->group_start();
			$this->db->like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->or_like('email', $search);
			$this->db->or_like('phone_number', $search);
			$this->db->or_like('username', $search);
			$this->db->or_like('CONCAT(first_name, " ", last_name)', $search);
		$this->db->group_end();
		$this->db->where('deleted', 0);

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

	  public function attendance($employee_id, $type = 'login')
    {
        $info = $this->get_info($employee_id);
        $current_time = time();
        $add_to = (float)str_replace(':', '.', $info->time_to) < (float)str_replace(':', '.', $info->time_from) ? 86400 : 0;
        $employee_duration = ((strtotime(date('Y-m-d '.$info->time_to.':00')) + ($add_to)) - strtotime(date('Y-m-d '.$info->time_from.':00'))) / 60;
 
        $this->db->select('*');
        $this->db->from('attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('DATE(login_time) =', date('Y-m-d'));
        $today_attendance = $this->db->get()->row_array();
 
        if($type == 'login')
        {
            if($today_attendance)
            {
                $this->db->where('employee_id', $employee_id);
                $this->db->where('DATE(login_time) =', date('Y-m-d'));
                $this->db->update('attendance', array(
                    'login_time' => date('Y-m-d H:i:s')
                ));
                return true;
            }
 
            $emp_time = strtotime(date('Y-m-d '.$info->time_from.':00'));
            $difference = ($emp_time - $current_time) / 60;
            $data = array(
                'employee_id' => $employee_id
            );
            if($difference >= $info->early_access)
            	{
            		echo "Your Shift Time is Not Start Yet Please Ask Admin to Access you Over Time Or Change Your Shift Time!";exit();
                return false;
            }
 
            $data['login_time'] = date('Y-m-d H:i:s');
            $this->db->insert('attendance', $data);
        }
        else
        {
            $duration = (strtotime(date('Y-m-d H:i:s')) - strtotime($today_attendance['login_time'])) / 60;
            $update = ['logout_time' => date('Y-m-d H:i:s'), 'duration' => $today_attendance['duration'] + $duration];
            $duration_count = $employee_duration - $update['duration'];
            if($duration_count > 0)
                $update['missing_minutes'] = $duration_count;
            else
                $update['extra_minutes'] = abs($duration_count);
            $this->db->where('employee_id', $employee_id);
            $this->db->where('DATE(login_time) =', date('Y-m-d'));
            $this->db->update('attendance', $update);
        }
 
        return true;
    }
 
    public function getAttendanceData($start_date, $end_date, $employee_id)
    {
        $this->db->select('*');
        $this->db->from('attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('DATE(login_time) >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('DATE(login_time) <=', date('Y-m-d H:i:s', strtotime($end_date)));
        return $this->db->get()->result_array();
    }
 
    public function getAttendanceSummary($start_date, $end_date, $employee_id)
    {
        $this->db->select('SUM(extra_minutes) AS extra_mins, SUM(missing_minutes) AS missing_mins, SUM(duration) AS tota_duration');
        $this->db->from('attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('DATE(login_time) >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('DATE(login_time) <=', date('Y-m-d H:i:s', strtotime($end_date)));
        return $this->db->get()->row_array();
    }
 
 

	/*
	Attempts to login employee and set session. Returns boolean based on outcome.
	*/
	public function login($username, $password)
	{
		$query = $this->db->get_where('employees', array('username' => $username, 'deleted' => 0), 1);

		if($query->num_rows() == 1)
		{
			$row = $query->row();

			// compare passwords depending on the hash version
			if($row->hash_version == 1 && $row->password == md5($password))
			{
				$this->db->where('person_id', $row->person_id);
				$this->session->set_userdata('person_id', $row->person_id);
				$password_hash = password_hash($password, PASSWORD_DEFAULT);

				return $this->db->update('employees', array('hash_version' => 2, 'password' => $password_hash));
			}
			elseif($row->hash_version == 2 && password_verify($password, $row->password))
			{
				 if($row->username != 'admin' && $row->use_device == 1)
                {
                    if(!$this->attendance($row->person_id))
                        return false;
                
 
                    $this->load->helper('cookie');
                    if((empty($this->input->cookie('employee_cookie', TRUE)) && $row->cookie_set == 0) || $row->cookie_set == 2)
                    {
                        $cookie = array(
                            'name'   => 'employee_cookie',
                            'value'  => 'employee device set',
                            'expire' => 31556952 * 10,
                            'secure' => FALSE
                        );
                        $this->input->set_cookie($cookie);
                        $this->db->where('person_id', $row->person_id);
                        $this->db->update('employees', ['cookie_set' => 1]);
                    }
                    else if(empty($this->input->cookie('employee_cookie', TRUE)) && $row->cookie_set == 1)
                        {echo "You are already login on a registerd give devise please ask permission from admin to aalow this devise access!";exit();}
                }
 
                if($row->username != 'admin')
                    $this->session->set_userdata(['confirmation_minutes' => $row->confirmation_minutes, 'popup_time' => $row->popup_time, 'logout_time' => $row->time_to]);
 
				$this->session->set_userdata('person_id', $row->person_id);

				return TRUE;
			}

		}

		return FALSE;
	}

	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	public function logout()
	{
		$this->attendance($this->session->userdata('person_id'), 'logout');

		$this->session->sess_destroy();

		redirect('login');
	}

	/*
	Determins if a employee is logged in
	*/
	public function is_logged_in()
	{
		return ($this->session->userdata('person_id') != FALSE);
	}

	/*
	Gets information about the currently logged in employee.
	*/
	public function get_logged_in_employee_info()
	{
		if($this->is_logged_in())
		{
			return $this->get_info($this->session->userdata('person_id'));
		}

		return FALSE;
	}

	/*
	Determines whether the employee has access to at least one submodule
	*/
	public function has_module_grant($permission_id, $person_id)
	{
		$this->db->from('grants');
		$this->db->like('permission_id', $permission_id, 'after');
		$this->db->where('person_id', $person_id);
		$result_count = $this->db->get()->num_rows();

		if($result_count != 1)
		{
			return ($result_count != 0);
		}

		return $this->has_subpermissions($permission_id);
	}

 	/*
	Checks permissions
	*/
	public function has_subpermissions($permission_id)
	{
		$this->db->from('permissions');
		$this->db->like('permission_id', $permission_id.'_', 'after');

		return ($this->db->get()->num_rows() == 0);
	}

	/**
	 * Determines whether the employee specified employee has access the specific module.
	 */
	public function has_grant($permission_id, $person_id)
	{
		//if no module_id is null, allow access
		if($permission_id == NULL)
		{
			return TRUE;
		}

		$query = $this->db->get_where('grants', array('person_id' => $person_id, 'permission_id' => $permission_id), 1);

		return ($query->num_rows() == 1);
	}

	/**
	 * Returns the menu group designation that this module is to appear in
	 */
	public function get_menu_group($permission_id, $person_id)
	{
		$this->db->select('menu_group');
		$this->db->from('grants');
		$this->db->where('permission_id', $permission_id);
		$this->db->where('person_id', $person_id);

		$row = $this->db->get()->row();

		// If no grants are assigned yet then set the default to 'home'
		if($row == NULL)
		{
			return 'home';
		}
		else
		{
			return $row->menu_group;
		}
	}

	/*
	Gets employee permission grants
	*/
	public function get_employee_grants($person_id)
	{
		$this->db->from('grants');
		$this->db->where('person_id', $person_id);

		return $this->db->get()->result_array();
	}

	/*
	Attempts to login employee and set session. Returns boolean based on outcome.
	*/
	public function check_password($username, $password)
	{
		$query = $this->db->get_where('employees', array('username' => $username, 'deleted' => 0), 1);

		if($query->num_rows() == 1)
		{
			$row = $query->row();

			// compare passwords
			if(password_verify($password, $row->password))
			{
				return TRUE;
			}

		}

		return FALSE;
	}

	/*
	Change password for the employee
	*/
	public function change_password($employee_data, $employee_id = FALSE)
	{
		$success = FALSE;

		if(ENVIRONMENT != 'testing')
		{
			//Run these queries as a transaction, we want to make sure we do all or nothing
			$this->db->trans_start();

			$this->db->where('person_id', $employee_id);
			$success = $this->db->update('employees', $employee_data);

			$this->db->trans_complete();

			$success &= $this->db->trans_status();
		}

		return $success;
	}
}
?>
