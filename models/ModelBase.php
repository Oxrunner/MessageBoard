<?php
//include_once(__DIR__."/../../../RestDBM.php");//For when on live as the connection details are outside the www folder for security
include_once(__DIR__."/../dbConnection/RestDBM.php");//User When running locally so you can connect

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
      $sqlReturn = $dbConn->prepareStatment($sql, $data);
      $dbConn->closeConnection();
      return $sqlReturn->fetchAll(PDO::FETCH_ASSOC);
    } catch(SQLException $e){
      throw new ExceptionRunningSQL($e->getMessage());
    }
  }

}




 ?>
