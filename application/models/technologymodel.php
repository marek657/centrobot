<?php 

class TechnologyModel extends CI_Model
{
	function addTechnology($data)
	{
		$success = $this->db->insert('technology', $data);
		return $this->db->insert_id();
	}

	function addTechnologyNames($data)
	{
		foreach ($data as $key => $value) {
			$success = $this->db->insert('technology_names', $value);
		}
		
		return $success;
	}

	function getParrentTechnologyById($id)
	{
		$query = $this->db->select('id_parrent')
							->from('technology')
							->where('id', $id)
						   	->get();
		return $query->result();
	}

		function getTechnology($id_lang)
	{
		$query = $this->db->select('*')
							->from('technology')
							->where('id_parrent !=', 0)
							->join('technology_names', 'technology_names.id_technology = technology.id')
							->where('technology_names.id_lang',$id_lang)
							->get();
		return $query->result();
	}

	function getParrentTechlology($id_lang)
	{
		$query = $this->db->select('*')
							->from('technology')
							->where('id_parrent', 0)
							->join('technology_names', 'technology_names.id_technology = technology.id')
							->where('technology_names.id_lang',$id_lang)
							->get();
		return $query->result();
	}

	function getTechnologys()
	{
		$query = $this->db->select('*')
							->from('technology_names')
							->order_by('id_technology', 'asc')
							->join('language', 'technology_names.id_lang = language.id')
							->get();
		return $query->result();
	}

	function updateTechnology($id_technology, $id_lang, $data)
	{
		$this->db->where('id_technology', $id_technology);
		$this->db->where('id_lang', $id_lang);
		$success = $this->db->update('technology_names', $data);
		return $success;
	}
}