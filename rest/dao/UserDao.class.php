<?php

class UserDao{

  private $conn;

  /**
  * constructor of dao class
  */
  public function __construct(){
    $servername = "localhost";
    $username = "root";
    $password = ""; //tvoja sifra
    $schema = "users";
    $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
  * Method used to read all user objects from database
  */
  public function get_all(){
    $stmt = $this->conn->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Method user to read user by ID
  */
  public function get_by_id($id){
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]); //?
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return reset($result);
  }

  /**
  * Method used to add user to the database
  */
  public function add($user){
    $stmt = $this->conn->prepare("INSERT INTO users (name, age, registered, speciality) VALUES (:name, :age, :registered, :speciality)");
    $stmt->execute($user);
    $user['id']=$this->conn->lastInsertId();
    return $user;
  }

  /**
  * Delete user record from the database
  */
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM users WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }

  /**
  * Update user record
  */
  public function update($user){
    $stmt = $this->conn->prepare("UPDATE users SET name=:name, age=:age, speciality=:speciality  WHERE id=:id"); //?
    $stmt->execute($user);
    return $user;
  }

}

?>
