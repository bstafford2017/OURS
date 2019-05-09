<?php

  include_once '../config/db.php';
  include_once '../objects/department.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $dept = new Department($db);

  $stmt = $dept -> read();
  $num = $stmt -> rowCount();

  if($num>0){
    $arr = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $each = array("dept_id" => $id, "dept_name" => $name);
      array_push($arr, $each);
    }
    http_response_code(200);
    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }

 ?>
