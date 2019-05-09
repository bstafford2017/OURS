<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files

include_once '../config/db.php';
include_once '../objects/faculty.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$faculty = new Faculty($db);

$stmt = $faculty-> search();
$row = $stmt->rowCount();

if($row>1){
  $arr = array();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $each = array ("name" => $name,
          "position" => $position,
          "offcie_addr" => $office_addr,
          "biography" => $biography,
          "interest" =>$interest,
          "education" => $education

          );
    array_push($arr, $each);
  }
  http_response_code(200);
  echo json_encode($arr);

} else{
  http_response_code(404);
  echo json_encode(
        array("message" =>"NOT FOUND")
      );
}

?>
