<?php

class PhotographyAppDao{

  private $conn;

  /**
  * constructor of dao class
  */
  public function __construct(){
    $servername = "sql11.freemysqlhosting.net";
    $username = "sql11479691";
    $password = "qByw4gTz3G";
    $schema = "sql11479691";
    $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
  * Method used to read all todo objects from database
  */
  public function get_all(){
    $stmt = $this->conn->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Method used to add todo to the database
  */
  public function add($name, $age, $registered, $speciality){
    $stmt = $this->conn->prepare("INSERT INTO users (name, age, registered, speciality) VALUES (:name, :age, :registered, :speciality)");
    $stmt->execute(['name' => $name, 'age' => $age, 'registered' => $registered, 'speciality' => $speciality]);
  }

  /**
  * Delete todo record from the database
  */
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM users WHERE idusers=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }

  /**
  * Update todo record
  */
  public function update($id, $name, $age, $registered, $speciality){
    $stmt = $this->conn->prepare("UPDATE users SET name=:name, age=:age, registered=:registered, speciality=:speciality  WHERE id=:id");
    $stmt->execute(['id' => $id, 'name' => $name, 'age' => $age, 'registered' => $registered, 'speciality' => $speciality]);
  }

}

?>
