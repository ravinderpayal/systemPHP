<?php
/*
 * 
 * (c) Ravinder Payal <mail@ravinderpayal.com>
 * 
 * Loads our whole application into memory for execution
 *
 * @author Ravinder Payal<www.ravinderpayal.com>
 *
 */

require dirname(__FILE__)."/config.php";

/**
 * 
 * Main Application Loader
 * var  $controller:- The controller class which we use to initiate the whole module.
 * 
 */
function load($controller,$dependencies = array()){
	require(COREPATH."Application.php");
	require(COREPATH."Controller.php");
    require(COREPATH."Model.php");
    require(COREPATH."Helper.php");
    /**
    *
    *Thinking about lazy loading these three class, as i18n is not required in all applications. Mail me your suggestions.
    *
    */
    require(COREPATH."Language.php");
    require COREPATH .'Database.php';
    require COREPATH .'Output.php';
    if(file_exists(APPPATH."controllers/".$controller.".php")){
        require(APPPATH . "controllers/" . $controller . ".php");
        if(class_exists(ucfirst($controller))) {
            return new $controller();
        }
        else{
            badReq();
        }
    }
    else{
        badReq();
    }
}
function out($a){
    echo "<pre>$a</pre></br>";
}