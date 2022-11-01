<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libs {
    var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}

    function rumusTangkiVolume($panjang, $lebar, $tinggi)
    {
        $panjang = ($panjang&&$panjang!=""?$panjang:0);
        $lebar = ($lebar&&$lebar!=""?$lebar:0);
        $tinggi = ($tinggi&&$tinggi!=""?$tinggi:0);

        $volume = $panjang*$lebar*$tinggi;
        
        return $volume;
    }

    function rumusTangkiUse($volume, $pembagi)
    {
        $result = $volume / $pembagi;
        
        return $result;
    }

    function rumusTangkiSisa($jumlahUse, $kapasitas)
    {
        $result = $kapasitas-$jumlahUse;
        
        return $result;
    }

    function rumusPersentaseTangki($jumlah, $total)
    {
        $result = $jumlah/$total*100;
        
        return $result;
    }
}