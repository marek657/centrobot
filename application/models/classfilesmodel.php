<?php 

class ClassfilesModel extends CI_Model
{
	function addFile($data)
	{
		$success = $this->db->insert('class_files', $data);
		return $success;
	}

	function deleteFile($id)
	{
		$success = $this->db->delete('class_files', array('id' => $id));
		return $success;
	}

	function getFiles($id_class)
	{
		$query = $this->db->select('*')
							->from('class_files')
							->where('id_class', $id_class)
							->get();
		return $query->result();
	}

	function getFilePath($id)
	{
		$query = $this->db->select('path')
							->from('class_files')
							->where('id', $id)
							->get();
		return $query->result();
	}


}