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
    public static function urlVerfif( String $url)
    {
        $url = substr_replace( $url , '/', 0, 0 );
        return $url;
    }

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
                $menuVerif = new Menu();
                $menuVerif->setTitre($_POST['title']);
                $menuServiceVerif = new MenuService();
                $menusVerif = $menuServiceVerif->findByTitle($menuVerif);
                if(empty($menusVerif)){
                    $_POST['url'] = MenuController::urlVerfif($_POST['url']);
                    $menu = new Menu();
                    $menu->setTitre($_POST['title']);
                    $menu->setUrl($_POST['url']);
                    $MenuService->createMenu($menu);
                    header('Location: /admin/menu/index');
                } 
                $view->assign('errors', "Ce titre existe déjà");
           
            }
        
            if (isset($_POST['submit-submenu'])) {
                $menuVerif = new Menu(); 
                $menuVerif->setTitre($_POST['title']);
                $menuVerif->setParentId($_POST['parent_id']);
                $menuServiceVerif = new MenuService();
                $menusVerif = $menuServiceVerif->findBySubMenuTitle($menuVerif);
                if(empty($menusVerif)){
                    $_POST['url'] = MenuController::urlVerfif($_POST['url']);
                    $menu = new Menu();
                    $menu->setTitre($_POST['title']);
                    $menu->setUrl($_POST['url']);
                    $menu->setParentId($_POST['parent_id']);
                    $MenuService->createSubMenu($menu);
                    header('Location: /admin/menu/index');
                }
                $view->assign('error', "Ce sous-titre existe déjà");   
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

            $menuVerif = new Menu();
            $menuVerif->setTitre($_POST['titre']);
            $menuVerif->setParentId((int)$_POST['parent_id']);
            $menuServiceVerif = new MenuService();
            $menusVerif = $menuServiceVerif->findByTitle($menuVerif);
            $subMenuVerif = $menuServiceVerif->findBySubMenuTitle($menuVerif);
            $menusVerifId = $menusVerif[0]['menu_id'] ?? 0;
            $subMenuVerifId = $subMenuVerif[0]['menu_id'] ?? 0;
            if( ( (!empty($menusVerif) && !empty($subMenuVerif)) &&($menusVerifId || $subMenuVerifId) == (int)$_GET['id']) || (empty($menusVerif) && empty($subMenuVerif)) ){

                $_POST['url'] = MenuController::urlVerfif($_POST['url']);
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
            $view->assign('error', "Ce titre ou sous-menu existe déjà");
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