<?php 

class ClassModel extends CI_Model
{
	function addClass($data)
	{
		$success = $this->db->insert('class', $data);
		return $this->db->insert_id();
	}

	function updateClass($id, $data)
	{
		$this->db->where('id', $id);
		$success = $this->db->update('class', $data);
		return $success;
	}

	function deleteClass($id)
	{
		$success = $this->db->delete('class', array('id' => $id));
		$success = $this->db->delete('class_files', array('id_class' => $id));
		return $success;
	}

	function getClass($id)
	{
		$query = $this->db->select('*')
							->from('class')
							->where('id', $id)
						   	->get();
		return $query->result();
	}

	function getClassByTeacher($id_teacher)
	{
		$query = $this->db->where('id_teacher', $id_teacher)
						   ->get('class');
		return $query->result();	
	}

}