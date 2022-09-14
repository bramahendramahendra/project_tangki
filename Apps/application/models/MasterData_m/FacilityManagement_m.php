<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacilityManagement_m extends CI_Model {
	function getData($id="")
	{
		if($id!="") $this->db->where('id', $id); 
		$this->db->order_by('updated', 'DESC');
        $query = $this->db->get('facility_management');
        return $query;
	}

	function insertData($data)
	{
		return $this->db->insert('facility_management', $data);
	}

	function updateData($data, $where)
	{
		return $this->db->update('facility_management', $data, $where);
	}

	function deleteData($where)
	{
		return $this->db->delete('facility_management',$where);
	}
}
