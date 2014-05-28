<?php 

class UserModel extends CI_Model
{
	function addUser($data)
	{
		$success = $this->db->insert('users', $data);
		return $success;
	}

	function updateUser($id, $data)
	{
		$this->db->where('id', $id);
		$success = $this->db->update('users', $data);
		return $success;
	}

	function deleteUser($id)
	{
		$success = $this->db->delete('users', array('id' => $id));
		$success = $this->db->delete('robtivies_authors', array('id_author' => $id));

		return $success;
	}

	function getUser($id)
	{
		$this->db->where('id', $id);
		$success = $this->db->get_where('users',array('id' => $id));
		return $success->result();	
	}

	function getUsers()
	{
		$success = $this->db->get_where('users',array('function' => 2));
		return $success->result();	
	}

	function checkPassword($password, $email)
	{

		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if ($query->num_rows == 1)
		{
			return true;
		}

	}

	function getByEmail($email){
		$this->db->select('id, function, name, lastname, email');
		$query = $this->db->where('email', $email)->limit(1)->get('users');

		if ($query->num_rows() > 0) 
			return $query->row_array();
		else 
			return false;
	}

	function checkPermission($email)
	{
		$query = $this->db->select('function')
							->from('users')
							->where('email', $email)
						   	->get();
		if ($query->result()['0']->function == 0) {
			return false;
		} else {
			return true;
		}
		
	}

	function getWaitingUsers()
	{
		$query = $this->db->select('*')
							->from('users')
							->where('function', 0)
						   	->get();
		return $query->result();
	}

}