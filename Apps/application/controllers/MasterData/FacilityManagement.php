<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacilityManagement extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('MasterData_m/FacilityManagement_m');
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
        $system['dataView']['submenu'] = 2;
        $system['dataView']['titlePage'] = 'Facility Management';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Master Data',
            'Facility Management',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'Facility Management',
        );
        $system['dataView']['urlList'] = site_url('MasterData/FacilityManagement/list');
        $system['dataView']['urlForm'] = site_url('MasterData/FacilityManagement/form');
        $system['dataView']['urlDelete'] = site_url('MasterData/FacilityManagement/delete');

        $system['dataList'] = $this->FacilityManagement_m->getData()->result();
		$this->load->view('masterData_v/facilityManagement_v/list_v', $system);
	}

    function form($pages="create")
    {
        $pages = $this->input->get('pages')?$this->input->get('pages'):$pages;

        $system = array();
        $system['dataView']['titlePage'] = $pages=="update"?"Update Facility Management":'Tambah Facility Management';
        $system['dataView']['pages']    = $pages;
        $system['dataView']['urlCreate'] = site_url('MasterData/FacilityManagement/create');
        $system['dataView']['urlUpdate'] = site_url('MasterData/FacilityManagement/update');
       
        if($pages == "update") {
            $id = $this->input->get('id');
            $response = $this->FacilityManagement_m->getData($id)->result();
            $system['dataUpdate'] = array(
                'id' => $response[0]->id,
                'facility_management' => $response[0]->facility_management,
            );
        }
        $this->load->view('masterData_v/facilityManagement_v/form_v', $system);
    }

    function create()
    {
        if($this->input->get('save') == 'save'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('facility_management'), $Validation);
            if($Validation == TRUE){
                $currDateTime = date('Y-m-d H:i:s');
                $dataInsert = array(
                    "facility_management" => $this->input->get('facility_management'),
                    'created' => $currDateTime,
                    "updated" => $currDateTime,
                );
                $response = $this->FacilityManagement_m->insertData($dataInsert);
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
            $Validation = $this->formvalidation_libs->setRules($this->input->get('facility_management'), $Validation);
            if($Validation == TRUE){
                $currDateTime = date('Y-m-d H:i:s');
                $dataWhere = array(
                    "id" => $this->input->get('id')
                );
                $dataUpdate = array(
                    "facility_management" => $this->input->get('facility_management'),
                    "updated" => $currDateTime,
                );
                $response = $this->FacilityManagement_m->updateData($dataUpdate,$dataWhere);
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

    function delete()
    {
        if($this->input->get('pages') == 'delete'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            if($Validation == TRUE){
                $this->load->model('MasterData_m/Gedung_m');
                $dataWhere = array(
                    'a.id_facility_management' => $this->input->get('id'),
                );
                $response = $this->Gedung_m->getData($dataWhere)->result();
                // echo "<pre>"; var_dump($response); echo "</pre>";die;
                if(count($response)>0) {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal dihapus. Terdapat data Facility Management pada Gedung. Pastikan hapus Gedung tersebut atau ubah Facility Management pada Gedung tersebut.');		
                } else {
                    $dataWhere = array(
                        "id" => $this->input->get('id')
                    );
                    $response = $this->FacilityManagement_m->deleteData($dataWhere);
                    if($response == TRUE) {
                        $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil dihapus.');	
                        unset($_POST);
                        unset($_GET);
                    } else {
                        $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal dihapus.');		
                    }
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
        }
    }
}
