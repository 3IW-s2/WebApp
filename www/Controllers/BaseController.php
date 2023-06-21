<?php

namespace App\Controllers;

use App\Services\MenuService;
use App\Core\View;

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

        $view = new View();
        $view->assign("menus", $menus);
        $view->assign("sousmenus", $sousmenus);
 
    }

}
