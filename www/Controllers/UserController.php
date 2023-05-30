<?php
namespace App\Controllers;

use App\Core\Error;
use App\Models\User;
use App\Core\View;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Core\Database;

class UserController 
{
   public function showUser():void
   {
        $view = new View("Backend/User/index", "back");
        $error = new Error();
        $userService = new UserService($error);
        $users = $userService->getAllUser();
        $view->assign('users', $users);
       
   }

   public function updateUser ()
   {
      $emal = $_POST['email'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $role = $_POST['role'];
      $id = $_POST['id'];
      $password = $_POST['password'];

      $user = new User();
      $user->setEmail($emal);
      $user->setFirstname($firstname);
      $user->setLastname($lastname);
      $user->setRole($role);
      $user->setId($id);
      $user->setPassword($password);


      $userService = new UserService();
      $userService->updateUser($user);
   }

   public function deleteUser()
   {
      if(isset($_GET['id'])){
         $id = $_GET['id'];
         $user = new User();
         $user->setId($id);
         $userService = new UserService();
         //$userService->deleteUserById($id);
            if( $userService->deleteUserById($user)){
               header('Location: /index');
            }else{
               echo "Une erreur s'est produite lors de la suppression de l'utilisateur";
            }
      }
     
   }
}