<?php
defined("BASEPATH") OR exit("No Direct Access");
class Output{
    function __construct() {
    }
    public function tempelate($a,$b = array(),$c = ""){
        extract($b);
        if (OUT_MODE=="GUI_MODE") {
            include(APPPATH."tempelate/html/$c$a.php");
        }else {
            include(APPPATH."tempelate/json/$c$a.php");
        }
    }
    public function error($a,$b=array()){
            extract($b);
            if (OUT_MODE=="GUI_MODE") {
                include(APPPATH."tempelate/html/error/$a.php");
            } else {
                include(APPPATH. "tempelate/json/error/$a.php");
            }
    }
    public function custom($a,$b){
            extract($b);
            if (OUT_MODE=="GUI_MODE") {
            include("0/view/gui/$a.php");
        } else {
            include(DOC_ROOT . "0/json/$a.php");
        }
    }	
}