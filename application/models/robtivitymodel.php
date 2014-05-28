<?php 

class RobtivityModel extends CI_Model
{
	function addRobtivity($data)
	{
		$success = $this->db->insert('robtivies', $data);
		return $this->db->insert_id();
	}

	function updateRobtivity($id, $data)
	{
		$this->db->where('id', $id);
		$success = $this->db->update('robtivies', $data);
		return $success;
	}

	function deleteRobtivity($id)
	{
		$success = $this->db->delete('robtivies', array('id' => $id));
		$success = $this->db->delete('robtivies_content', array('id_robtivity' => $id));
		$success = $this->db->delete('robtivies_authors', array('id_robtivity' => $id));
		$success = $this->db->delete('robtivies_files', array('id_robtivity' => $id));
		$success = $this->db->delete('rank', array('id_robtivity' => $id));
		$success = $this->db->delete('rank_users', array('id_robtivity' => $id));
		return $success;
	}

	function getRobtivity($id)
	{
		$this->db->where('id', $id);
		$success = $this->db->get_where('robtivies',array('id' => $id));
		return $success->result();	
	}

	function getRobtivies($id_lang)
	{
		$query = $this->db->select('*')
							->from('robtivies')

							->join('robtivies_content', 'robtivies_content.id_robtivity = robtivies.id')

							->join('language', 'language.id = robtivies_content.id_lang')
							
							->join('technology_names', 'technology_names.id_technology = robtivies.id_technology')
							->where('technology_names.id_lang', $id_lang)

							->join('level_names', 'level_names.id_level = robtivies.id_level')
							->where('level_names.id_lang', $id_lang)

							->join('domain_names', 'domain_names.id_domain = robtivies.id_domain')
							->where('domain_names.id_lang', $id_lang)
						   	->get();
		return $query->result();
	}

	function getRobtiviesByAutor($id_author, $id_lang)
	{
		$query = $this->db->select('*')
							->from('robtivies_authors')
							->where('id_author', $id_author)
							->join('robtivies', 'robtivies.id = robtivies_authors.id_robtivity')
							
							->join('technology_names', 'technology_names.id_technology = robtivies.id_technology')
							->where('technology_names.id_lang', $id_lang)

							->join('level_names', 'level_names.id_level = robtivies.id_level')
							->where('level_names.id_lang', $id_lang)

							->join('domain_names', 'domain_names.id_domain = robtivies.id_domain')
							->where('domain_names.id_lang', $id_lang)
						   	->get();
		return $query->result();
	}

	function getLanguages()
	{
		$query = $this->db->select('*')
							->from('language')
						   	->get();
		return $query->result();
	}

	function searchRobtivies($data)
	{
		$keys = explode(',',str_replace(array(',',' ','\n'), ',', $data['keywords']));
		$keywords = array();

		foreach ($keys as $key)
			if (!empty($key))
				$keywords[] = $key;
		
		$sql = "SELECT * FROM robtivies r 
				LEFT JOIN robtivies_content rc ON rc.id_robtivity = r.id
				WHERE rc.publication=1 ";

		if (isset($data['id_technology']) && !empty($data['id_technology'])) 
			$sql .=		" AND (r.id_technology = {$data['id_technology']} OR 
				r.id_technology_parrent = {$data['id_technology']})";

		if (isset($data['id_domain']) && !empty($data['id_domain'])) 
			$sql .= " AND (
				r.id_domain = {$data['id_domain']} OR r.id_domain_parrent = {$data['id_domain']})";

		if (isset($data['id_level']) && !empty($data['id_level'])) 
			$sql .= " AND (
				r.id_level = {$data['id_level']} OR r.id_level_parrent = {$data['id_level']})";

		$sql .= " AND rc.id_lang = {$data['id_lang']} ";
		
		if ($keywords) {
			$sql .= ' AND (';
			foreach ($keywords as $keyword) {
				if (!empty($keyword))
					$sql .= " (rc.keywords LIKE '%{$keyword}%') OR";
			}
			$sql = substr($sql, 0, strlen($sql)-2) . '  )';
		}

		$pom = $this->db->query($sql);
		return $pom->result();
	}

}