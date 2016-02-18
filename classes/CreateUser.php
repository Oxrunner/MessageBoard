<?php
include_once(__DIR__."/HashString.php");
include_once(__DIR__."/../models/User.php");
class CreateUser{
  public function __construct(){}

  public function createNewUser($username, $password){
    $this->checkUsernameAndPassword($username, $password);
    $this->checkUsernameNotTaken($username);
    $hashedString = new HashString();
    $salt1 = $hashedString->getASalt();
    $salt2 = $hashedString->getASalt();
    $hashedPassword = $hashedString->hashString($password, $salt1, $salt2);
    $newUser = new User(null, $username, $password, $salt1, $salt2);
    $newUser->save();
    return "New Account succesfully created.";
  }

  public function checkUsernameAndPassword($username, $password){
    if($username==null || empty($username) || $username=="" || $password==null || empty($password) || $password==""){
        throw new CreateUserException("Please ensure you have entered something for both username and password.");
    }
    return;
  }

  public function checkUsernameNotTaken($username){
    $userSearch = User::getByUsername($username);
    if(sizeof($userSearch) == 0){
      return;
    } else {
      throw new CreateUserException("Username selected has already been taken please select a new one.");
    }
  }


}

class CreateUserException extends Exception{
	public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}



 ?>
