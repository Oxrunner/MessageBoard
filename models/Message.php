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

  public static function getAll(){
    $dbConn = new RestDBM("messageBoard");
    try{
      $sqlReturn = $dbConn->prepareStatment("SELECT * FROM message", array());
      $returnArray = array();
      foreach ($sqlReturn->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $returnArray[] = new Message($row["messageId"], $row["message"], $row["dateSubmitted"]);
      }
      $dbConn->closeConnection();
      return $returnArray;
    } catch(SQLException $e){
      throw new ExceptionRunningSQL($e->getMessage());
    }
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
