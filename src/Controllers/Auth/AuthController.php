<?php
namespace App\Controllers\Auth;

use App\Classes\User;
use App\Config\Database;
use App\Models\UserModel;
use PDO;
class AuthController{
    public function login($email, $password){
        $userModel = new UserModel();
        $userLogin =  $userModel->findUserByEmailAndPassword($email, $password);
        $role = $userLogin->getRole();
        
        // var_dump( $role->getTitle());
        if($userLogin == null)
        {
            echo "user not found please check ...";
        }
        else{
            if($role == "admin")
            {
                header("Location:../admin/dashboard.php");
                // header("Location:http://www.google.com");
            }
            else if($role == "candidate")
            {
                header("Location:../candidate/home.php");
            }
            else if($role == "recruiter")
            {
                header("Location:../recruiter/home.php");
            }
        }
    }
    public function singUp($name,$phone,$email,$password,$role){
        $userModel = new UserModel();
        $userSignUp = $userModel->findUserByEmailAndPassword($email, $password);
        var_dump($userSignUp);
        if($userSignUp == null)
        {
            // $query = "INSERT INTO user(`name`, phone, email, `password`, `role`) VALUES (`:name`, :phone, :email, `:password`, `:role`)";
            $query = "INSERT INTO user (`name`, phone, email, `password`, `role`) VALUES (`:name`, :phone, :email, `:password`, `:role`);";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
  
            echo "singUp succes";
        }
        else{
            echo "This Email is Already exists";
        }
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // if(!$row){
        //    return null;
        // }
        // else{
        //    $role = new Role($row["id"],$row["role"]);
        //    return new User($row['id'],$row["email"],$role,$row["password"]);
        // }
    }
    // public function register($name, $phone, $email, $password,$role){
        
    //         $signUp = new UserModel();
    //         $signUp->signUp($name,$phone,$email, $password,$role);
    //         echo "singUp succes";
        
    // }
    
}