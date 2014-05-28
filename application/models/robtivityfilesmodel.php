<?php 

class RobtivityfilesModel extends CI_Model
{
	function addFile($data)
	{
		print_r($data);
		$success = $this->db->insert('robtivies_files', $data);
		return $success;
	}

	function deleteFile($id)
	{
		$success = $this->db->delete('robtivies_files', array('id' => $id));
		return $success;
	}

	function getFiles($id_robtivity, $type)
	{
		$query = $this->db->select('*')
							->from('robtivies_files')
							->where('id_robtivity', $id_robtivity)
							->where('type', $type)
							->get();
		return $query->result();
	}

	function getFilePath($id)
	{
		$query = $this->db->select('path')
							->from('robtivies_files')
							->where('id', $id)
							->get();
		return $query->result();
	}


}