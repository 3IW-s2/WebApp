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

    protected function assignMenuVariables(): void
{
    $menuService = new MenuService();
    $menus = $menuService->activeLink();
    $sousmenus = $menuService->findAllParent();

    $view = new View("Main/home", "front");
    $view->assign("menus", $menus);
    $view->assign("sousmenus", $sousmenus);
    
   
}


    
}
