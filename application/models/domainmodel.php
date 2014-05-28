<?php 

class DomainModel extends CI_Model
{
	function addDomain($data)
	{
		$success = $this->db->insert('domain', $data);
		return $this->db->insert_id();
	}

	function addDomainNames($data)
	{
		foreach ($data as $key => $value) {
			$success = $this->db->insert('domain_names', $value);
		}
		
		return $success;
	}

	function getParrentDomainById($id)
	{
		$query = $this->db->select('id_parrent')
							->from('domain')
							->where('id', $id)
						   	->get();
		return $query->result();
	}

	function getDomain($id_lang)
	{
		$query = $this->db->select('*')
							->from('domain')
							->where('id_parrent !=', 0)
							->join('domain_names', 'domain_names.id_domain = domain.id')
							->like('domain_names.id_lang',$id_lang)
							->get();
		return $query->result();
	}

	function getParrentDomain($id_lang)
	{
		$query = $this->db->select('*')
							->from('domain')
							->where('id_parrent', 0)
							->join('domain_names', 'domain_names.id_domain = domain.id')
							->like('domain_names.id_lang',$id_lang)
							->get();
		return $query->result();
	}

	function getDomains()
	{
		$query = $this->db->select('*')
							->from('domain_names')
							->order_by('id_domain', 'asc')
							->join('language', 'domain_names.id_lang = language.id')
							->get();
		return $query->result();
	}

	function updateDomain($id_domain, $id_lang, $data)
	{
		$this->db->where('id_domain', $id_domain);
		$this->db->where('id_lang', $id_lang);
		$success = $this->db->update('domain_names', $data);
		return $success;
	}

}