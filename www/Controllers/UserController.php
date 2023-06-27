<?php
namespace App\Controllers;

use App\Core\Error;
use App\Models\User;
use App\Models\History;
use App\Core\View;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Services\HistoryService;
use App\Core\Database;
use App\Core\Security;

class UserController 
{
   public function showUser():void
   {  
         $error = new Error();
         $user = new User($error);
         $user->setEmail($_SESSION['user']);
         $userService = new UserService();
         $user = $userService->findByEmail($user);
         if($user['role'] === 3){

            $error = new Error();
            $error = $error->addError("Vous n'avez pas les droits pour accéder à cette page");
            $view = new View("Backend/User/index", "back");
            $view->assign('error', $error->getErrors());
            die;
         }

      

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
      $error = new Error();
    
      if(isset($_GET['id'])){
         $id = $_GET['id'];
         $user = new User($error);
         $user->setId($id);

         $userService = new UserService();
            if( $userService){
               $userService->deleteUserById($user);
               header('Location: /admin/showuser');
            }/* else{
               echo "Une erreur s'est produite lors de la suppression de l'utilisateur";
            } */
      }
     
   }

    public function editUser()
   {
      $error = new Error();
      $view = new View("Backend/User/edit", "back");
      if(isset($_GET['id'])){
         $id = $_GET['id'];
         $user = new User($error);
         $user->setId($id);
         $userService = new UserService();
         $user = $userService->getUserById($user);

         $historyModel = new History();
         $historyModel->setEntityType('users');
         $historyModel->setEntityId($id);
         $historyModel->setTableName('users');
         

         $historyService = new HistoryService();
         $history = $historyService->getHistoryForEntity($historyModel);
      

         
         $view->assign('usr', $user);
         $view->assign('history', $history); 

         if(isset($_POST['submit'])){
            $users = new User($error);
            $users->setId($id);
            $users->setEmail($_POST['email']);
            $users->setFirstname($_POST['firstname']);
            $users->setLastname($_POST['lastname']);  
           /*  $users->setPwd($_POST['password']); */
           $data =[
               'id' => $id,
               'email' => $_POST['email'],
               'firstname' => $_POST['firstname'],
               'lastname' => $_POST['lastname']
               
             ];
           
            $uppdateService = new UserService();
            $updateUser = $uppdateService->updateUser($users);

            $historyModel->setAction('update');
            $historyModel->setContent(json_encode($data));

            $addHistory = $historyService->addHistory($historyModel);
             
            unset($_POST);
            header('Location: /admin/showuser');
            
         }
   
      }
     
      
   }
   
    public function addUser()
    {
      $view = new View("Backend/User/add", "back");
      $error = new Error();
      if(isset($_POST['submit'])){
         $users = new User($error);
         $users->setEmail($_POST['email']);
         $users->setFirstname($_POST['firstname']);
         $users->setLastname($_POST['lastname']);  
         $users->setPwd($_POST['password']);
        // $users->setRole($_POST['role']);

         $addUserService = new UserService();
         $addUser = $addUserService->addUser($users);
         header('Location: /admin/showuser');

      }
    }


    public function editRole()
    {
      $view = new View("Backend/User/editRole", "back");
      $error = new Error();
      if(isset($_GET['id'])){
         $id = $_GET['id'];
         $user = new User($error);
         $user->setId($id);
         $userService = new UserService();
         $user = $userService->getUserById($user);

      
         $view->assign('usr', $user);

         if(isset($_POST['submit'])){
            $users = new User($error);
            $users->setId($id);
            $role = isset($_POST['role']) ? intval($_POST['role']) : 5;
            $users->setRole($role);

            $uppdateService = new UserService();
            $updateUser = $uppdateService->updateRole($users);

      
            header('Location: /admin/showuser');
            
         }
   
      }
    }
}