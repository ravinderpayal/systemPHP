<?php
defined('BASEPATH') OR exit('{\"Out\":\"No direct script access allowed\"}');
/**
*
* Class based on PDO for easily calling sql statements.
* @since v20160515
* @package SQL4SYSTEM
* @lastModified 2015-12-18 4:21 PM
* @access public
* @name get | result
* @param ARRAY $w 2D Array containing Key and Value
* @copyright (c) 2016, Ravinder Payal<mail@ravinderpayal.com>
*
*/
class Sql extends Database{
    private static $PDOtype = array("integer"=>PDO::PARAM_INT,"string"=>PDO::PARAM_STR,"boolean"=>PDO::PARAM_BOOL);
    public function __construct(){
        //Following Constants should be predefined :- host , username , password , database
        /*******Right Now we will try PDO But will write code IN such a way that we can change anytime*********/
        //$this->DB = new MySQLi(SQL_HOST,SQL_USER,SQL_PASS,SQL_DB) or die("error in servers");
        try{
                $this->DB = new PDO("mysql:host=".SQL_HOST.";dbname=".SQL_DB,SQL_USER ,SQL_PASSWORD);
                $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
        catch(PDOException $e){
                $this->halt($e);
         }
    }
    /**
    *
    * Private Variable for storing resulting SQL
    *@access private
    */
    private $sql;

    /**
    * Private Variable for storing Params that will be binded during execution of SQL
    *@access private
    */
    private $params = array();
    
    /**
    * Function for selecting columns
    * @param $a : Column names comma separated<!(array)>
    * @param $b : array for other options
    * @since v20160515
    * @lastModified 2015-05-15 7:30 PM
    * @access public
    * @name get | result
    *
    */
    public function select($a = "*"){
        $this->sql = "SELECT $a";
        /**
        *
        *Param no more used as ARRAY
        foreach($a as $cn){
                $sql.=$cn.",";
        }
        $sql=rtrim($sql,",");
        *
        */
        return $this;
    }

    /**
    * Function for updating a table
    * @param $t : Table Name
    * @since v20160515
    * @lastModified 2015-05-15 7:30 PM
    * @access public
    * @name get | result
    *
    */
   public function update($t){
       $this->sql = "UPDATE `$t` ";
        return $this;
   }

    /**
    * Function for updating a table
    * @param $t : Table Name
    * @since v20160515
    * @lastModified 2015-05-15 7:30 PM
    * @access public
    * @name get | result
    *
    */
   public function delete(){
       $this->sql = "DELETE ";
        return $this;
   }
   
   /**
    * 
    *  Function for setting table name
    * @param String $table Name of the table that will be used
    * @since v20160515
    * @lastModified 2015-05-15 7:30 PM
    * @access public
    * @name from
    *
    */
    public function from($table){
                   $this->sql.=" FROM ".$table;
                   return $this;
    }
    public function limit($limit){
        $this->sql.=" LIMIT ".$limit;
        return $this;
    }

    /**
     * 
     * Function for Adding Where Condition
     * @since v20160515
     * @lastModified 2015-05-15 7:30 PM
     * @access public
     * @name where
     * @param ARRAY $w 2D Array containing Key and Value
     * 
     */
    public function where($w){
        $this->sql.=" WHERE ";
        $i=0;
        foreach($w as $j=>$k){
                $this->params[] = array($k,"WHERE$j");
                $this->sql.=($i==0?" ":" and ")."$j = :WHERE$j";
                $i++;
        }
        return $this;
    }

    /**
     * 
     * Function for Adding Where Condition
     * @since v20160515
     * @lastModified 2015-05-15 7:30 PM
     * @access public
     * @name set
     * @uses SQL UPDATE It will be used for setting values of fields during UPDATE
     * @param ARRAY $w 2D Array containing Key and Value
     * 
     */
    public function set($w){
        $this->sql.=" SET ";
        $i=0;
        foreach($w as $j=>$k){
                $this->params[] = array($k,"SET$j");
                $this->sql.=($i==0?" ":" , ")."$j = :SET$j";
                $i++;
        }
        return $this;
    }

    //--------------Insert Commands

    /**
     * @param $t String Name of Table in which data will be inserted
     * @return $this
     */
    public function insertInto($t){
        $this->sql="INSERT INTO ".$t;
        return $this;
    }

    /**
     * @param $v Array Values of columns, which will be inserted into Table
     * @return $this
     */
    public function values($v){
        $i=0;
        $part1=null;
        $part2=null;
        foreach($v as $j=>$k){
            $this->params[$i] = array($k,"VALUES$j");
            $part1.=($i==0?" ( ":",").$j;
            $part2.=($i==0?" VALUES ( ":",").":VALUES$j";
            $i++;
        }
        $part1.=")";
        $part2.=")";
        $this->sql.=$part1.$part2;
        return $this;
    }

//-------Some high level features, use with precautions

    /**
    *
    *@Param $t String Name of table which will be joined
    *
    */
    public function rightJoin($t){
        $this->sql.=" RIGHT JOIN $t";
        return $this;
    }

    /**
    *
    *@Param $c String Conditions to be considered for joining two tables
    *
    */
    public function on($c){
        $this->sql.=" ON($c)";
        return $this;
    }



//-------------------Execution and Result Functions



    /**
     * 
     *  Function for Executing Query
     * @since version20160515
     * @lastModified 2015-05-15 8:00 PM
     * @access public
     * @name get | result
     * 
     */
    public  function exec(){
        $stmt = $this->DB->prepare($this->sql);
        if (isset($this->params)) {
            foreach ($this->params as $p) {
                $stmt->bindParam(":". $p[1],$p[0], self::$PDOtype[gettype ( $p[0] )]);
            }
        }
        try{
            $stmt->execute();
            //var_dump($this->sql);
            $this->reset();
            return $stmt->rowCount()==0?false:$this->DB->lastInsertId();
        }
        catch(PDOException $e){
            $this->halt($e);
         }
    }
    
    /**
     * 
     *  Function for getting Result
     * @since version20160515
     * @lastModified 2015-05-15 8:00 PM
     * @access public
     * @name get | result
     * 
     */
    public function result(){
        $stmt = $this->DB->prepare($this->sql);
        if (isset($this->params)) {
            foreach ($this->params as $p) {
                $stmt->bindParam(":". $p[1],$p[0], self::$PDOtype[gettype ( $p[0] )]);
            }
        }
        try{
            $stmt->execute();
            $this->reset();
            $this->rowCount=$stmt->rowCount();
            return $this->rowCount==0?false:$stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            $this->halt($e);
         }
    }
    
    /**
     * 
     *  Function for resetting the current SQL statement 
     * @since v20160515
     * @lastModified 2016-05-15 7:30 PM
     * @access public
     * @name get | result
     * 
     */
    public function reset(){
        $this->sql = NULL;
        $this->params=array();
    }
}