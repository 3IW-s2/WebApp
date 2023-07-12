<?php

namespace App\Controllers;

use App\Services\MenuService;
use App\Services\UserService;
use App\Core\View;
use App\Core\Error;
use App\Models\User;

class BaseController 
{
    public function __construct()
    {   
       BaseController::assignMenuVariables();   
    }

    public static  function assignMenuVariables()
{
    $menuService = new MenuService();
    $menus = $menuService->activeLink();
    $sousmenus = $menuService->findAllParent();
    $user = new User( new Error());
    $user->setEmail($_SESSION["user"]);
    $userService = new UserService();
    $user = $userService->findByEmail($user);
    $user_admin =  $user['role'];
    $numberArticle = 3;


    return [
        'user_admin' => $user_admin,
        'numberArticle' => $numberArticle,
    ];
    
}


    
}
