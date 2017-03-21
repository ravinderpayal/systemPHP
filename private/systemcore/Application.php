<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(COREPATH."/Common.php");
abstract class Application{
    /**
     * Reference to the CI singleton
     *
     * @var	object
     */
    private static $instance;
    
    /**
     * Static Variable for storing output data released by different parts of Application
     * @since v20160515
     * @access private
     */

    private static $dataOut = array();
    
    /**
     * Class constructor
     *
     * @return	void
     */
    function __construct(){
            self::$instance = &$this;
            $this->output = load_class("Output",NULL,NULL);
            $this->loadHelper("sessionmanager");
            $this->setLanguage();
            if(OUT_MODE=="GUI_MODE"){
                header('Content-Type : application/html');
            }else{
                  header("Content-Type:text/json;charset=utf-8");
            }
    }
    function setLanguage(){
        $lang=$this->sessionmanager->is_exist("lang")?$_SESSION["lang"]:DEFAULT_LANG;
        $this->lang=load_class($lang,NULL,LANG_DIR.$lang);
    }
    /**
    *
    * This function can be used for loading Models at run time according to needs.
    * @param	string
    * @return	void	Exits if failed
    *
    */
    function loadModel($model){
            $this->$model = load_class($model,NULL,MODEL_DIR);
    }
    /**
     *
     * This function can be used for loading external/internal libraries at run time according to needs.
     * @param	string
     * @return	void	Exits if failed
     *
     */
    function loadLibrary($lib,$dir){
        $this->$lib = load_class($lib,NULL,LIBRARY_DIR.$dir);
    }
    /**
     *
     * This function can be used for loading external/internal helper libraries at run time according to needs.
     * @param	string
     * @return	void	Exits if failed
     *
     */
    function loadHelper($lib){
        $this->$lib = load_class($lib,NULL,"helper");
    }
    /**
    *
    *  This function can be used for loading Database classes at run time according to needs.
    * @param String $db Name of DB class that is to be loaded
    * @return Void Returns <b>Void</b> or <b>Exits</b> if failed
    *
    */
    function loadDB($db){
            $this->$db = load_class($db,NULL,"database");
    }
    protected function check_auth($a){
        foreach ($a as $b){
            if($this->sessionmanager->is_exist($b)) continue;
            else unauthrisedReq();
        }
    }

    /**
     *
     * Function for Halting the execution if any high severity error occurs
     * @since v20160515
     * @version v20160515
     *
     */
    public function halt($m = ""){
        self::$dataOut["out"] = OUT::SUDDEN_HALT;
        self::$dataOut["data"] ["message"] = $m;
        set_status_header(500);
        $this->output->error(500/*"SUDDEN-EXIT"*/, self::$dataOut);
        exit();//"No more code execution"
    }

    /**
     *
     * Function for Halting if improper/incomplete content is supplied
     * @since v20160515
     * @version v20160515
     *
     */
    public function close($m = ""){
        self::$dataOut["out"] = OUT::SUDDEN_HALT;
        self::$dataOut["data"] ["message"] = $m;
        set_status_header(200);
        die($m);//"No more code execution"
    }
   public function errorClose($c){
        $this->close("{\"error\":\"".$this->lang->loadError($c)."\",\"code\":$c,\"success\":false}");
    }
    /**
     *
     * Function for Halting if improper/incomplete content is supplied
     * @since v20170211
     * @version v20170211
     *
     */
    public function notFound(){
        set_status_header(404);
        $this->output->error("404");
        exit;
    }

    /**
    *
    * @Description : Return the extended instance(Singleton) of the Application(Whole ,AS all other classes have extended this class)
    * @Uses : Model Class and Helper Class for communication with other models
    * @Version : 20160515
    * @PreviousVersion : N/A
    * @static
    * @return	object
    *
    */
    public static function &get_instance(){
            return self::$instance;
    }
}

    /**
    *
    * @Description : Global Alias of Application::get_instance() 
    * @Uses : Model Class for communication with other models
    * @Version : 20160515
    * @PreviousVersion : N/A
    * @DependsOn : Application::get_instance()
    * @return	object
    *
    */
    function &get_instance(){
            return Application::get_instance();
    }