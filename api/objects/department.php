<?php

class Department{
    // database connection and table name
    private $conn;

    // object properties
    public $id;
    public $name;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    /*
      grab users information
    */
    function read(){
      $sql = "SELECT id, name FROM `department`";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}
