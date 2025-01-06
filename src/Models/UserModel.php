<?php
namespace App\Models;

use App\Classes\Role;
use App\Classes\User;
use App\Config\Database;
use PDO;

class UserModel{
   private $conn;

   public function __construct() {
      $db = new Database();
      $this->conn = $db->connection();
   }

   public function findUserByEmailAndPassword($email, $password) {
      $query = "SELECT id, name, phone, email, password, role FROM user WHERE email = :email";        
  
      $stmt = $this->conn->prepare($query); 
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!$row) {
          return null;
      } else {
         if ($email == $row["email"] && password_verify($password, $row["password"])) {
            return new User($row['id'], $row["email"], $row["role"], $row["password"]);
         } else {
            return null; 
         }
      }
   }
  
   public function register($name, $phone, $email, $password,$role){
      $hash = password_hash($password,PASSWORD_DEFAULT);
      $query = "INSERT INTO user (name, phone, email, password, role) VALUES (:name, :phone, :email, :password, :role);";
      $stmt = $this->conn->prepare($query);
      var_dump([$name, $phone, $email, $password,$role]);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hash);
      $stmt->bindParam(':role', $role);
      $stmt->execute();
   }
}