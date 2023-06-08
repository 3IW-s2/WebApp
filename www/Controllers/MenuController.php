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

    public function addMenu()
    {
        $view = new View("Backend/Menu/add", "back");
        $ArtcileService = new MenuService();
        $menus = $ArtcileService->findAllParent();
        $view->assign('menus', $menus);

        if (isset($_POST['submit'])) {
            $menu = new Menu();
            $menu->setTitre($_POST['title']);
            $menu->setUrl($_POST['url']);
            $ArtcileService->createMenu($menu);
            header('Location: /admin/menu');
        }

        if (isset($_POST['submit-submenu'])) {
            $menu = new Menu();
            $menu->setTitre($_POST['title']);
            $menu->setUrl($_POST['url']);
            $menu->setParentId($_POST['parent']);
            $ArtcileService->createSubMenu($menu);
            header('Location: /admin/menu');
        }
    }

}