<?php

class Enroll{
    // database connection and table name
    private $conn;

    // object properties
    public $user_id;
    public $course_id;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // insert each course into cart
    function create(){
      $sql = "INSERT INTO `enroll`(course_id, user_id) VALUES ('$this->course_id', '$this->user_id')";
      $stmt = $this->conn->prepare($sql);
      if($stmt->execute()){
        return true;
      } else{
        return false;
      }
    }

    /*
      grab cart information
    */
    function read(){

      $sql = "SELECT course_id, user_id FROM `enroll` WHERE user_id = '$this->user_id'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}
