<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTangki extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('MasterData_m/DataTangki_m');
    }

	function index()
	{
        $this->list();
	}

    function list()
	{
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 5;
        $system['dataView']['submenu'] = 1;
        $system['dataView']['titlePage'] = 'Data Tangki';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Master Data',
            'Data Tangki',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'Data Tangki',
        );
        $system['dataView']['urlList'] = site_url('MasterData/DataTangki/list');
        $system['dataView']['urlDetail'] = site_url('MasterData/DataTangki/detail');

        $system['dataList'] = $this->DataTangki_m->getData()->result();
        // echo "<pre>";var_dump($system['dataList'][0]);echo "</pre>";
		$this->load->view('masterData_v/dataTangki_v/list_v', $system);
    }

    function detail($id_gedung)
    {
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 5;
        $system['dataView']['submenu'] = 1;
        $system['dataView']['titlePage'] = 'Data Tangki';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Master Data',
            'Data Tangki',
            'Detail Data Tangki',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
            "javascript:void(0)",
            site_url('MasterData/DataTangki'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Detail',
            'Data Tangki',
            'Data',
            'Bahan Bakar',
        );
        $system['dataView']['urlForm'] = site_url('MasterData/DataTangki/form');
        $system['dataView']['urlBack'] = site_url('MasterData/DataTangki/list');
        
        // echo $id_gedung;
        $dataWhere = array(
            'c.id' => $id_gedung,
        );
        $response = $this->DataTangki_m->getData($dataWhere)->result();
        $system['dataDetail'] = $response[0];
        // echo "<pre>";var_dump($response);echo "</pre>";
        // echo $id;
        $this->load->view('masterData_v/dataTangki_v/detail_v', $system);
    }

    function form($pages="create")
    {
        
        $pages = $this->input->get('pages')?$this->input->get('pages'):$pages;
        // echo $pages;die;
        $system = array();
        $system['dataView']['titlePage'] = "Update Kapasitas Tangki";
        $system['dataView']['pages']    = $pages;
        $system['dataView']['urlCreate'] = site_url('MasterData/DataTangki/create');
        $system['dataView']['urlUpdate'] = site_url('MasterData/DataTangki/update');
       
        $dataWhere = array(
            'c.id' => $this->input->get('id_gedung'),
        );
        $response = $this->DataTangki_m->getData($dataWhere)->result()[0];
        // echo "<pre>";var_dump($response);echo "</pre>";die;
        $system['dataUpdate'] = array(
            'id' => $response->id,
            'id_gedung' => $this->input->get('id_gedung'),
            'kapasitas_bahan_bakar' => $response->kapasitas_bahan_bakar,
            // 'gedung' => $response->gedung,
            // 'facility_management' => $response->facility_management,
        );
        $this->load->view('masterData_v/dataTangki_v/form_v', $system);
    }

    function create()
    {
        if($this->input->get('save') == 'save'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id_gedung'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('kapasitas_bahan_bakar'), $Validation);
            if($Validation == TRUE){
                
                $currDateTime = date('Y-m-d H:i:s');
                $dataInsert = array(
                    "id_gedung" => $this->input->get('id_gedung'),
                    "kapasitas_bahan_bakar" => $this->input->get('kapasitas_bahan_bakar'),
                    'created' => $currDateTime,
                    "updated" => $currDateTime,
                );
                $response = $this->DataTangki_m->insertData($dataInsert);
                // echo "tre1";die;
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil disimpan.');	
                    echo "<script>location.reload();</script>";
                    unset($_POST);
                    unset($_GET);
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal disimpan.');
                    $this->form();		
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
                $this->form();
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            $this->form();
        }
    }

    function update()
    {
        if($this->input->get('save') == 'save'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id_gedung'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('kapasitas_bahan_bakar'), $Validation);
            if($Validation == TRUE){
                $currDateTime = date('Y-m-d H:i:s');
                $dataWhere = array(
                    "id" => $this->input->get('id')
                );
                $dataUpdate = array(
                    "kapasitas_bahan_bakar" => $this->input->get('kapasitas_bahan_bakar'),
                    "updated" => $currDateTime,
                );
                $response = $this->DataTangki_m->updateData($dataUpdate,$dataWhere);
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil diupdate.');	
                    
                    echo "<script>location.reload();</script>";
                    unset($_POST);
                    unset($_GET);
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal diupdate.');
                    $this->form('update');		
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
                $this->form('update');
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            $this->form('update');
            
        }
    }
}
