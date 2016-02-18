<?php


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