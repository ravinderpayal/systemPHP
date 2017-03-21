<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Controller{
    function __construct(){
        parent::__construct(array("NO_SESSION"=>true));
        $this->check_auth(array("USER"));
        $this->loadDB("sql");
        $this->loadModel("posts");
        //$this->xyz();
    }
    public function main(){
        $data = $this->posts->getPost(500);
        $this->dataOut["out"] = OUT::RESPONSE_OK;
        $this->dataOut["data"] = $data;
        $this->output->tempelate("main",  $this->dataOut ,"");
    }
    private function xyz(){
        echo "i am called hello from xyz.....";
        $this->output->tempelate("main",  $this->dataOut ,"");
    }
}