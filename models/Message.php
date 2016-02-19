<?php
include_once(__DIR__."/ModelBase.php");

class Message extends ModelBase{

  private $messageId;
  private $message;
  private $dateSubmitted;
  private $userId;

  public function __construct($messageId=null, $message=null, $dateSubmitted=null, $userId=null){
      $this->messageId = $messageId;
      $this->message = $message;
      $this->dateSubmitted = $dateSubmitted;
      $this->userId = $userId;
  }

  public function save(){
      if($this->messageId == null){
        $this->dateSubmitted = date("Y-m-d H:i:s");
        parent::runSQL("INSERT INTO message(message, dateSubmitted, userId) VALUES (?,?,?)", array($this->message, $this->dateSubmitted, $this->userId));
        $this->messageId = $this->dbConn->getLastInsertedId();
        $this->dbConn->closeConnection();
      }

  }

  public function delete(){
    if($this->messageId != null){
      parent::runSQL("DELETE FROM message WHERE messageId = ?", array($this->messageId));
    }
  }

  public static function getById($id){
    $searchResults = ModelBase::runSQLStatic("SELECT * FROM message WHERE messageId = ?", array($id));
    return self::createMessageReturn($searchResults);
  }

  public static function getAll(){
    $searchResults = ModelBase::runSQLStatic("SELECT * FROM message", array());
    return self::createMessageReturn($searchResults);
  }

  private static function createMessageReturn($searchResults){
    $returnArray = array();
    foreach ($searchResults as $row) {
      $returnArray[] = new Message($row["messageId"], $row["message"], $row["dateSubmitted"], $row["userId"]);
    }
    return $returnArray;
  }

  public function setMessage($message){
    $this->message = $message;
  }

  public function setUserId($userId){
    $this->userId = $userId;
  }

  public function getMessage(){
    return $this->message;
  }

  public function getMessageId(){
    return $this->messageId;
  }

  public function getDateSubmitted(){
    return $this->dateSubmitted;
  }

  public function getUserId(){
    return $this->userId;
  }

  public function getUsername(){
    if($this->userId !=null){
      $users = User::getById($this->userId);
      if(sizeof($users) == 1){
        return $users[0]->getUsername();
      }
    }
    return false;
  }

}
