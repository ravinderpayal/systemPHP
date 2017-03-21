<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Helper Class inspired from CodeIgniter
 *
 */
class Helper {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access all loaded classes by Controller using the same
	 * syntax as controllers.
	 *	@example **$this->otherModel->do();**
	 * @param	string	$key
	 */
	public function __get($key)
	{
		return get_instance()->$key;
	}
    /**
     * __get magic
     *
     * Allows models to access all public functions of loaded classes    by Controller using the same
     * syntax as controllers.
     *	@example **$this->otherModel->do();**
     * @param	string	$key
     * @param  array $arg
     */
    public function __call($key,$arg)
    {

        return call_user_func_array( array(get_instance(),$key),$arg);
    }
}
