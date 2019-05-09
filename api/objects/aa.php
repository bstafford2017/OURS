<?php
class Aa{
    // database connection and table name
    private $conn;

    // object properties
    public $advisor_id;
    public $advisee_id;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    /*
      grab information
    */
    function read(){

      $sql = "SELECT * FROM `view_aa` WHERE  advisor_id = '$this->advisor_id'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}
 ?>
