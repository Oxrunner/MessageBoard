<?php

class ConnectionDetails{

   public static function getConnectionDetails($database){
     //This function normally holds all of the connections on the server
    switch ($database) {
      case "messageBoard":
            return array('server'=>'localhost', 'username'=>'message_board', 'password'=>'nBUjLPcMpWa7UAJz', 'db'=>'message_board');
    }
  }
}

 ?>
