<?php 

class LevelModel extends CI_Model
{
	function addLevel($data)
	{
		$success = $this->db->insert('level', $data);
		return $this->db->insert_id();
	}

	function addLevelNames($data)
	{
		foreach ($data as $key => $value) {
			$success = $this->db->insert('level_names', $value);
		}
		
		return $success;
	}

	function getParrentLevelById($id)
	{
		$query = $this->db->select('id_parrent')
							->from('level')
							->where('id', $id)
						   	->get();
		return $query->result();
	}

	function getLevel($id_lang)
	{
		$query = $this->db->select('*')
							->from('level')
							->where('id_parrent !=', 0)
							->join('level_names', 'level_names.id_level = level.id')
							->like('level_names.id_lang',$id_lang)
							->get();
		return $query->result();
	}

	function getParrentLevel($id_lang)
	{
		$query = $this->db->select('*')
							->from('level')
							->where('id_parrent', 0)
							->join('level_names', 'level_names.id_level = level.id')
							->like('level_names.id_lang',$id_lang)
							->get();
		return $query->result();
	}

	function getLevels()
	{
		$query = $this->db->select('*')
							->from('level_names')
							->order_by('id_level', 'asc')
							->join('language', 'level_names.id_lang = language.id')
							->get();
		return $query->result();
	}

	function updateLevel($id_level, $id_lang, $data)
	{
		$this->db->where('id_level', $id_level);
		$this->db->where('id_lang', $id_lang);
		$success = $this->db->update('level_names', $data);
		return $success;
	}

}