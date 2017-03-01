<?php 

class Department_model extends CI_Model{

	// return all departments
	
	public function get_all()
	{
		$query = $this->db->get('departments');

		return $query->result();
	}

	// insert into table department

	public function create($data)
	{
		$this->db->insert('departments', $data);

		// return last insert ID
		return $this->db->insert_id();

	}

	// get single department record

	public function get($id)
	{
		$this->db->where('department_id', $id);
		$query = $this->db->get('departments');
		return $query->row(); 
	}

	// update department record

	public function update($id,$data)
	{
		$this->db->where('department_id', $id);
		return $this->db->update('departments', $data);
	}

	// delete department record

	public function delete($id)
	{
		$this->db->where('department_id', $id);
		return $this->db->delete('departments'); 
	}

} //end of class