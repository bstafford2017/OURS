<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files

include_once '../config/db.php';
include_once '../objects/course.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$course = new Course($db);

// get keywords
if(isset($_GET["course_id"])){
  $course_id = $_GET["course_id"];
}
if(isset($_GET["course_name"])){
  $course_name = $_GET["course_name"];
}
if(isset($_GET["dept"])){
  $dept =$_GET["dept"];
}
if(isset($_GET["faculty"])){
  $faculty_name =$_GET["faculty"];
}

if($course_id == NULL && $course_name == NULL && $faculty_name ==NULL){
  // SEARCH W/ DEPT
  $stmt = $course->search(0, $dept);
} else if(!empty($course_id) && empty($course_name) && empty($faculty_name)){
  $stmt = $course->search(1, $course_id);
} else if (!empty($course_name) && empty($course_id) && empty($faculty_name)){
  $stmt = $course->search(2, $course_name);
} else if (empty($course_name) && empty($course_id) && !empty($faculty_name)){
  $stmt =  $course->search(3, $faculty_name);
}

$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    $arr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
        $each=array(
            "id" => $id,
            "cname" => $cname,
            "credits" => $credits,
            "season_year" => $season_year,
            "max_no_students" => $max_no_students,
            "class_time" => $class_time,
            "instructor_id" => $name,
            "classroom_id" => $classroom_id,
            "prerequisite" => $prerequisite,
            "course_description" => $course_decription
        );
        array_push($arr, $each);
    }

    // set response code - 200 OK
    http_response_code(200);
    echo json_encode($arr);
    // echo json_encode(
    //     array("course name" => $course_name,
    //           "course id" => $course_id,
    //           "dept" => $dept)
    // );
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
      array("course name" => $course_name,
            "course id" => $course_id,
            "dept" => $dept)
    );
}
?>
