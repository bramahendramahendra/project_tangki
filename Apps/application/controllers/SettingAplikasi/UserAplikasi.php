<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAplikasi extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('SettingAplikasi_m/UserAplikasi_m');
    }

    function index()
    {
        $this->list();
    }

	function list()
	{
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 6;
        $system['dataView']['submenu'] = 1;
        $system['dataView']['titlePage'] = 'User Aplikasi';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Setting Aplikasi',
            'User Aplikasi',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Daftar',
            'User Aplikasi',
        );
        $system['dataView']['urlList'] = site_url('SettingAplikasi/UserAplikasi/list');
        $system['dataView']['urlForm'] = site_url('SettingAplikasi/UserAplikasi/form');
        $system['dataView']['urlDetail'] = site_url('SettingAplikasi/UserAplikasi/detail');
        $system['dataView']['urlDelete'] = site_url('SettingAplikasi/UserAplikasi/delete');

        $system['dataList'] = $this->UserAplikasi_m->getData()->result();
		$this->load->view('settingAplikasi_v/userAplikasi_v/list_v', $system);
	}

    function detail($id)
    {
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 6;
        $system['dataView']['submenu'] = 1;
        $system['dataView']['titlePage'] = 'User Aplikasi';
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Setting Aplikasi',
            'User Aplikasii',
            'Detail User Aplikasi',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
            "javascript:void(0)",
            site_url('SettingAplikasi/UserAplikasi'),
        );
        $system['dataView']['subTitlePage'] = array(
            'Detail',
            'User Aplikasii',
        );
        $system['dataView']['urlForm'] = site_url('SettingAplikasi/UserAplikasi/form');
        $system['dataView']['urlBack'] = site_url('SettingAplikasi/UserAplikasi/list');
        
        // echo $id_gedung;
        $dataWhere = array(
            'a.id' => $id,
        );
        $response = $this->UserAplikasi_m->getData($dataWhere)->result();
        $system['dataDetail'] = $response[0];
        // echo "<pre>";var_dump($response);echo "</pre>";
        // echo $id;
        $this->load->view('settingAplikasi_v/userAplikasi_v/detail_v', $system);
    }

    function form($pages="create", $id="")
    {
        $system = array();
		$system['dataView'] = array();
        $system['dataView']['menu'] = 6;
        $system['dataView']['submenu'] = 1;
        $system['dataView']['titlePage'] = ($pages=="update"?"Update User Aplikasi":'Tambah User Aplikasi');
        $system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Setting Aplikasi',
            'User Aplikasi',
            ($pages=="update"?"Update User Aplikasi":'Tambah User Aplikasi'),
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
            "javascript:void(0)",
            site_url('SettingAplikasi/UserAplikasi'),
        );
        $system['dataView']['subTitlePage'] = array(
            ($pages=="update"?"Update":'Tambah'),
            'User Aplikasi',
        );
        $system['dataView']['pages']    = $pages;
        $system['dataView']['urlBack'] = site_url('SettingAplikasi/UserAplikasi/list');
        $system['dataView']['urlCreate'] = site_url('SettingAplikasi/UserAplikasi/create');
        $system['dataView']['urlUpdate'] = site_url('SettingAplikasi/UserAplikasi/update');
        $system['dataView']['urlAutocompleteUserRoles'] = site_url('SettingAplikasi/UserAplikasi/autocompleteUserRoles');
        $system['dataView']['urlAutocompleteFMGedung'] = site_url('SettingAplikasi/UserAplikasi/autocompleteFMGedung');
        // $system['dataView']['urlAutocompleteUserRole'] = site_url('SettingAplikasi/UserAplikasi/autocompleteUserRole');
       
        if($pages == "update") {
            if($id!="") {
                $dataWhere = array(
                    'a.id' => $id,
                );
                $response = $this->UserAplikasi_m->getData($dataWhere)->result();
                $system['dataUpdate'] = $response[0];
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
                redirect('SettingAplikasi/UserAplikasi/list');	
            }
           
        }
        $this->load->view('settingAplikasi_v/userAplikasi_v/form_v', $system);
    }

    function autocompleteUserRoles()
    {
        $data = $this->UserAplikasi_m->getDataUserRoles()->result();
        
        echo json_encode($data);
    }

    function autocompleteFMGedung()
    {
        $this->load->model('MasterData_m/DataTangki_m');
        $data = $this->DataTangki_m->getData()->result();
        
        echo json_encode($data);
    }

    function create()
    {
        // echo "<pre>";var_dump($this->input->post());var_dump($this->input->get());echo "</pre>";
        // die;
        if($this->input->post('save') == 'save') {
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('user_role', 'User Role', 'required');
            if($this->input->post('user_role') && $this->input->post('user_role')==3) {
                $this->form_validation->set_rules('fm_gedung', 'FM - Gedung', 'required');
            }
            if ($this->form_validation->run() == TRUE) {
                $currDateTime = date('Y-m-d H:i:s');
                $dataInsert = array(
                    "nik" => $this->input->post('nik'),
                    "nama" => $this->input->post('nama'),
                    "level_id" => $this->input->post('user_role'),
                    "id_gedung" => $this->input->post('fm_gedung'),
                    'created' => $currDateTime,
                    "updated" => $currDateTime,
                );
                $response = $this->UserAplikasi_m->insertData($dataInsert);
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil disimpan.');	
                    unset($_POST);
                    unset($_GET);
                    redirect('SettingAplikasi/UserAplikasi/list');	
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal disimpan.');		
                    redirect('SettingAplikasi/UserAplikasi/form');	
                }
            } else {
                $this->session->set_flashdata('post',$_GET);
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');
                redirect('SettingAplikasi/UserAplikasi/form');	
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            redirect('SettingAplikasi/UserAplikasi/form');
        }
    }

    public function upload_avatar()
    {
        if ($this->input->method() === 'post') {
            // the user id contain dot, so we must remove it
            $file_name = str_replace('.','',$data['current_user']->id);
            $config['upload_path']          = FCPATH.'/upload/avatar/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $config['max_size']             = 1024; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('avatar')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $uploaded_data = $this->upload->data();

                $new_data = [
                    'id' => $data['current_user']->id,
                    'avatar' => $uploaded_data['file_name'],
                ];
        
                if ($this->profile_model->update($new_data)) {
                    $this->session->set_flashdata('message', 'Avatar updated!');
                    redirect(site_url('admin/setting'));
                }
            }
        }

        $this->load->view('admin/setting_upload_avatar.php', $data);
    }

    function update()
    {
        // echo "<pre>";var_dump($this->input->post());var_dump($this->input->get());echo "</pre>";
        // die;
        $id = $this->input->post('id');
        if($this->input->post('save') == 'save'){
            $this->form_validation->set_rules('id', 'ID', 'required');
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            if($this->input->post('user_role')!='') {
                $this->form_validation->set_rules('user_role', 'User Role', 'required');
                $temp_validation = $this->input->post('user_role');
            } else {
                $this->form_validation->set_rules('old_user_role', 'User Role', 'required');
                $temp_validation = $this->input->post('old_user_role');
            }
            if($temp_validation == 3) {
                if($this->input->post('fm_gedung')!='') {
                    $this->form_validation->set_rules('fm_gedung', 'FM - Gedung', 'required');
                } else {
                    $this->form_validation->set_rules('old_fm_gedung', 'FM - Gedung', 'required');
                }
            }
            if($this->form_validation->run() == TRUE){
                if($this->input->post('user_role')!='') {
                    $temp_user_role = $this->input->post('user_role');
                } else {
                    $temp_user_role = $this->input->post('old_user_role');
                }
                if($this->input->post('fm_gedung')!='') {
                    $temp_fm_gedung = $this->input->post('fm_gedung');
                } else {
                    $temp_fm_gedung = $this->input->post('old_fm_gedung');
                }

                $currDateTime = date('Y-m-d H:i:s');
                $dataWhere = array(
                    "id" => $id
                );
                $dataUpdate = array(
                    "nik" => $this->input->post('nik'),
                    "nama" => $this->input->post('nama'),
                    "level_id" => $temp_user_role,
                    "id_gedung" => $temp_fm_gedung,
                    "updated" => $currDateTime,
                );
                $response = $this->UserAplikasi_m->updateData($dataUpdate,$dataWhere);
                if($response == TRUE) {
                    $this->session->set_flashdata('success', '<strong>Sukses.</strong> Data Berhasil diupdate.');	
                    unset($_POST);
                    unset($_GET);
                    redirect('SettingAplikasi/UserAplikasi/list');	
                } else {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal diupdate.');
                    redirect('SettingAplikasi/UserAplikasi/form/update/'.$id);		
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
                redirect('SettingAplikasi/UserAplikasi/form/update/'.$id);	
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
            redirect('SettingAplikasi/UserAplikasi/form/update/'.$id);	
            
        }
    }

    function delete()
    {
        if($this->input->get('pages') == 'delete'){
            $Validation = TRUE;
            $Validation = $this->formvalidation_libs->setRules($this->input->get('id'), $Validation);
            if($Validation == TRUE){
               
                $this->load->model('FacilityManagement_m');
                $dataWhere = array(
                    'id_gedung' => $this->input->get('id'),
                );
                $response = $this->FacilityManagement_m->getData($dataWhere)->result();
                if(count($response)>0) {
                    $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Data Gagal dihapus. Terdapat data Gedung pada Facility Management. Pastikan hapus Facility Management tersebut atau uabh ke Data Gedung yang lain.');		
                } else {
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
                }
            } else {
                $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Pastikan data tidak boleh kosong.');		
            }
        } else {
            $this->session->set_flashdata('danger', '<strong>Gagal !!</strong> Terjadi kesalahan pada sistem.');		
        }
    }
}
