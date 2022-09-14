<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('templateHeader')) {
	function templateHeader($dataView) {
		$ci =& get_instance();
        // echo "tes";die;
        $ci->load->view('templates/htmlStart_v', $dataView);  
        $ci->load->view('templates/header_v', $dataView);   
        $ci->load->view('templates/jqueryCoreJs_v', $dataView);   
        $ci->load->view('templates/bodyStart_v', $dataView);   
        $ci->load->view('templates/pageLoader_v', $dataView); 
        $ci->load->view('templates/overlay_v', $dataView); 
        $ci->load->view('templates/search_v', $dataView); 
        $ci->load->view('templates/navbar_v', $dataView); 
        $ci->load->view('templates/sidebarLeft_v', $dataView); 
        $ci->load->view('templates/sidebarRight_v', $dataView); 
	}

}

if (!function_exists('templateFooter')) {
	function templateFooter($dataView) {
		$ci =& get_instance();

        $ci->load->view('templates/footer_v', $dataView);   
        $ci->load->view('templates/bodyEnd_v', $dataView);   
        $ci->load->view('templates/htmlEnd_v', $dataView);  
	}
}