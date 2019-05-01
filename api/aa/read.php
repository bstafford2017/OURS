<?php
  include_once '../config/db.php';
  include_once '../objects/aa.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate object
  $aa = new Aa($db);
  $aa->advisor_id = $_GET['id'];

  $query = $aa->read();
  $num = $query -> rowCount();

  if($num >0){
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $each = array(
        "advisee_id" => $advisee_id,
        "advisor_id" => $advisor_id,
        "advisee_name" => $name
        );
        array_push($arr, $each);

    }
    http_response_code(200);
    echo json_encode($arr);

  }else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }

 ?>
