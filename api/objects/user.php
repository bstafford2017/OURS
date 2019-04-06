<?php

class User{
    // database connection and table name
    private $conn;

    // object properties
    public $userid;
    public $username;
    public $userEmail;
    public $userPwd;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
      try {

        $sql ="CREATE TABLE IF NOT EXISTS User(
          userid INT(6) UNSIGNED AUTO_INCREMENT,
          username VARCHAR(30) NOT NULL,
          userEmail VARCHAR(30) NOT NULL,
          userPwd VARCHAR(30) NOT NULL,
          PRIMARY KEY (userid)
        )";
       $this->conn->exec($sql);
       print("Created User Table.\n");

      } catch(PDOException $e) {
          echo $e->getMessage();
      }

      // sanitize
      $this->username=htmlspecialchars(strip_tags($this->username));
      $this->userEmail=htmlspecialchars(strip_tags($this->userEmail));
      $this->userPwd=htmlspecialchars(strip_tags($this->userPwd));

      $query = "INSERT INTO User(username, userEmail, userPwd) VALUES('$this->username', '$this->userEmail', '$this->userPwd')";
      // $stmt = $this->conn->prepare($query);
      if($this->conn->exec($query) === false){
         print('Error inserting the user.');
         return false;
       }else{
         print("New user is created");
         return true;
       }

    }

    // check if given email exist in the database
    function userExists(){

      // query to check if email exists
      $this->userEmail=htmlspecialchars(strip_tags($this->userEmail));

      //.$this->username.
      $sql = "SELECT userid, username, userEmail, userPwd FROM User WHERE userEmail = '$this->userEmail'";
      $stmt = $this->conn->prepare($sql);

      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // assign values to object properties
          $this->userid = $row['userid'];
          $this->username = $row['username'];
          $this->userEmail = $row['userEmail'];
          $this->userPwd = $row['userPwd'];

          return true;
      }

      return false;
    }

    function userExistsWithId(){
      // query to check if email exists

      //.$this->username.
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
      grab users information
    */
    function read(){

    }


}
