<?php

namespace App\Controllers;

use App\Services\MenuService;
use App\Core\View;
use App\Core\Error;
use App\Models\User;

class BaseController
{
    public function __construct()
    {
        $this->assignMenuVariables();
    }

    protected function assignMenuVariables(/* array $options = null */): void
    {
        $menuService = new MenuService();
        $menus = $menuService->activeLink();
        $sousmenus = $menuService->findAllParent();

        $error = new Error();
        $user = new User($error);

        $view = new View("Auth/login", "front");
        $error = $user->getError();
        $view->assign("error", $error);

        $view->assign("menus", $menus);
        $view->assign("sousmenus", $sousmenus);

       /*  if($options !== null){
            $view->assign("options", $options);
        } */
    }

    
}
