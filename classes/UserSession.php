<?php


class UserSession{

  private $sessionKey = "userDetails";

  public function __construct(){
    @session_start();
  }

  public function checkLoggedIn(){
    if(isset($_SESSION[$this->sessionKey])){
      return true;
    }
    return false;
  }

  public function createNewSession($userId){

  }

  public function logOutUser(){
    unset($_SESSION[$this->sessionKey]);
    session_destroy();
  }

  public function getUserDetails($field){
      if($this->checkLoggedIn && isset($_SESSION[$this->sessionKey][$field])){
        return $_SESSION[$this->sessionKey][$field];
      } else {
        return false;
      }
  }

  public function getUserDetailsArray(){
    if($this->checkLoggedIn && $_SESSION[$this->sessionKey]){
      return $_SESSION[$this->sessionKey];
    }
    return false;
  }
}


 ?>
