<?php
include_once(__DIR__."/../models/User.php");
include_once(__DIR__."/HashString.php");

class UserSession{

  private $sessionKey = "userDetails";

  public function __construct(){
    @session_start();
  }

  public function loggedIn(){
    if(isset($_SESSION[$this->sessionKey])){
      return true;
    }
    return false;
  }

  public function logInUser($username, $password){
    $user = $this->getUser($username);
    if($this->getHashedPassword($password, $user) == $user->getPassword()){
        $_SESSION[$this->sessionKey]["username"] = $user->getUsername();
        $_SESSION[$this->sessionKey]["admin"] = $user->getAdmin();
    } else {
      throw new InvalidUsernameOrPasswordException();
    }
  }

  private function getHashedPassword($password, $user){
    $hashString = new HashString();
    return $hashString->hashString($password, $user->getSalt1(), $user->getSalt2());
  }

  private function getUser($username){
    $users = User::getByUsername($username);
    foreach ($users as $user) {
      if($username === $user->getUsername()){
        return $user;
      }
    }
    throw new InvalidUsernameOrPasswordException();
  }

  public function logOutUser(){
    unset($_SESSION[$this->sessionKey]);
    session_destroy();
  }

  public function getUserDetails($field){
      if($this->loggedIn() && isset($_SESSION[$this->sessionKey][$field])){
        return $_SESSION[$this->sessionKey][$field];
      } else {
        return false;
      }
  }

  public function getUserDetailsArray(){
    if($this->loggedIn() && $_SESSION[$this->sessionKey]){
      return $_SESSION[$this->sessionKey];
    }
    return false;
  }
}

class InvalidUsernameOrPasswordException extends Exception{
	public function __construct() {
        parent::__construct("Username or password entered was incorrect.", 0, null);
    }
}

 ?>
