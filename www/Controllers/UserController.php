<?php
namespace App\Controllers;

use App\Core\Error;
use App\Models\User;
use App\Core\View;
use App\Repositories\UserRepository;
use App\Services\UserService;


class UserController
{
   public function showUser():void
   {
        $view = new View("Backend/User/index", "front");
        $error = new Error();
        $user = new User($error);
        $userRepository = new UserRepository();
        $userService = new UserService($userRepository);
        $user_ = $userService->getUserById("695");
        var_dump($user_);
        die;
   }
}