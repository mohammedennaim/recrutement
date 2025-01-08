<?php
namespace App\Controllers\Auth;

use App\Models\UserModel;
class AuthController{
    public function login($email, $password){

        $userModel = new UserModel();
        $userLogin =  $userModel->findUserByEmailAndPassword($email, $password);
        if($userLogin != null)
        {
            $role = $userLogin->getRole();
            $id = $userLogin->getId();
            
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["role"] = $role;
            
            // if () {
                switch ($_SESSION["role"]) {
                    case "admin":
                        header("Location:../admin/dashboard/public/index.php");
                        break;
                    case "candidate":
                        header("Location:../candidate/home.php");
                        break;
                    case "recruiter":
                        header("Location:../recruiter/home.php");
                        break;
                    default:
                        header("Location: login.php" );
                        break;
                }
                exit();
            // }
            
        }
        else{
            echo "cette personne il n'existe pas";
        }
    }
    public function singUp($name,$phone,$email,$password,$role){
        $userModel = new UserModel();
        $userSignUp = $userModel->findUserByEmailAndPassword($email, $password);

        if ($userSignUp == null) {
            $userModel->register($name, $phone, $email, $password, $role);
            header("Location:../" . $role . "/home.php");
            exit();
        } else {
            echo "This email already exists.";
        }
        
    }

}