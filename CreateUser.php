<?php
ini_set('date.timezone', 'Europe/London');
include_once(__DIR__."/classes/CreateUser.php");
$errorMessage = $infoMessage = "";

if($_POST && isset($_POST["submit"]) && $_POST["submit"] = "Register" && isset($_POST["username"]) && isset($_POST["password"])){
  try{
    $createNewUser = new CreateUser();
    $infoMessage = $createNewUser->createNewUser($_POST["username"], $_POST["password"]);
  } catch(CreateUserException $e){
    $errorMessage = $e->getMessage();
  }
}
 ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      <link rel="stylesheet" href="css/main.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="UTF-8">
      <title>Register</title>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col-sm-12"><h1>Register</h1></div>
        </div>
        <div class="row">
          <div class="col-sm-12"><p id="infoMessages"><?=$infoMessage?></p></div>
        </div>
        <div class="row">
          <div class="col-sm-12"><p class="errorMessage"><?=$errorMessage?></p></div>
        </div>
        <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
          <div class="row">
            <div class="col-sm-6"><label for="username" class="labelFloatRight">Username:</label></div>
            <div class="col-sm-6"><input id="username" name="username" type="text"></div>
          </div>
          <div class="row">
            <div class="col-sm-6"><label for="password" class="labelFloatRight">Password:</label></div>
            <div class="col-sm-6"><input id="password" name="password" type="password"></div>
          </div>
          <div class="row">
            <div class="col-sm-12"><input id="registerButton" type="submit" name="submit" value="Register"></div>
          </div>
        </form>

      </div>

    </body>
  </html>
