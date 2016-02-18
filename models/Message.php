<?php
include_once(__DIR__."/ModelBase.php");

class Message extends ModelBase{

  private $messageId;
  private $message;
  private $dateSubmitted;

  public function __construct($messageId=null, $message=null, $dateSubmitted=null){
      $this->messageId = $messageId;
      $this->message = $message;
      $this->dateSubmitted = $dateSubmitted;
  }

  public function save(){
      if($this->messageId == null){
        $this->dateSubmitted = date("Y-m-d H:i:s");
        parent::runSQL("INSERT INTO message(message, dateSubmitted) VALUES (?,?)", array($this->message, $this->dateSubmitted));
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
      $returnArray[] = new Message($row["messageId"], $row["message"], $row["dateSubmitted"]);
    }
    return $returnArray;
  }

  public function setMessage($message){
    $this->message = $message;
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

}
