<?php
ini_set('date.timezone', 'Europe/London');
include_once(__DIR__."/classes/Messages.php");
$createMessageException = "";
$messages = new Messages();
if($_POST && isset($_POST["submit"])){
  try{
    if($_POST["submit"] == "Create Message" && isset($_POST["message"])){
      $messages->createNewMessage($_POST["message"]);
    } elseif($_POST["submit"] == "Delete" && isset($_POST["messageId"])){
      $messages->deleteMessage($_POST["messageId"]);
      var_dump($_POST);
    }
  }catch(CreateMessageException $e){
    $createMessageException = $e->getMessage();
  }
}
$messagesList = $messages->getAllMessages();
?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta charset="UTF-8">
     <title>Message Board</title>
   </head>

   <body>
     <div class="container">
       <?php foreach($messagesList as $message){ ?>
         <div class="row">
           <div class="col-sm-6"><p>Date Submitted: <?=$message->getDateSubmitted()?></p></div>
           <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
             <input type="hidden" value="<?= $message->getMessageId()?>" name="messageId">
             <div class="col-sm-6"><input name="submit" value="Delete" type="submit"></div>
           </form>
         </div>
         <div class="row">

           <div class="col-sm-12"><p><?=$message->getMessage()?></p></div>
         </div>
       <?php } ?>



       <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
         <div class="row">
           <div class="col-sm-12"><?=$createMessageException?></div>
         </div>
         <div class="row">
           <div class="col-sm-12"><textarea rows="4" cols="50" name="message"></textarea></div>
         </div>
         <div class="row">
           <div class="col-sm-12"><input type="submit" value="Create Message" name="submit"></textarea></div>
         </div>
       </form>
     </div>

   </body>
 </html>
