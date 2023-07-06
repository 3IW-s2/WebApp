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
        $MenuService = new MenuService();
        $menus = $MenuService->findAll();
        $view->assign('menus', $menus);
    }

    public function addMenu()
    {
        $view = new View("Backend/Menu/add", "back");
        $MenuService = new MenuService();
        $menus = $MenuService->activeLink();
        $view->assign('menus', $menus);

        if (isset($_POST['submit'])) {
            $menu = new Menu();
            $menu->setTitre($_POST['title']);
            $menu->setUrl($_POST['url']);
            $MenuService->createMenu($menu);
            header('Location: /admin/menu/index');
        }
     

        if (isset($_POST['submit-submenu'])) {
            $menu = new Menu();
            $menu->setTitre($_POST['title']);
            $menu->setUrl($_POST['url']);
            $menu->setParentId($_POST['parent_id']);
            $MenuService->createSubMenu($menu);
            header('Location: /admin/menu/index');
        }
    }

    public function deleteMenu()
    {
        if (isset($_GET['id'])) {
            $MenuService = new MenuService();
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $MenuService->deleteMenu($menu);
            header('Location: /admin/menu/index');
        }
    }

    public function editMenu()
    {
        $view = new View("Backend/Menu/edit", "back");
        $MenuService = new MenuService();
        $menus = $MenuService->findAllParent();
        $view->assign('menus', $menus);

        if (isset($_GET['id'])) {
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $menu = $MenuService->findOneById($menu);
            $view->assign('menu', $menu);
        }

        if (isset($_POST['submit'])) {
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $menu->setTitre($_POST['titre']);
            $menu->setUrl($_POST['url']);
            $menu->setParentId((int)$_POST['parent_id']);
            if((int)$_POST['parent_id'] == 0) {
                $menu->setParentId(null);
            }
            $MenuService->updateMenu($menu);
            header('Location: /admin/menu/index');
        }
    }

    public function pendingMenu()
    {
        if (isset($_GET['id'])) {
            $MenuService = new MenuService();
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $MenuService->pendingMenu($menu);
            header('Location: /admin/menu/index');
        }
    }

    public function publishMenu()
    {
        if (isset($_GET['id'])) {
            $MenuService = new MenuService();
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $MenuService->publishMenu($menu);
            header('Location: /admin/menu/index');
        }
    }

}