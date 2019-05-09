<?php

class Faculty{
    // database connection and table name
    private $conn;

    // object properties
    public $name;
    public $position;
    public $office_addr;
    public $biography;
    public $interest;
    public $education;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function search_one($keyword){

      $sql = "SELECT * FROM `view_faculty` WHERE `name` LIKE '%".$keyword."%'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // assign values to object properties
          $this->name = $row['name'];
          $this->position = $row['position'];
          $this->office_addr = $row['office_addr'];
          $this->biography = $row['biography'];
          $this->interest = $row['interest'];
          $this->education = $row['education'];
          return true;
      } else{
        return false;
      }


    }

    function search(){

      $sql = "SELECT * FROM `view_faculty`";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }


}
