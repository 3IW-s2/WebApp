<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Database;
use PDO;


class Auth
{



    public function login(): void
    {   
        $view = new View("Auth/login", "front");

       //faire le traitement du formulaire
        if(!empty($_POST)){
            $email = $_POST["email"];
            $pwd = $_POST["password"];

            $user = new User();
            $user->setEmail($email);
            $user->setPwd($pwd);
            $user->login( $email, $pwd);
        }
    }

    public function register(): void
    {
        $view = new View("Auth/register", "front");

        if(!empty($_POST)){
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $pwd = $_POST["password"];
            

            $user = new User();
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPwd($pwd);
            $user->register();
        }
       

    }

    public function logout(): void
    {
        if(!empty($_SESSION["user"])){
            unset($_SESSION["user"]);
        }
        
        header("Location: /");
        
    }

   public function  forgotPassword(): void
   {
       $view = new View("Auth/forgotpassword", "front");

         if(!empty($_POST)){
              $email = $_POST["email"];
    
              $user = new User();
              $user->setEmail($email);
              $user->forgotPassword($email);
         }
   }


}