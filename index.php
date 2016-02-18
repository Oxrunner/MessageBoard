<?php
ini_set('date.timezone', 'Europe/London');
include_once(__DIR__."/classes/Messages.php");
$messages = new Messages();
if($_POST && isset($_POST["submit"])){
  if($_POST["submit"] == "Create Message" && isset($_POST["message"])){
      $messages->createNewMessage($_POST["message"]);
  }
}
$messagesList = $messages->getAllMessages();

var_dump($messagesList);
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
           <div class="col-sm-12"><p>Date Submitted: <?=$message->getDateSubmitted()?></p></div>
         </div>
         <div class="row">
           <div class="col-sm-12"><p><?=$message->getMessage()?></p></div>
         </div>
       <?php } ?>



       <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
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
