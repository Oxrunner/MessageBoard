<?php
include_once(__DIR__."/../../RestDBM.php");
public ModelBase{

  protected $dbConn;

  protected function runSQL($sql, $data){
    $this->dbConn = new RestDBM("messageBoard");
    try{
      $sqlReturn = $dbConn->prepareStatment($sql, $data);
      return $sqlReturn;
    } catch(SQLException $e){
      throw new ExceptionRunningSQL($e->getMessage());
    }
  }

  


}




 ?>
