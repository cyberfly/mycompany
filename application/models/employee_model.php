<?php 

class Employee_model extends MY_Model{

	public $primary_key = 'employee_id';
	public $_table = 'employees';

	// get employee info, join guna teknik MY MODEL

	public function employee_info()
	{
		$this->db->join('departments', 'departments.department_id = employees.department_id');
		return $this;
	}

	//order by key 

	public function orderBy($key,$order='desc')
	{
		$this->db->order_by($key, $order);
		return $this;
	}

	// return all employee records, join teknik biasa

	public function get_employees_info()
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->join('departments', 'departments.department_id = employees.department_id');

		$query = $this->db->get();

		return $query->result();
	}

	// insert into table department


	// get single department record

	
	// update department record
	

	// delete department record

}




