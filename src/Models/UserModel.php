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

   public function findUserByEmailAndPassword($email, $password){
      $query = "SELECT id ,'name', phone, email , `password` , `role` from user";        

      $stmt = $this->conn->prepare($query); 
      $stmt->execute();
      
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!$row){
         return null;
      }
      else{
         if ($email == $row["email"] && $password == $row["password"]) {
            return new User($row['id'],$row["email"],$row["role"],$row["password"]);
         } else{
            echo "cette personne il n'existe pas";
         }
      }
   }
}