<?php 

class robtiviesAuthorModel extends CI_Model
{
	function addAuthor($data)
	{
		$success = $this->db->insert('robtivies_authors', $data);
		return $success;
	}

	function deleteAuthor($id_robtivity, $id_author)
	{
		$success = $this->db->delete('robtivies_authors', array('id_author' => $id_author, 'id_robtivity' => $id_robtivity));
		return $success;
	}

	function getAuthor($id_robtivity, $id_author)
	{
		$this->db->where('id_robtivity', $id_robtivity);
		$this->db->where('id_author', $id_author);
		$query = $this->db->get('robtivies_authors');
		return $query->result();
	}

	function checkAuthor($id_robtivity, $id_author)
	{

		$this->db->where('id_robtivity', $id_robtivity);
		$this->db->where('id_author', $id_author);
		$query = $this->db->get('robtivies_authors');

		if ($query->num_rows == 1)
		{
			return true;
		} else {
			return false;
		}
	}

	function getRobtivityAuthors($id_robtivity)
	{
		$query = $this->db->select('*')
							->from('robtivies_authors')
							->where('id_robtivity', $id_robtivity)
							->join('users', 'users.id = robtivies_authors.id_author')
						   	->get();
		return $query->result();
	}


}