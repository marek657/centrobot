<?php 

class RankModel extends CI_Model
{
	function addNew($data)
	{
		$success = $this->db->insert('rank', $data);
		return $success;
	}

	function delete($id)
	{
		$success = $this->db->delete('rank', array('id' => $id));
		return $success;
	}

	function getRank($id_robtivity)
	{
		$query = $this->db->select('*')
							->from('rank')
							->where('id_robtivity', $id_robtivity)
							->get();
		return $query->result();
	}

	function updateRank($data)
	{
		$this->db->where('id', $data['id']);
		$success = $this->db->update('rank', $data);
		return $success;
	}

	function checkUserRank($id_user, $id_robtivity)
	{
		$query = $this->db->select('*')
							->from('rank_users')
							->where('id_robtivity', $id_robtivity)
							->where('id_user', $id_user)
							->get();

		if ($query->num_rows == 1)
		{
			return $query->result();
		} else {
			//return false;
		}
		
	}

	function addUserRank($data)
	{
		$success = $this->db->insert('rank_users', $data);
		return $success;
	}

	function updateUserRank($data)
	{
		$this->db->where('id', $data['id']);
		$success = $this->db->update('rank_users', $data);
		return $success;
	}


}