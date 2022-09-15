<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gedung_m extends CI_Model {
	function getData($where=array())
	{
		$this->db->select('a.id, a.id_facility_management, b.facility_management, a.gedung, a.lokasi, a.jenis_tangki, a.panjang, a.lebar');
		if($where!="") $this->db->where($where); 
		$this->db->order_by('a.updated', 'DESC');
		$this->db->join('facility_management b', 'a.id_facility_management=b.id', 'left');
        $query = $this->db->get('gedung a');
        return $query;
	}

	function insertData($data)
	{
		return $this->db->insert('gedung', $data);
	}

	function updateData($data, $where)
	{
		return $this->db->update('gedung', $data, $where);
	}

	function deleteData($where)
	{
		return $this->db->delete('gedung',$where);
	}
}
