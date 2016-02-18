<?php


include_once(__DIR__."/../models/Message.php");
class Messages{

  public function __construct(){

  }


  public function createNewMessage($message=null){
    if($message == null || empty($message) || $message == ""){
        throw new MessageException("Please make sure you have entered a message.");
    }
    $newMessage = new Message(null, $message, null);
    $newMessage->save();
    return "New Message Successfully Submitted.";
  }

  public function getAllMessages(){
    $returnArray = Message::getAll();
    return $returnArray;
  }

}

class MessageException extends Exception{
	public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

 ?>
