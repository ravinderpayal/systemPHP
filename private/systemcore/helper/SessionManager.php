<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SessionManager extends Helper{
    public function __construct() {
        session_start();
    }
    public function is_exist($a){
        return isset($_SESSION[SESSION_PREFIX.$a]);
    }

    public function add($a,$b){
        $_SESSION[SESSION_PREFIX.$a]=$b;
    }
    public function  addCookies($a,$b){
        setcookie($a, $b, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
    public function sessionKey(){
        return session_id();
    }
    public function delete(){
        session_destroy();
    }
    public function value($k){
        if(!isset($_SESSION[SESSION_PREFIX.$k]))
            $this->close("SESSION_NOT_DEFINED->".__LINE__);
        return $_SESSION[SESSION_PREFIX.$k];
    }
}