<?php
  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  // files needed to connect to database
  include_once 'config/db.php';
  include_once 'objects/user.php';
  include_once 'config/core.php';
  include_once 'libs/php-jwt-master/src/BeforeValidException.php';
  include_once 'libs/php-jwt-master/src/ExpiredException.php';
  include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
  include_once 'libs/php-jwt-master/src/JWT.php';
  use \Firebase\JWT\JWT;


  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $user = new User($db);

  $data = json_decode(file_get_contents("php://input"));

  // set product property values
  $user->username = $data->username;
  //echo ($user->userEmail);

  $user_exists = $user->userExists();

  if($user_exists){
    if($user->userPwd == $data->password){
      // email in db and password correct
      $token = array(
        "data" => array(
            "id" => $user->userid,
            "name" => $user->username

        )
      );
      http_response_code(200);

       // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
           array(
               "message" => "login success.",
               "jwt" => $jwt
           )
      );
    }

  } else{
    // login failed..

    http_response_code(401);
    echo json_encode(array("message" => "login failed.."));
  }


 ?>
