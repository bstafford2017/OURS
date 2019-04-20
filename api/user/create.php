<?php
  include_once '../config/db.php';
  include_once '../objects/user.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $user = new User($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));

  //set product property values
  $user->name = $data->name;
  $user->username = $data->username;
  $user->userPwd = $data->password;
  $user->status = $data->status;

  $isUserCreated = $user->create();

  if($isUserCreated){
    http_response_code(200);
    // can be changed
    echo json_encode(array(
           "userid" => $user->userid,
           "name" => $user->username

    ));

  }else{
    http_response_code(401);
    echo json_encode(array("message" => "sign up failed."));
  }

 ?>
