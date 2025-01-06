<?php
namespace App\Controllers\Auth;

use App\Classes\User;
// use App\Config\Database;
use App\Models\UserModel;
use PDO;
class AuthController{
    public function login($email, $password){
        $userModel = new UserModel();
        $userLogin =  $userModel->findUserByEmailAndPassword($email, $password);
        if($userLogin != null)
        {
            $role = $userLogin->getRole();
            if($role == "admin")
            {
                header("Location:../admin/dashboard/public/index.php");
            }
            if($role == "candidate")
            {
                header("Location:../candidate/home.php");
            }
            if($role == "recruiter")
            {
                header("Location:../recruiter/home.php");
            }
        }
        else{
            echo "cette personne il n'existe pas";
        }
    }
    public function singUp($name,$phone,$email,$password,$role){
        $userModel = new UserModel();
        $userSignUp = $userModel->findUserByEmailAndPassword($email, $password);
        
        if($userSignUp == null)
        {
            $query=$userModel->register($name,$phone,$email,$password,$role);

            if($role == "candidate")
            {
                header("Location:../candidate/home.php");
            }
            if($role == "recruiter")
            {
                header("Location:../recruiter/home.php");
            }
        }
        else{
            echo "This Email is Already exists";
        }
        
    }
   
    
}