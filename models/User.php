<?php
include_once(__DIR__."/ModelBase.php");

class User extends ModelBase{

  private $userId;
  private $username;
  private $password;
  private $salt1;
  private $salt2;

  public function __construct($userId=null, $username=null, $password=null, $salt1=null, $salt2=null){
      $this->userId = $userId;
      $this->username = $username;
      $this->password = $password;
      $this->salt1 = $salt1;
      $this->salt2 = $salt2;
  }

  public function save(){
      if($this->userId == null){
        parent::runSQL("INSERT INTO user(username, password, salt1, salt2) VALUES (?,?,?,?)", array($this->username, $this->password, $this->salt1, $this->salt2));
        $this->userId = $this->dbConn->getLastInsertedId();
        $this->dbConn->closeConnection();
      }

  }

  public function delete(){
    if($this->userId != null){
      parent::runSQL("DELETE FROM user WHERE userId = ?", array($this->userId));
    }
  }

  public static function getByUsername($username){
    $searchResults = ModelBase::runSQLStatic("SELECT * FROM user WHERE username = ?", array($username));
    return self::getReturnArray($searchResults);
  }

  public static function getById($id){
    $searchResults = ModelBase::runSQLStatic("SELECT * FROM user WHERE userId = ?", array($id));
    return self::getReturnArray($searchResults);
  }

  private static function getReturnArray($searchResults){
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

  public function setSalt1($salt1){
    $this->salt1 = $salt1;
  }

  public function setSalt2($salt2){
    $this->salt1 = $salt2;
  }

  public function getSalt1($salt1){
    return $this->salt1;
  }

  public function getSalt2($salt2){
    return $this->salt2;
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
