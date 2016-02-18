<?php
include_once(__DIR__."/ModelBase.php");

class User extends ModelBase{

  private $userId;
  private $username;
  private $password;

  public function __construct($userId=null, $username=null, $password=null){
      $this->userId = $userId;
      $this->username = $username;
      $this->password = $password;
  }

  public function save(){
      if($this->userId == null){
        $this->password = date("Y-m-d H:i:s");
        parent::runSQL("INSERT INTO user(username, password) VALUES (?,?)", array($this->username, $this->password));
        $this->userId = $this->dbConn->getLastInsertedId();
        $this->dbConn->closeConnection();
      }

  }

  public function delete(){
    if($this->userId != null){
      parent::runSQL("DELETE FROM user WHERE userId = ?", array($this->userId));
    }
  }

  public static function getById($id){
    $searchResults = ModelBase::runSQLStatic("SELECT * FROM user WHERE userId = ?", array($id));
    return self::createuserReturn($searchResults);
  }

  public static function getAll(){
    $searchResults = ModelBase::runSQLStatic("SELECT * FROM user", array());
    return self::createuserReturn($searchResults);
  }

  private static function createuserReturn($searchResults){
    $returnArray = array();
    foreach ($searchResults as $row) {
      $returnArray[] = new User($row["userId"], $row["username"], $row["password"]);
    }
    return $returnArray;
  }

  public function setUsername($username){
    $this->username = $username;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function getUsername(){
    return $this->username;
  }

  public function getuserId(){
    return $this->userId;
  }

  public function getPassword(){
    return $this->password;
  }

}
