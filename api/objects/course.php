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

    function search(){
      // result can be multiple rows
      // $dropview = "DROP VIEW IF EXISTS `view_course`";
      // $stmt = $this->conn->prepare($dropview);
      // if($stmt->execute()){
      //
      // } else{
      //   echo "what is the problem?\n";
      //   $arr = $stmt->errorInfo();
      //   echo print_r($arr);
      // }
      //
      // $createview="CREATE VIEW `view_course`
      // AS SELECT c.id, c.cname, c.credits, c.seaon_year,
      // c.max_no_students, c.class_time, c.classroom_id,
      // c.prerequisite_id, c.offer_dept, p.name
      //
      // FROM `course` c JOIN `person` p
      // ON c.instructor_id = p.id
      // ";
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

      }

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}
