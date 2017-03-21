<?php
/*
 * 
 * (c) Ravinder Payal <mail@ravinderpayal.com>
 * 
 * Exposes our application to outside world
 *
 * @author Ravinder Payal<www.ravinderpayal.com>
 *
 */
define("OUT_MODE","GUI_MODE");
ini_set('xdebug.max_nesting_level', 1000);
/****Script to initiate the System**********/
function badReq($f="0"){
    header("HTTP/1.1 400 BAD REQUEST");
    die("400–Bad Request -".$f);

}
function unauthrisedReq(){
    header("HTTP/1.1 401 Unauthorised Request");
    OUT_MODE=="GUI_MODE"?die("401–Unauthrised Request"):die("{\"out\":\"401–Unauthorised Request\",\"out_code\":".OUT::REQ_UNAUTHORISED."}");
}

$path=array("","main","main");
if(isset($_SERVER['PATH_INFO']) and preg_match('/[a-z 0-9~%.:_\-\/]+$/iu', $_SERVER['PATH_INFO'])) {
    if (!ctype_alnum(trim($_SERVER['PATH_INFO'], "/")) and !preg_match("[/]",$_SERVER['PATH_INFO'])) {
        badReq(__FILE__." : ".__LINE__);
    }
    else{
        $path= explode('/',rtrim($_SERVER['PATH_INFO'],"/") );
    }
}
else{
    badReq(__FILE__." : ".__LINE__);
}
define("public_dir","public/");
define("private_dir","private/");
//isset($_GET["json"])? define("OUT_MODE","JSON_MODE"): define("OUT_MODE","GUI_MODE");

require private_dir."load.php";
if(isset($path[2])){
    $method=$path[2];
    $param = array_slice($path, 3);
    $controller=load($path[1]);
    if(method_exists($controller,$method))
        call_user_func_array(array($controller,$method),$param);
    else{
        $controller->output->error("404");
    }
}
else{
    load($path[1])->main();
}