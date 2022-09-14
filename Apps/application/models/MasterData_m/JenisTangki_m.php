<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisTangki_m extends CI_Model {
	function getData($id="")
	{
		if($id!="") $this->db->where('id', $id); 
		$this->db->order_by('updated', 'DESC');
        $query = $this->db->get('jenis_tangki');
        return $query;
	}

	function insertData($data)
	{
		return $this->db->insert('jenis_tangki', $data);
	}

	function updateData($data, $where)
	{
		return $this->db->update('jenis_tangki', $data, $where);
	}

	function deleteData($where)
	{
		return $this->db->delete('jenis_tangki',$where);
	}
}
