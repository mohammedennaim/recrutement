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
        $query = "SELECT id ,'name', phone, email , 'password' , 'role' from user";        
   
        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         if(!$row){
            return null;
         }
         else{
            $role = new Role($row["role"]);
            return new User($row['id'],$row["email"],$role,$row["password"]);
         }
    }
}