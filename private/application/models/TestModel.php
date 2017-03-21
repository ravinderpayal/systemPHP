<?php
defined("BASEPATH") or exit("not for you");

class TestModel extends Model{

    public function deleteTest($post_id,$user_id){

    }

    public function isTestByUser($post_id,$user_id){
            $this->db->select();
    }

    /**
     * 
     * Function for getting a single Post with <b>Post ID</b> as key
     * @param String $pid String Contening <b>Post ID</b>
     *  
     */
    public function getTest($pid){
        $result = $this->sql->select("doc_id,doc_title")->from("documents")->where(array("doc_id"=>$pid))->result();
        return $result;
    }

    /**
     * Function for adding test
     * @param Array $t Contains meta data of test
     */
    public function add($t){
        return $this->sql->insertInto("test")->values($t)->exec();
    }
    public function getlist(){
        $this->sql->reset();
        return $this->sql->select("*")->from("test")->result();
    }
    /**
     * 
     * @param type $t Test ID
     * @param type $q Question ID
     * 
     */
    public function addQuestion($q){
           return $this->sql->insertInto("questions")->values($q)->exec();
    }
    /**
     * 
     * @param type $t Test ID
     * @param type $q Question ID
     * 
     */
    public function getQuestion($t,$q){
        
    }

    /**
     * 
     * @param type $t Test ID
     * @return Object/Boolean&lt;False&gt; Select Results&lt;PDO&gt;
     */
    public function get($t){
        return $this->sql->select("*")->from("test")->where(array("test_id"=>$t))->result();
    }

    /**
     * 
     * @param type $a
     * @return Object/Boolean&lt;False&gt; Select Results&lt;PDO&gt;
     */
    public function getQuestions($t){
        return $this->sql->select("*")->from("questions")->where(array("test_id"=>$t))->result();
    }
    public function addChoice($c){
        $this->sql->reset();
           return $this->sql->insertInto("mcq_choices")->values($c)->exec();
    }
}