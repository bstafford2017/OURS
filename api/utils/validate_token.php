<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  // required to decode jwt
  include_once '../config/core.php';
  include_once '../libs/php-jwt-master/src/BeforeValidException.php';
  include_once '../libs/php-jwt-master/src/ExpiredException.php';
  include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
  include_once '../libs/php-jwt-master/src/JWT.php';
  use \Firebase\JWT\JWT;

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
  // get jwt
  $jwt=isset($data->jwt) ? $data->jwt : "";

  if($jwt){
      try {
          // decode jwt
          $decoded = JWT::decode($jwt, $key, array('HS256'));

          // set response code
          http_response_code(200);

          // show user details
          echo json_encode(array(
              "message" => "Access granted.",
              "data" => $decoded->data
          ));
      } catch (Exception $e){
        http_response_code(401);
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
      }
  } else{
        http_response_code(401);
        echo json_encode(array("message" => "Access denied."));
  }


?>