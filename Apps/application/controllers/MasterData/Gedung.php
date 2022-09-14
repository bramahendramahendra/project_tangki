<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gedung extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('MasterData_m/Gedung_m');
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
        $system['dataView']['submenu'] = 3;
        $system['dataView']['titlePage'] = 'Gedung';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Master Data',
            'Gedung',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'Gedung',
        );
        $system['dataView']['urlList'] = site_url('MasterData/Gedung/list');
        $system['dataView']['urlForm'] = site_url('MasterData/Gedung/form');
        $system['dataView']['urlDelete'] = site_url('MasterData/Gedung/delete');

        $system['dataList'] = $this->Gedung_m->getData()->result();
		$this->load->view('masterData_v/gedung_v/list_v', $system);
	}

    function form($pages="create", $id="")
    {
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 5;
        $system['dataView']['submenu'] = 3;
        $system['dataView']['titlePage'] = ($pages=="update"?"Update Gedung":'Tambah Gedung');
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Master Data',
            'Gedung',
            ($pages=="update"?"Update Gedung":'Tambah Gedung'),
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
            "javascript:void(0)",
            site_url('MasterData/Gedung'),
        );
        $system['dataView']['subTitlePage'] = array(
            ($pages=="update"?"Update":'Tambah'),
            'Gedung',
        );
        $system['dataView']['pages']    = $pages;
        $system['dataView']['urlBack'] = site_url('MasterData/Gedung/list');
        $system['dataView']['urlCreate'] = site_url('MasterData/Gedung/create');
        $system['dataView']['urlUpdate'] = site_url('MasterData/Gedung/update');
        $system['dataView']['urlAutocompleteFacilityManagement'] = site_url('MasterData/Gedung/autocompleteFacilityManagement');
        $system['dataView']['urlAutocompleteJenisTangki'] = site_url('MasterData/Gedung/autocompleteJenisTangki');

        if($pages == "update") {
            if($id!="") {
                $dataWhere = array(
                    'a.id' => $id,
                );
                // var_dump($dataWhere);die;
                $response = $this->Gedung_m->getData($dataWhere)->result();
                // var_dump($response);die;
                $system['dataUpdate'] = array(
                    'id' => $response[0]->id,
                    'id_facility_management' => $response[0]->id_facility_management,
                    'facility_management' => $response[0]->facility_management,
                    'gedung' => $response[0]->gedung,
                    'lokasi' => $response[0]->lokasi,
                    'jenis_tangki' => $response[0]->jenis_tangki,
                );
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
                redirect('MasterData/Gedung/list');	
            }
           
        }
        $this->load->view('masterData_v/gedung_v/form_v', $system);
    }

    function autocompleteFacilityManagement()
    {
        $this->load->model('MasterData_m/FacilityManagement_m');
        $data = $this->FacilityManagement_m->getData()->result();
        
        echo json_encode($data);
    }

    function autocompleteJenisTangki()
    {
        $this->load->model('MasterData_m/JenisTangki_m');
        $data = $this->JenisTangki_m->getData()->result();
        
        echo json_encode($data);
    }

    function create()
    {
        if($this->input->post('save') == 'save') {
            $this->form_validation->set_rules('facility_management', 'Facility Management', 'required');
            $this->form_validation->set_rules('gedung', 'Gedung', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
            $this->form_validation->set_rules('jenis_tangki', 'Jenis Tangki', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->model('MasterData_m/JenisTangki_m');
                $dataTemp = $this->JenisTangki_m->getData($this->input->post('jenis_tangki'))->result()[0];
                
                $currDateTime = date('Y-m-d H:i:s');
                $dataInsert = array(
                    "id_facility_management" => $this->input->post('facility_management'),
                    "gedung" => $this->input->post('gedung'),
                    "lokasi" => $this->input->post('lokasi'),
                    "jenis_tangki" => $dataTemp->jenis_tangki,
                    'created' => $currDateTime,
                    "updated" => $currDateTime,
                );
                $response = $this->Gedung_m->insertData($dataInsert);
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil disimpan.');	
                    unset($_POST);
                    unset($_GET);
                    redirect('MasterData/Gedung/list');	
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal disimpan.');		
                    redirect('MasterData/Gedung/form');	
                }
            } else {
                $this->session->set_flashdata('post',$_GET);
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');
                redirect('MasterData/Gedung/form');	
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            redirect('MasterData/Gedung/form');
        }
    }

    function update()
    {
        // echo "<pre>";var_dump($this->input->post());var_dump($this->input->get());echo "</pre>";
        // die;
        $id = $this->input->post('id');
        if($this->input->post('save') == 'save'){
            $this->form_validation->set_rules('id', 'ID', 'required');
            if($this->input->post('facility_management')!='') {
                $this->form_validation->set_rules('facility_management', 'Facility Management', 'required');
            } else {
                $this->form_validation->set_rules('old_facility_management', 'Facility Management', 'required');
            }   
            $this->form_validation->set_rules('gedung', 'Gedung', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
            if($this->input->post('jenis_tangki')!='') {
                $this->form_validation->set_rules('jenis_tangki', 'Jenis Tangki', 'required');
            } else {
                $this->form_validation->set_rules('old_jenis_tangki', 'Jenis Tangki', 'required');
            }
            if($this->form_validation->run() == TRUE){
                if($this->input->post('facility_management')!='') {
                    $temp_facility_management = $this->input->post('facility_management');
                } else {
                    $temp_facility_management = $this->input->post('old_facility_management');
                }
                if($this->input->post('jenis_tangki')!='') {
                    $this->load->model('MasterData_m/JenisTangki_m');
                    $dataTemp = $this->JenisTangki_m->getData($this->input->post('jenis_tangki'))->result()[0];
                    $temp_jenis_tangki = $dataTemp->jenis_tangki;
                } else {
                    $temp_jenis_tangki = $this->input->post('old_jenis_tangki');
                }
                
                $currDateTime = date('Y-m-d H:i:s');
                $dataWhere = array(
                    "id" => $this->input->post('id')
                );
                $dataUpdate = array(
                    "id_facility_management" => $temp_facility_management,
                    "gedung" => $this->input->post('gedung'),
                    "lokasi" => $this->input->post('lokasi'),
                    "jenis_tangki" => $temp_jenis_tangki,
                    "updated" => $currDateTime,
                );
                $response = $this->Gedung_m->updateData($dataUpdate,$dataWhere);
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil diupdate.');	
                    unset($_POST);
                    unset($_GET);
                    redirect('MasterData/Gedung/list');	
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal diupdate.');
                    redirect('MasterData/Gedung/form/update/'.$id);		
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
                redirect('MasterData/Gedung/form/update/'.$id);	
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            redirect('MasterData/Gedung/form/update/'.$id);	
            
        }
    }

    function delete()
    {
        if($this->input->get('pages') == 'delete'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            if($Validation == TRUE){
                $dataWhere = array(
                    "id" => $this->input->get('id')
                );
                $response = $this->Gedung_m->deleteData($dataWhere);
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil dihapus.');	
                    unset($_POST);
                    unset($_GET);
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal dihapus.');		
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
        }
    }
}
