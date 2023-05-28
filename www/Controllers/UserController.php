<?php
namespace App\Controllers;

use App\Core\Error;
use App\Models\User;
use App\Core\View;
use App\Repositories\UserRepository;
use App\Core\Database;

class UserController 
{
   public function showUser():void
   {
        $view = new View("Backend/User/index", "front");
        $error = new Error();
        $user = new User($error);
        $userRepository = new UserRepository();
       
   }
}