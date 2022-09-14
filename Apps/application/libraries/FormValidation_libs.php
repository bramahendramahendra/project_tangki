<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormValidation_libs {
    function setRules($input,$validation=TRUE)
    {
        if($validation) { 
            if($input=="") {
                $validation = false;
            }
        } else {
            $validation = false;
        }
        
        return $validation;
    }
}