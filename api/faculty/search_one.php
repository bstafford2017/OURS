<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files

include_once '../config/db.php';
include_once '../objects/faculty.php';

$database = new Database();
$db = $database->getConnection();


$faculty = new Faculty($db);

$keyword=isset($_GET['name']) ? $_GET['name'] : die();

$isFacultyExisted = $faculty->search_one($keyword);

if($isFacultyExisted){

    http_response_code(200);
    echo json_encode(
      array ("name" => $faculty->name,
      "position" => $faculty->position,
      "offcie_addr" => $faculty->office_addr,
      "biography" => $faculty->biography,
      "interest" =>$faculty->interest,
      "education" => $faculty ->education
      )
    );
}

else{
    // set response code - 404 Not found
    http_response_code(404);
    echo json_encode(
      array("message" =>"NOT FOUND")
    );
}
?>
