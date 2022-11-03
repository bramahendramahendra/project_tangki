<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApproveOrder extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('ApproveOrder_m');
    }

	function index()
	{
        $this->list();
	}

    function list()
	{
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 4;
        $system['dataView']['submenu'] = 0;
        $system['dataView']['titlePage'] = 'Approval Order';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Approval Order',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'Approval Order',
        );
        $system['dataView']['urlList'] = site_url('ApproveOrder/list');
        $system['dataView']['urlApprove'] = site_url('ApproveOrder/form/1');
        $system['dataView']['urlReject'] = site_url('ApproveOrder/form/2');

        $system['dataList'] = $this->ApproveOrder_m->getData()->result();
        // echo "<pre>";var_dump($system['dataList']);echo "</pre>";

        $this->load->view('approveOrder_v/list_v', $system);
    }

    function detail($id_gedung)
    {
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 4;
        $system['dataView']['submenu'] = 0;
        $system['dataView']['titlePage'] = 'Approval Order';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Approval Order',
            'Detail Approval Order',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
            site_url('ApproveOrder'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Detail',
            'Approval Order',
            'Data',
            'Bahan Bakar',
        );
        $system['dataView']['urlForm'] = site_url('ApproveOrder/form');
        $system['dataView']['urlBack'] = site_url('ApproveOrder/list');
        
        // echo $id_gedung;
        $dataWhere = array(
            'c.id' => $id_gedung,
        );
        $response = $this->ApproveOrder_m->getData($dataWhere)->result();
        $system['dataDetail'] = $response[0];
        // echo "<pre>";var_dump($response);echo "</pre>";
        // echo $id;
        $this->load->view('approveOrder_v/detail_v', $system);
    }

    function form()
    // function form($status, $id_gedung)
    {
        echo"
        // keterangan $status 
        // 1 = Approve / Diterima
        // 2 = Reject / Ditolak
        $system = array();
        $system['dataView']['titlePage'] = "Apprval Catatan";
        // $system['dataView']['pages']    = $pages;
        $system['dataView']['urlUpdate'] = site_url('ApproveOrder/update');
        // echo $status."<br>";
        // echo $id_gedung;
        // echo "<pre>"; var_dump($this->input->get()); echo "</pre>";die;
        $dataWhere = array(
            'c.id' => $id_gedung,
        );
        $response = $this->ApproveOrder_m->getData($dataWhere)->result()[0];
        // echo "<pre>";var_dump($response);echo "</pre>";die;
        // Rumus Tangki 
        // $jumlahTangkiVolume = $this->libs->rumusTangkiVolume($response->panjang, $response->lebar, $response->tinggi);
        // $jumlahTangkiUse = $this->libs->rumusTangkiUse($jumlahTangkiVolume, 1000);
        // $jumlahTangkiSisa = $this->libs->rumusTangkiSisa($jumlahTangkiUse, $response->kapasitas_bahan_bakar);
        // $persentaseUse = $this->libs->rumusPersentaseTangki($jumlahTangkiUse,$response->kapasitas_bahan_bakar);
        // $persentaseSisa = $this->libs->rumusPersentaseTangki($jumlahTangkiSisa,$response->kapasitas_bahan_bakar);
        // var_dump(array($jumlahTangkiVolume,$response->panjang, $response->lebar, $response->tinggi)); die;

        $system['dataCreate'] = array(
            'id' => $response->id,
            'id_facility_management' => $response->id_facility_management,
            'id_gedung' => $response->id_gedung,
            // 'kapasitas_bahan_bakar' => $response->kapasitas_bahan_bakar,
            // 'volume_tangki_bahan_bakar' => $jumlahTangkiVolume,
            // 'jumlah_use_bahan_bakar' => $jumlahTangkiUse,
            // 'jumlah_sisa_bahan_bakar' => $jumlahTangkiSisa,
            // 'persentase_use_bahan_bakar' => $persentaseUse,
            // 'persentase_sisa_bahan_bakar' => $persentaseSisa,
            'status' => $response->status,
        );
        // echo "<pre>"; var_dump($system['dataCreate']); echo "</pre>"; die;
        $this->load->view('approveOrder_v/form_v', $system);
    }

    function update()
    {
        echo "<pre>"; var_dump($this->input->get()); echo "</pre>"; die;
        if($this->input->get('save') == 'save'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id_gedung'), $Validation);
            $Validation = $this->formvalidation_libs->setRules($this->input->get('status'), $Validation);
            if($Validation == TRUE){
                $currDateTime = date('Y-m-d H:i:s');
                $dataWhere = array(
                    "id" => $this->input->get('id')
                );
                $dataUpdate = array(
                    "kapasitas_bahan_bakar" => $this->input->get('kapasitas_bahan_bakar'),
                    "updated" => $currDateTime,
                );
                $response = $this->ApproveOrder_m->updateData($dataUpdate,$dataWhere);
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
