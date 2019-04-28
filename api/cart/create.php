<?php
  include_once '../config/db.php';
  include_once '../objects/cart.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate cart object
  $cart = new Cart($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));

  //set product property values
  $cart->user_id = (int)$data->user_id;
  $cart->course_id = (int)$data->course_id;

  $isPutInCart = $cart->create();

  if($isPutInCart){
    http_response_code(200);
    // can be changed
    echo json_encode(array(
           "course_id" => $cart->course_id,
           "user_id" => $cart->user_id
    ));

  }else{
    http_response_code(401);
    echo json_encode(array("message" => "Putting course in the cart failed.",
    "user_id_input" => $cart->user_id, "course_id_input"=> $cart->course_id
    ));
  }

 ?>
