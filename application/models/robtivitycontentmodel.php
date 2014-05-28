<?php 

class RobtivitycontentModel extends CI_Model
{
	function addRobtivity($data)
	{
		$success = $this->db->insert('robtivies_content', $data);
		return $success;
	}

	function updateRobtivity($id_robtivity, $id_lang, $data)
	{
		$query = $this->db->select('*')
							->from('robtivies_content')
							->where('id_robtivity', $id_robtivity)
							->where('id_lang', $id_lang)
							->update('robtivies_content', $data);
		return $query;
	}

	function deleteRobtivity($id)
	{
		$success = $this->db->delete('robtivies_content', array('id' => $id));
		return $success;
	}

	function getRobtivity($id_robtivity, $id_lang)
	{
		$query = $this->db->select('*')
							->from('robtivies_content')
							->where('id_robtivity', $id_robtivity)
							->where('id_lang', $id_lang)
							->get();
		if ($query->num_rows() > 0){
		 	return $query->result();
		}
		else 
		{
			return false;
		}
		
	}

}