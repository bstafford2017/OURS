<?php

class Course{
    // database connection and table name
    private $conn;

    // object properties
    public $id;
    public $name;
    public $credits;
    public $season_year;
    public $max_no_students;
    public $class_time;
    public $instructor_id;
    public $classroom_id;
    public $prerequisite;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    /*
      grab users information
    */
    function read(){
      $sql = "SELECT * FROM `course`";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

    function read_one(){
      $sql = "SELECT * FROM `course` WHERE id = '$this->id'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // set values
      $this->id = $row['id'];
      $this->name = $row['cname'];
      $this->class_time = $row['class_time'];

    }

    function search(){
      $stmt = $this->conn->prepare($createview);
      // if($stmt -> execute()){
      if(func_num_args() == 2){
        // search with department
        if(func_get_arg(0) == 0){
          // var_dump("offer dept ".$offer_dept);
          $offer_dept = func_get_arg(1);
          $sql = "SELECT * FROM `view_course` WHERE offer_dept = $offer_dept";
        }
        else if(func_get_arg(0) == 1){
          // var_dump("offer dept ".$offer_dept);
          $course_id = func_get_arg(1);
          $sql = "SELECT * FROM `view_course` WHERE id = $course_id";
        }
        if(func_get_arg(0) == 2){
          // var_dump("offer dept ".$offer_dept);
          $course_name = func_get_arg(1);
          $sql = "SELECT * FROM `view_course` WHERE cname LIKE '%".$course_name."%' ";
        }

        if(func_get_arg(0) == 3){
          // var_dump("offer dept ".$offer_dept);
          $faculty_name = func_get_arg(1);
          $sql = "SELECT * FROM `view_course` WHERE name LIKE '%".$faculty_name."%' ";
        }

      }

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}
