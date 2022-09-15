<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
        $system = array();
		$system['dataView'] = array();
		$system['dataView']['menu'] = 1;
        $system['dataView']['submenu'] = 0;
        $system['dataView']['titlePage'] = 'Home';
		$system['dataView']['breadcrumb'] = array(
            'Volume Control',
            'Home',
        );
        $system['dataView']['urlBreadcrumb'] = array(
            site_url('Home'),
        );
        echo "Dev";
		// $this->load->view('home_v', $system);
	}
}
