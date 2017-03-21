<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * (C) Ravinder - <http://www.ravinderpayal.com>
 */
abstract class Language {

    /**
     * Class constructor
     *
     * @return	void
     */
    protected  $lang=false;
    public function __construct()
    {
    }
    public $general=false;
    public function loadGeneral(){
        include_once(APPPATH."/language/".$this->lang."/general.php");
    }

    private $error=false;

    /**
     * Load Error Array with Number/Error Code mapping;
     */
    public function loadError($e){
        if(!$this->error)$this->error=require(APPPATH.LANG_DIR.$this->lang."/dictionary/error.php");
        return $this->error[$e];
    }

    public $rare=false;
    public function rare(){

    }
    // --------------------------------------------------------------------

    /**
     * __get magic
     *
     * Allows languages to access all loaded classes by Controller using the same
     * syntax as controllers.
     *	@example **$this->otherModel->do();**
     * @param	string	$key
     */
    public function __get($key)
    {
        return get_instance()->$key;
    }

}