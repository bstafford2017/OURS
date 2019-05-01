<?php

class Record{
    // database connection and table name
    private $conn;

    // object properties
    public $course_id;
    public $student_id;
    public $isCompleted;
    public $isEnrolled;
    public $isRegistered;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    /*
      grab academic record information
    */
    function read(){
      $sql = "SELECT * FROM `view_record` WHERE student_id = '$this->student_id'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}


?>
