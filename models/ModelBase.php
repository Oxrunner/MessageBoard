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

  protected static function runSQLStatic($sql, $data){
    $dbConn = new RestDBM("messageBoard");
    try{
      $sqlReturn = $dbConn->prepareStatment("SELECT * FROM message", array());
      $dbConn->closeConnection();
      return $sqlReturn->fetchAll(PDO::FETCH_ASSOC);
    } catch(SQLException $e){
      throw new ExceptionRunningSQL($e->getMessage());
    }
  }

}




 ?>
