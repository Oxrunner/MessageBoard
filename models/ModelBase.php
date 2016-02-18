<?php
include_once(__DIR__."/../../../RestDBM.php");
class ModelBase{

  protected $dbConn;

  protected function runSQL($sql, $data){
    $this->dbConn = new RestDBM("messageBoard");
    try{
      $sqlReturn = $this->dbConn->prepareStatment($sql, $data);
      return $sqlReturn;
    } catch(SQLException $e){
      throw new ExceptionRunningSQL($e->getMessage());
    }
  }




}




 ?>
