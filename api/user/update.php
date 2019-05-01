<?php
  include_once '../config/db.php';
  include_once '../objects/user.php';

  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $user = new User($db);

  $user->userid = $_POST['id'];
  $user->name = $_POST['name'];
  $user->username = $_POST['username'];

  $isUserinfoUpdated = $user->update();
  if($isUserinfoUpdated){
    http_response_code(200);

  }else{
    http_response_code(404);

  }














?>
