<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Error;
use App\Core\Menu;
use App\Models\User;
use App\Core\View;
use App\Core\Dump;
use App\Core\Database;
use App\Services\UserService;
use App\Services\MenuService;
use App\Core\Session;
use PDO;



class Auth  
{
   
   
    public $message = [];   
    protected $menu;
    private $error;
    

    public function __construct(){
        $this->handle = [
            Session::class
        ];
        $this->menu = new Menu();
        $this->error = new Error();
       
    }

    public function login(): void
    {  

        $view = new View("Auth/login", "front");

        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);
        $error = new Error();
        $user = new User($error);
     

        if(!empty($_POST)){
            $email = $_POST["email"];
            $pwd = $_POST["password"];
       
            
            $user->setEmail($email);
            $user->setPwd($pwd);
            $user->login( $email, $pwd);

            if(!empty($_SESSION["user"])){
                header("Location: /");
            }

        }

        $error = $user->getError();
        $view->assign("error", $error);

    }

    public function logout(): void
    {
        if(!empty($_SESSION["user"])){
            session_destroy();
            unset($_SESSION["user"]);
        }
        header("Location: /");
        
    }

   public function  forgotPassword(): void
   {
       $view = new View("Auth/forgotpassword", "front");
       $error = new Error();
       $user = new User( $error);

         if(!empty($_POST)){
              $email = $_POST["email"];
    
             
              $user->setEmail($email);
              $user->forgotPassword($email);
         }

        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);
        $error = $user->getError();
        $view->assign("error", $error);
   }

   public function resetPassword(): void
   {
            if (isset($_GET['token'])) {

                $token = $_GET['token'];
                $error = new Error();

                $tokenIsValid =  new User($error);
                $tokenIsValid->checkToken($token);

                if ($tokenIsValid) {
                    $view = new View("Auth/resetpassword", "front");
                    $menuss = $this->menu->getAllLink();
                    $view->assign("menus", $menuss[0]);
                    $view->assign("sousmenus", $menuss[1]);
                    header("Location: /newpassword");
                } else {
                    $erros [] = 'Jeton invalide';
                }
            } else {
                $erros [] = 'Accès refusé';
            }
            
   }

    public function newPassword(): void
    {
          $view = new View("Auth/newpassword", "front");
          $error = new Error();
          $user = new User( $error);
    
          if(!empty($_POST)){
                $email = $_SESSION["user"];
                $pwd = $_POST["password"];
    
               
                $user->setEmail($email);
                $user->setPwd($pwd);
                $user->resetPassword($email, $pwd);

                header("Location: /");
          }
        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);
    }

    public function register(): void
    {
        $view = new View("Auth/register", "front");
        $error = new Error();
        

        if(!empty($_POST)){
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $pwd = $_POST["password"];
            

            $user = new User($error);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPwd($pwd);
        
            try{
                $register = $user->register($firstname, $lastname, $email, $pwd);
                if($register){
                   // $this->error->addError("utilisateur créé veuillez verifier votre boite mail");
                    $errors[] = "utilisateur créé veuillez verifier votre boite mail";
                    //header("Location: /login");
                }else {
                    $errors[] = "utilisateur déjà existant";
                }

            }catch(Exception $e){
                $errors[] = "utilisateur déjà existant";
            }
            $error = $user->getError();
        }else{
            $errors[] = "Veuillez remplir tous les champs";
        }

        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);
        $view->assign("error", $error);
        $view->assign("errors", $errors);
        

    }

    public function activate(): void
    {
        if($_GET["token"]){
            $token = $_GET["token"];
            $error = new Error();
            
            $tokenIsValid =  new User($error);
            $tokenIsValid->checkActiveToken($token);

            if ($tokenIsValid) {
                $view = new View("Auth/activate", "front");
                header("Location: /login");
            } else {
                $errors[]= 'Jeton invalide';
            }

        }else{
            $errors[]= 'Accès refusé';

        }
        
    }

    public function notFound(): void
    {
        $view = new View("Auth/404", "error");
    }

    

}