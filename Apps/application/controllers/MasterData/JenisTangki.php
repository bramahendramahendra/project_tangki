<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisTangki extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('MasterData_m/JenisTangki_m');
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
        $system['dataView']['submenu'] = 4;
        $system['dataView']['titlePage'] = 'Jenis Tangki';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Master Data',
            'Jenis Tangki',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'Jenis Tangki',
        );
        $system['dataView']['urlList'] = site_url('MasterData/JenisTangki/list');
        $system['dataView']['urlForm'] = site_url('MasterData/JenisTangki/form');
        $system['dataView']['urlDelete'] = site_url('MasterData/JenisTangki/delete');

        $system['dataList'] = $this->JenisTangki_m->getData()->result();
		$this->load->view('masterData_v/jenisTangki_v/list_v', $system);
	}

    function form($pages="create")
    {
        $pages = $this->input->get('pages')?$this->input->get('pages'):$pages;

        $system = array();
        $system['dataView']['titlePage'] = $pages=="update"?"Update Jenis Tangki":'Tambah Jenis Tangki';
        $system['dataView']['pages']    = $pages;
        $system['dataView']['urlCreate'] = site_url('MasterData/JenisTangki/create');
        $system['dataView']['urlUpdate'] = site_url('MasterData/JenisTangki/update');
       
        if($pages == "update") {
            $id = $this->input->get('id');
            $response = $this->JenisTangki_m->getData($id)->result();
            $system['dataUpdate'] = array(
                'id' => $response[0]->id,
                'jenis_tangki' => $response[0]->jenis_tangki,
                'panjang' => $response[0]->panjang,
                'lebar' => $response[0]->lebar,
            );
        }
        $this->load->view('masterData_v/jenisTangki_v/form_v', $system);
    }

    function create()
    {
        
        if($this->input->get('save') == 'save'){
            // echo "sistem";die;
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('jenis_tangki'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('panjang'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('lebar'), $Validation);
            if($Validation == TRUE){
                $currDateTime = date('Y-m-d H:i:s');
                $dataInsert = array(
                    "jenis_tangki" => $this->input->get('jenis_tangki'),
                    "panjang" => $this->input->get('panjang'),
                    "lebar" => $this->input->get('lebar'),
                    'created' => $currDateTime,
                    "updated" => $currDateTime,
                );
                $response = $this->JenisTangki_m->insertData($dataInsert);
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
            // echo "teeasd";die;
            var_dump($this->input->get());
            var_dump($this->input->post());die;
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            $this->form();
        }
    }

    function update()
    {
        if($this->input->get('save') == 'save'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('jenis_tangki'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('panjang'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('lebar'), $Validation);
            if($Validation == TRUE){
                $currDateTime = date('Y-m-d H:i:s');
                $dataWhere = array(
                    "id" => $this->input->get('id')
                );
                $dataUpdate = array(
                    "jenis_tangki" => $this->input->get('jenis_tangki'),
                    "panjang" => $this->input->get('panjang'),
                    "lebar" => $this->input->get('lebar'),
                    "updated" => $currDateTime,
                );
                $response = $this->JenisTangki_m->updateData($dataUpdate,$dataWhere);
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
                $dataWhere = array(
                    "id" => $this->input->get('id')
                );
                $response = $this->JenisTangki_m->deleteData($dataWhere);
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
