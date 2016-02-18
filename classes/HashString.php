<?php
class HashString {

    private $systemSalt = 'uie4124fb565ijeier123flhwef13224';

    public function __construct(){

    }

    public function hashString($string, $salt1=null, $salt2=null){
        $hashedPassword = hash_hmac('sha384', $salt1.$string.$salt2, $this->systemSalt);
        return $hashedPassword;
    }

    public function getASalt(){
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $salt = '';
      for ($i = 0; $i < 50; $i++) {
          $salt .= $characters[rand(0, 61)];
      }
      return $salt;
    }
}
