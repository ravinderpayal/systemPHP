<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Controller{
    function __construct(){
        parent::__construct();
        $this->check_auth(array(SESSION_ID));
        $this->loadDB("sql");
        $this->loadModel("user");
        $this->loadModel("testmodel");
    }
    public function main(){
    }
    public function post(){
        $this->check_auth(array(SESSION_ADMIN));        
        isset($_POST["name"]) || $this->close("Name required");
        isset($_POST["desc"]) || $this->close("Description Required");
        isset($_POST["level"]) || $this->close("Level Required");
        isset($_POST["time"]) || $this->close("Time Required");
        isset($_POST["type"]) || $this->close("Type Required");
        isset($_POST["questions"]) || $this->close("Questions Required");
        $test=$this->testmodel->add(array("test_name"=>$_POST["name"],"test_desc"=>$_POST["desc"],"test_level"=>$_POST["level"],"author"=>$this->sessionmanager->value(SESSION_ID),"test_time"=>$_POST["time"],"publish_time"=>date("Y-m-d H:G:s",time())));
        if(!$test){
             $this->close( "{\"error\":\"Failed Saving Test, Please Retry\",\"out\":".OUT::DATABASE_FAILURE."}");
         }
         else{
             
                  $questions=  json_decode($_POST["questions"]);
                  foreach($questions as  $qs){
                        $answer=$qs->type=='1'?$qs->answer:$qs->answer->choice;
                        $insert=array("q_srno"=>$qs->srNo,"q_type"=>$qs->type,"test_id"=>$test,"q_score"=>$qs->score,"q_answer"=>$answer);
                       $question=$this->testmodel->addQuestion($insert);
                       if($question){
                           if($qs->type=='2'){
                                   $this->testmodel->addChoice(array("c_label"=>"A","c_title"=>$qs->answer->choiceAdef,"q_id"=>$question));
                                   $this->testmodel->addChoice(array("c_label"=>"B","c_title"=>$qs->answer->choiceBdef,"q_id"=>$question));
                                   $this->testmodel->addChoice(array("c_label"=>"C","c_title"=>$qs->answer->choiceCdef,"q_id"=>$question));
                                   $this->testmodel->addChoice(array("c_label"=>"D","c_title"=>$qs->answer->choiceDdef,"q_id"=>$question));
                           }
                           
                       }
                       else{
                             $this->close( "{\"error\":\"Failed to add questions to Test, Please Retry\",\"out\":".OUT::DATABASE_FAILURE."}");                           
                       }
                  }
                  echo "{\"out\":{\"article\":".$test."},\"success\":true}";
         }
    }
    public function getlist($a=null){
        $art=$this->testmodel->getlist();
        $out=json_encode($art);
        echo "{\"out\":{\"tests\":$out},\"success\":true}";
    }
    public function load($a=null,$b=null){
        if(!$a)$this->halt();
        $test=$this->testmodel->get($a);
        if(!$test){
            $this->output->error("404");
            $this->close();
        }

        $questions=$this->testmodel->getQuestions($a);
        $test=json_encode(array_merge((array)$test[0],array("questions"=>$questions)));
        echo "{\"out\":{\"test\":$test},\"success\":true}";
    }
}