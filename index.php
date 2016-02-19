<?php
ini_set('date.timezone', 'Europe/London');
include_once(__DIR__."/classes/Messages.php");
include_once(__DIR__."/classes/UserSession.php");

$userSession = new UserSession();

$infoMessage = $errorMessage = "";
$messages = new Messages($userSession);
if($_POST && isset($_POST["submit"])){
  try{
    if($_POST["submit"] == "Create Message" && isset($_POST["message"])){
      $infoMessage = $messages->createNewMessage($_POST["message"]);
    } elseif($_POST["submit"] == "Delete" && isset($_POST["messageId"])){
      $infoMessage = $messages->deleteMessage($_POST["messageId"]);
    } elseif($_POST["submit"] == "Login" && isset($_POST["username"]) && isset($_POST["password"])){
      $userSession->logInUser($_POST["username"], $_POST["password"]);
    } elseif($_POST["submit"] == "Logout"){
      $userSession->logOutUser();
    }
  }catch(CreateMessageException $e){
    $errorMessage = $e->getMessage();
  }catch(DeleteMessageException $e){
    $errorMessage = $e->getMessage();
  }catch(InvalidUsernameOrPasswordException $e){
    $errorMessage = $e->getMessage();
  }
}
$messagesList = $messages->getAllMessages();
?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link rel="stylesheet" href="css/main.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta charset="UTF-8">
     <title>Message Board</title>
   </head>

   <body>

     <div class="container">
       <div class="row">
         <div class="col-sm-12">
           <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
           <?php if($userSession->loggedIn()){ ?>
            <p>Welcome <?=$userSession->getUserDetails("username")?></p><input type="submit" name="submit" value="Logout">
           <?php } else { ?>
                <label for="username">Username:</label><input type="text" id="username" name="username"><br>
                <label for="password">Password:</label><input type="password" id="password" name="password"><br>
                <input type="submit" name="submit" value="Login">
                <a href="Register.php">Register</a>
           <?php } ?>
           </form>

         </div>
       </div>

       <div class="row">
         <div class="col-sm-12"><h1>Message Board</h1></div>
       </div>
       <div class="row">
         <div class="col-sm-12"><p id="infoMessages"><?=$infoMessage?></p></div>
       </div>
       <div class="row">
         <div class="col-sm-12"><p class="errorMessage"><?=$errorMessage?></p></div>
       </div>

       <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
         <div class="row">
           <div class="col-sm-4"><label for="message" class="labelFloatRight">Message:</label></div>
           <div class="col-sm-8"><textarea rows="4" cols="50" name="message" id="message"></textarea></div>
         </div>
         <div class="row">
           <div class="col-sm-4"></textarea></div>
           <div class="col-sm-4"><input type="submit" value="Create Message" name="submit" id="createButton"></textarea></div>
           <div class="col-sm-4"></textarea></div>
         </div>
       </form>

       <?php
       if(is_array($messagesList)){
         foreach($messagesList as $message){ ?>
           <div class="messages">
             <div class="row">
               <div class="col-sm-8"><p>Posted by: <?php $username = $message->getUsername(); if($username===false){echo "Anonymous";}else{echo $username;} ?></p><p>Date: <?=$message->getDateSubmitted()?></p></div>
               <?php if($userSession->loggedIn() && $userSession->getUserDetails("admin") == 1){ ?>
                 <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
                   <input type="hidden" value="<?= $message->getMessageId()?>" name="messageId">
                   <div class="col-sm-4"><input name="submit" value="Delete" type="submit" class="deleteButton"></div>
                 </form>
               <?php } ?>
             </div>
             <div class="row">
               <div class="col-sm-12"><p><?=$message->getMessage()?></p></div>
             </div>
           </div>
         <?php } ?>
       <?php } else { ?>
         <div class="row">
           <div class="col-sm-12"><h2><?=$messagesList?></h2></div>
         </div>
       <?php } ?>
     </div>

   </body>
 </html>
