<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Database;
use PDO;


class Auth
{
    public $message = [];

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

   public function resetPassword(): void
   {
            if (isset($_GET['token'])) {

                $token = $_GET['token'];

                $tokenIsValid =  new User();
                $tokenIsValid->checkToken($token);

                if ($tokenIsValid) {
                    $view = new View("Auth/resetpassword", "front");
                    header("Location: /newpassword");
                } else {
                    echo 'Jeton invalide';
                }
            } else {
                echo 'Accès refusé';
            }
   }

    public function newPassword(): void
    {
          $view = new View("Auth/newpassword", "front");
    
          if(!empty($_POST)){
                $email = $_SESSION["user"]["email"];
                $pwd = $_POST["password"];
    
                $user = new User();
                $user->setEmail($email);
                $user->setPwd($pwd);
                $user->resetPassword($email, $pwd);

                header("Location: /");
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
            try{
                $register = $user->register($firstname, $lastname, $email, $pwd);
                if($register){
                    $errors [] = "utilisateur créé veuillez verifier votre boite mail";
                }else {
                    $errors[] = "utilisateur déjà existant";
                }
            }catch(Exception $e){
                $errors[] = "utilisateur déjà existant";
            }
            
        }else{
            $errors[] = "Veuillez remplir tous les champs";
            var_dump($errors);
        }
       //var_dump($errors);

    }

    public function activate(): void
    {
        if($_GET["token"]){
            $token = $_GET["token"];
            
            $tokenIsValid =  new User();
            $tokenIsValid->checkActiveToken($token);

            if ($tokenIsValid) {
                $view = new View("Auth/activate", "front");
                header("Location: /");
            } else {
                $errors[]= 'Jeton invalide';
            }

        }else{
                echo 'Accès refusé';

        }

        
    }


}