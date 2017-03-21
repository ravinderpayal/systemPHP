<?php
defined("BASEPATH") or exit("not for you");

abstract class Controller extends Application{
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	 
	function __construct($p = array()){
		parent::__construct($p);
	}

}