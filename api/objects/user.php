<?php

class User{
    // database connection and table name
    private $conn;

    // object properties
    public $userid;
    public $name;
    public $username;
    public $status;
    public $userPwd;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
      try {

        $sql ="CREATE TABLE IF NOT EXISTS `Person`(
          userid INT(6) UNSIGNED AUTO_INCREMENT,
          name VARCHAR(30) NOT NULL,
          username VARCHAR(30) NOT NULL,
          userPwd VARCHAR(30) NOT NULL,
          status VARCHAR(10) NOT NULL,
          PRIMARY KEY (userid)
        )";
       $this->conn->exec($sql);
       print("Created User Table.\n");

      } catch(PDOException $e) {
          echo $e->getMessage();
      }

      // sanitize
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->username=htmlspecialchars(strip_tags($this->username));
      $this->userPwd=htmlspecialchars(strip_tags($this->userPwd));
      $this->status=htmlspecialchars(strip_tags($this->status));

      $query = "INSERT INTO `Person`(name, username, password, status) VALUES('$this->name', '$this->username', '$this->userPwd', '$this->status')";

      if($this->conn->exec($query) === false){
         console.log('Error inserting the user.');
         return false;
       }else{
         console.log("New user is created");
         return true;
       }

    }

    // check if given email exist in the database
    function userExists(){

      // query to check if email exists
      $this->username=htmlspecialchars(strip_tags($this->username));

      $sql = "SELECT * FROM Person WHERE username = '$this->username'";
      $stmt = $this->conn->prepare($sql);

      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // assign values to object properties
          $this->userid = $row['id'];
          $this->name = $row['name'];
          $this->username = $row['usernmae'];
          $this->status = $row['status'];
          $this->userPwd = $row['password'];
          return true;
      }

      return false;
    }

    function userExistsWithId(){
      // query to check if email exists

      $sql = "SELECT userid, username FROM User WHERE userid = '$this->userid'";
      $stmt = $this->conn->prepare( $sql );

      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // assign values to object properties
          $this->userid = $row['userid'];
          $this->username = $row['username'];

          return true;
      }

      return false;
    }

    /*
      change users information
    */
    function update(){
      $sql ="UPDATE Person SET `name` = '$this->name', `username` = '$this->username' WHERE id = $this->userid";
      $stmt = $this->conn->prepare($sql);

      if($stmt->execute()){
        return true;
      } else{
        return false;
      }
    }


}
