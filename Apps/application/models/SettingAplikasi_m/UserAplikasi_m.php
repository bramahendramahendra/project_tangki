<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAplikasi_m extends CI_Model {
	function getData($where=array())
	{
        $this->db->select('a.id, a.nik, a.nama, a.foto, b.level_id, b.role_desc, c.id as id_data_tangki, c.sisa_bahan_bakar, c.kapasitas_bahan_bakar, d.gedung, d.lokasi, d.jenis_tangki, e.facility_management' );
		if($where!="") $this->db->where($where);
		$this->db->order_by('a.updated', 'DESC');
        $this->db->join('user_roles b', 'a.level_id=b.level_id', 'left');
        $this->db->join('gedung d', 'a.id_gedung=d.id', 'left');
		$this->db->join('data_tangki c', 'd.id=c.id_gedung', 'left');
        $this->db->join('facility_management e', 'd.id_facility_management=e.id', 'left');
        $query = $this->db->get('user_application a');
        return $query;
	}

    function getDataUserRoles($id="")
	{
		if($id!="") $this->db->where('level_id', $id); 
		$this->db->order_by('level_id', 'DESC');
        $query = $this->db->get('user_roles');
        return $query;
	}

	function insertData($data)
	{
		return $this->db->insert('user_application', $data);
	}

	function updateData($data, $where)
	{
		return $this->db->update('user_application', $data, $where);
	}

	function deleteData($where)
	{
		return $this->db->delete('user_application',$where);
	}
}
