<?php

namespace App\Controllers;

use App\Core\Error;
use App\Models\Menu;
use App\Core\View;
use App\Core\Database;
use App\Services\MenuService;
use App\Core\Session;
use PDO;



class MenuController
{
    public function showMenu()
    {
        $view = new View("Backend/Menu/index", "back");
        $ArtcileService = new MenuService();
        $menus = $ArtcileService->findAll();
        $view->assign('menus', $menus);
    }


}