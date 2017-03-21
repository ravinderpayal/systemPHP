<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
* @Description Abstarct Class for Database Handling Classes
* @version v20160515
* @since v20160515
* @copyright (c) 2016, Ravinder <http://www.ravinderpayal.com>
*
*/
abstract class Database{
    /**
     * Function for halting the complete script execution if any serious Runtime Database related error occurs
     * @access protected
     * @since v20160515
     */
    function halt($e){
         if (defined("MODE_DEBUG")){
                  show_exception($e);
         }
         else{
                  get_instance()->halt("Internal Server Error. DBMSs are not working properly.Please Try Later!");
         }
    }
}