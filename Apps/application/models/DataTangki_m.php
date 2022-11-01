<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTangki_m extends CI_Model {
	function getData($where=array())
	{
		$this->db->select('a.id, b.id as id_facility_management, c.id as id_gedung, b.facility_management, c.gedung, c.lokasi, c.jenis_tangki, a.sisa_bahan_bakar, a.kapasitas_bahan_bakar, c.panjang, c.lebar, d.tinggi');
		$this->db->select('e.*');
		if($where!="") $this->db->where($where); 
		$this->db->join('data_tangki a', 'a.id_gedung=c.id', 'left');
		$this->db->join('facility_management b', 'c.id_facility_management=b.id', 'left');
		$this->db->join('monitoring d', 'c.code_sensor=d.code_sensor', 'left');
		$this->db->join('(Select a.*, b.nama_status from request_data_tangki as a LEFT JOIN status as b ON a.status = b.kode_status where a.status = 1) e', 'e.id_data_tangki=a.id', 'left');

		$this->db->order_by('a.updated', 'DESC');
        // $query = $this->db->get('data_tangki a');
		$query = $this->db->get('gedung c');
		// echo $this->db->last_query();die;
        return $query;
	}

	function insertData($data)
	{
		return $this->db->insert('request_data_tangki', $data);
	}

	function updateData($data, $where)
	{
		return $this->db->update('request_data_tangki', $data, $where);
	}

}