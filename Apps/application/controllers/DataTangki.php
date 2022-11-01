<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTangki extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('DataTangki_m');
    }

	function index()
	{
        $this->list();
	}

    function list()
	{
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 3;
        $system['dataView']['submenu'] = 0;
        $system['dataView']['titlePage'] = 'Data Tangki';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Data Tangki',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'Data Tangki',
        );
        $system['dataView']['urlList'] = site_url('DataTangki/list');
        $system['dataView']['urlDetail'] = site_url('DataTangki/detail');

        $system['dataList'] = $this->DataTangki_m->getData()->result();
        // echo "<pre>";var_dump($system['dataList']);echo "</pre>";

        $this->load->view('dataTangki_v/list_v', $system);
    }

    function detail($id_gedung)
    {
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 3;
        $system['dataView']['submenu'] = 0;
        $system['dataView']['titlePage'] = 'Data Tangki';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Data Tangki',
            'Detail Data Tangki',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
            site_url('DataTangki'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Detail',
            'Data Tangki',
            'Data',
            'Bahan Bakar',
        );
        $system['dataView']['urlFormRequest'] = site_url('DataTangki/formRequest');
        $system['dataView']['urlBack'] = site_url('DataTangki/list');
        
        // echo $id_gedung;
        $dataWhere = array(
            'c.id' => $id_gedung,
        );
        $response = $this->DataTangki_m->getData($dataWhere)->result();
        $system['dataDetail'] = $response[0];
        // echo "<pre>";var_dump($response);echo "</pre>";
        // echo $id;
        $this->load->view('dataTangki_v/detail_v', $system);
    }

    function formRequest()
    {
        $system = array();
        $system['dataView']['titlePage'] = "Request Bahan Bakar";
        // $system['dataView']['pages']    = $pages;
        $system['dataView']['urlCreate'] = site_url('DataTangki/create');
       
        $dataWhere = array(
            'c.id' => $this->input->get('id_gedung'),
        );
        $response = $this->DataTangki_m->getData($dataWhere)->result()[0];
        // echo "<pre>";var_dump($response);echo "</pre>";die;
        // Rumus Tangki 
        $jumlahTangkiVolume = $this->libs->rumusTangkiVolume($response->panjang, $response->lebar, $response->tinggi);
        $jumlahTangkiUse = $this->libs->rumusTangkiUse($jumlahTangkiVolume, 1000);
        $jumlahTangkiSisa = $this->libs->rumusTangkiSisa($jumlahTangkiUse, $response->kapasitas_bahan_bakar);
        $persentaseUse = $this->libs->rumusPersentaseTangki($jumlahTangkiUse,$response->kapasitas_bahan_bakar);
        $persentaseSisa = $this->libs->rumusPersentaseTangki($jumlahTangkiSisa,$response->kapasitas_bahan_bakar);
        // var_dump(array($jumlahTangkiVolume,$response->panjang, $response->lebar, $response->tinggi)); die;

        $system['dataCreate'] = array(
            'id' => $response->id,
            'id_facility_management' => $response->id_facility_management,
            'id_gedung' => $response->id_gedung,
            'kapasitas_bahan_bakar' => $response->kapasitas_bahan_bakar,
            'volume_tangki_bahan_bakar' => $jumlahTangkiVolume,
            'jumlah_use_bahan_bakar' => $jumlahTangkiUse,
            'jumlah_sisa_bahan_bakar' => $jumlahTangkiSisa,
            'persentase_use_bahan_bakar' => $persentaseUse,
            'persentase_sisa_bahan_bakar' => $persentaseSisa,
        );
        // echo "<pre>"; var_dump($system['dataCreate']); echo "</pre>"; die;
        $this->load->view('dataTangki_v/formRequest_v', $system);
    }

    function create()
    {
        // echo "<pre>";
        // var_dump($this->input->get());
        // echo "</pre>";
        // die;
        if($this->input->get('save') == 'save'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id_gedung'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id_facility_management'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('kapasitas_bahan_bakar'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('sisa_bahan_bakar'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('dibutuhkan_bahan_bakar'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('request_bahan_bakar'), $Validation);
            if($Validation == TRUE){
                if($this->input->get('dibutuhkan_bahan_bakar') >= $this->input->get('request_bahan_bakar') ) {
                    $Validation = TRUE;
                } else {
                    $Validation = FALSE;
                }
                if($Validation == TRUE){
                    $request_bahan_bakar = $this->input->get('request_bahan_bakar');
                    $dibutuhkan_bahan_bakar = trim(preg_replace("/[^0-9]/", "", $this->input->get('dibutuhkan_bahan_bakar')));

                    // develop samapai sini untuk validasi request bahan bakar
                    // echo $request_bahan_bakar."<br>";
                    // echo $dibutuhkan_bahan_bakar; die;
                    // if()

                    // Validasi cek jumlah request bahan bakar dengan kapasitas bahan bakar pada tangki yang dibutuhkan 
                    if($dibutuhkan_bahan_bakar < $request_bahan_bakar) {
                        $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> JUmlah Reuest melebihi kapasitas bahan bakar yng kosong.');
                        $this->formRequest();
                    }

                    $currDateTime = date('Y-m-d H:i:s');
                    $dataInsert = array(
                        "id_data_tangki" => $this->input->get('id'),
                        "jumlah_request" => $request_bahan_bakar,
                        "status" => 1,
                        "request" => "ADMIN",
                        'requet_datetime' => $currDateTime,
                        'created' => $currDateTime,
                        "updated" => $currDateTime,
                    );
                    // var_dump($dataInsert);
                    $response = $this->DataTangki_m->insertData($dataInsert);
                    // var_dump($response);
                    // echo "tre1";die;
                    // $response = "";
                    if($response == TRUE) {
                        // echo 'tes';die;
                        $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil disimpan.');	
                        echo "<script>location.reload();</script>";
                        unset($_POST);
                        unset($_GET);
                    } else {
                        $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal disimpan.');
                        $this->formRequest();	
                        // redirect('DataTangki/form')	
                    }
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal disimpan. Pastikan request bahan bakar yang anda inputkan tidak melebihi tangki bahan bakar.');
                    $this->formRequest();	
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
                $this->formRequest();
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            $this->formRequest();
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
