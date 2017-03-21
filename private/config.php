<?php
/**
 * 
 * @author Ravinder Payal <mail@ravinderpayal.com>
 * @since v20160515
 * @version vCONFIG20170208
 * 
 */

/**
 * Constant for telling the System that the Application is running in Debug Mode
 */
define("MODE_DEBUG",true);


/**
*System specific contants
*/
define("DEFAULT_LANG","hi");
define("BASEPATH",dirname(__FILE__)."/");
define("BASE_SERVER_DIR",dirname(__DIR__)."/");
define("APPPATH",BASEPATH."application/");
define("COREPATH",BASEPATH."systemcore/");
define("MODEL_DIR","models");
define("UPLOAD_DIR_PUB",BASE_SERVER_DIR."public/files/");
define("LIBRARY_DIR","lib/");
define("LANG_DIR","languages/");
define("SQL_HOST","127.0.0.1");
define("SQL_DB","SystemPHP");
define("SQL_USER","root");
define("SQL_PASSWORD","root");

/**
*Application specific constants
*/
define("SESSION_TOKEN","PHPsession");
define("SESSION_ID","PHPsessionUserID");
define("SESSION_ADMIN","PHPsessionAdminLoggedIn");
define("SESSION_SUBADMIN","PHPsessionSubAdminLoggedIn");
define("SESSION_PRIV_USER","PHPsessionPrivUserLoggedIn");
define("SESSION_USER","PHPsessionUserLoggedIn");
define("SESSION_PREFIX","system");
define("COOKIES_TOKEN","PHPcookie");
/**
*Application specific GlobalVar.//From PHP 7, we have functionality for contants arrays similar to define(...,...). So, we will move to that in upcoming release.
*/
class GlobalVar{
    static public $SG_session_account_level = array(1 => SESSION_ADMIN,2=>SESSION_SUBADMIN,3=>SESSION_PRIV_USER,4=>SESSION_USER );
}
require COREPATH."constants/OUT.php";