<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BuildPath_libs {
    var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}

    function checkPath($path)
    {
        if (empty($path)) {
			return FALSE;
		}
		$pathOrigin = 'uploads/' . $path;
		$pathTemp = FCPATH . $pathOrigin;
        $this->CI->load->library('BuildPath_libs');
        if (!is_dir($pathTemp))  $this->CI->buildpath_libs->createPath($pathTemp);
	
		return $pathOrigin;
    }

    function createPath($path)
    {
        return mkdir($path, 0777, TRUE);
    }
}