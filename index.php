<?php
ini_set('date.timezone', 'Europe/London');
include_once(__DIR__."/classes/Messages.php");
$createMessageException = $infoMessage = $errorMessage = "";
$messages = new Messages();
if($_POST && isset($_POST["submit"])){
  try{
    if($_POST["submit"] == "Create Message" && isset($_POST["message"])){
      $infoMessage = $messages->createNewMessage($_POST["message"]);
    } elseif($_POST["submit"] == "Delete" && isset($_POST["messageId"])){
      $infoMessage = $messages->deleteMessage($_POST["messageId"]);
    }
  }catch(CreateMessageException $e){
    $createMessageException = $e->getMessage();
  }catch(DeleteMessageException $e){
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
         <div class="col-sm-12"><h1>Message Board</h1></div>
       </div>
       <div class="row">
         <div class="col-sm-12"><p id="infoMessages"><?=$infoMessage?></p></div>
       </div>
       <div class="row">
         <div class="col-sm-12"><p class="errorMessage"><?=$errorMessage?></p></div>
       </div>
       <?php
       if(is_array($messagesList)){
         foreach($messagesList as $message){ ?>
           <div class="messages">
             <div class="row">
               <div class="col-sm-6"><p>Date Submitted: <?=$message->getDateSubmitted()?></p></div>
               <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
                 <input type="hidden" value="<?= $message->getMessageId()?>" name="messageId">
                 <div class="col-sm-6"><input name="submit" value="Delete" type="submit" class="deleteButton"></div>
               </form>
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

       <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
         <div class="row">
           <div class="col-sm-12"><p class="errorMessage"><?=$createMessageException?></p></div>
         </div>
         <div class="row">
           <div class="col-sm-4"><label for="message">Message:</label></div>
           <div class="col-sm-8"><textarea rows="4" cols="50" name="message" id="message"></textarea></div>
         </div>
         <div class="row">
           <div class="col-sm-4"></textarea></div>
           <div class="col-sm-4"><input type="submit" value="Create Message" name="submit" id="createButton"></textarea></div>
           <div class="col-sm-4"></textarea></div>
         </div>
       </form>
     </div>

   </body>
 </html>
