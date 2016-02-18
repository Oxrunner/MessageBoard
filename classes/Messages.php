<?php


include_once(__DIR__."/../models/Message.php");
class Messages{

  public function __construct(){

  }


  public function createNewMessage($message=null){
    if($message == null || empty($message) || $message == ""){
        throw new CreateMessageException("Please make sure you have entered a message.");
    }
    $newMessage = new Message(null, $message, null);
    $newMessage->save();
    return "New Message Successfully Submitted.";
  }

  public function getAllMessages(){
    $returnArray = Message::getAll();
    if(sizeof($returnArray) == 0){
      $returnArray = "No messages have been submitted yet.";
    }
    return $returnArray;
  }

  public function deleteMessage($id){
    $message = Message::getById($id);
    if(sizeof($message) != 1){
      throw new DeleteMessageException("Unable to delete message.");
    }
    $message[0]->delete();
    return "Message Deleted";
  }

}

class CreateMessageException extends Exception{
	public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class DeleteMessageException extends Exception{
	public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

 ?>
