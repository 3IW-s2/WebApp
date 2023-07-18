<?php

namespace App\Controllers;

use App\Core\Error;
use App\Models\Menu;
use App\Core\View;
use App\Core\Database;
use App\Services\MenuService;
use App\Core\Session;
use PDO;



class MenuController extends BaseController
{

    public function showMenu()
    {
        $view = new View("Backend/Menu/index", "back");
        $MenuService = new MenuService();
        $menus = $MenuService->findAll();
        $view->assign('menus', $menus);
        $newMenuService = new MenuService();
        $subMenu = $newMenuService->findAll();
        $view->assign('subMenu', $subMenu);
    }

    public function addMenu()
    {
        $view = new View("Backend/Menu/add", "back");
        $MenuService = new MenuService();
        $menus = $MenuService->activeLink();
        $view->assign('menus', $menus);
            if (isset($_POST['submit'])) {  
                $_POST['url'] = $this->NormalizerSlug($_POST['url']);
                $menuVerif = new Menu();
                $menuVerif->setTitre($_POST['title']);
                $menuServiceVerif = new MenuService();
                $menusVerif = $menuServiceVerif->findByTitle($menuVerif);
                if(empty($menusVerif) && !empty($_POST['title']) && !empty($_POST['url'])){
                    $menu = new Menu();
                    $menu->setTitre($_POST['title']);
                    $menu->setUrl($_POST['url']);
                    $MenuService->createMenu($menu);
                    header('Location: /admin/menu/index');
                } 
                if(!empty($menusVerif)){
                    $view->assign('errors', "Ce slug existe déjà");
                }
                if(empty($_POST['title']) || empty($_POST['url'])){
                    $view->assign('errors', "Veuillez remplir tous les champs");
                }
                if(empty($_POST['url'])){
                    $view->assign('errors', "Veuillez remplirl'url");
                }
                if(empty($_POST['title'])){
                    $view->assign('errors', "Veuillez remplir le titre");
                }
           
            }
        
            if (isset($_POST['submit-submenu'])) {
                $_POST['url'] = $this->NormalizerSlug($_POST['url']);
                $menuVerif = new Menu(); 
                $menuVerif->setTitre($_POST['title']);
                $menuVerif->setParentId($_POST['parent_id']);
                $menuServiceVerif = new MenuService();
                $menusVerif = $menuServiceVerif->findBySubMenuTitle($menuVerif);
                if(empty($menusVerif) &&  !empty($_POST['title']) && !empty($_POST['url'])){
                    $menu = new Menu();
                    $menu->setTitre($_POST['title']);
                    $menu->setUrl($_POST['url']);
                    $menu->setParentId($_POST['parent_id']);
                    $MenuService->createSubMenu($menu);
                    header('Location: /admin/menu/index');
                }
                if(!empty($menusVerif)){
                    $view->assign('errors', "Ce slug existe déjà");
                }
                if(empty($_POST['title']) || empty($_POST['url'])){
                    $view->assign('errors', "Veuillez remplir tous les champs");
                }
                if(empty($_POST['url'])){
                    $view->assign('errors', "Veuillez remplirl'url");
                }
                if(empty($_POST['title'])){
                    $view->assign('errors', "Veuillez remplir le titre");
                }
            }

    }

    public function deleteMenu()
    {
        if (isset($_GET['id'])) {
            $MenuService = new MenuService();
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $MenuService->deleteMenu($menu);
            $MenuService->findAllSubMenu($menu);
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
            $_POST['url'] = $this->NormalizerSlug($_POST['url']);
            $menuVerif = new Menu();
            $menuVerif->setTitre($_POST['titre']);
            $menuVerif->setParentId((int)$_POST['parent_id']);
            $menuServiceVerif = new MenuService();
            $menusVerif = $menuServiceVerif->findByTitle($menuVerif);
            $subMenuVerif = $menuServiceVerif->findBySubMenuTitle($menuVerif);
            $menusVerifId = $menusVerif[0]['menu_id'] ?? 0;
            $subMenuVerifId = $subMenuVerif[0]['menu_id'] ?? 0;
            //var_dump((int)$_POST['parent_id']);die;
            /* var_dump($menusVerifId);
            var_dump((int)$_GET['id']);
            var_dump($menusVerifId  === (int)$_GET['id']);die; */
            if((int)$_POST['parent_id'] == 0){

                
                if( (!empty($menusVerif) &&($menusVerifId  == (int)$_GET['id'])) || (empty($menusVerif)) ){
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
                if(!empty($menusVerif)){
                    $view->assign('error', "Ce titre  existe déjà");
                }
                if(empty($_POST['titre'])){
                    $view->assign('error', "Le titre ne peut pas être vide");
                }
                if(empty($_POST['url'])){
                    $view->assign('error', "L'url ne peut pas être vide");
                }

            
            }else{
                if( (!empty($subMenuVerif) &&($subMenuVerifId  == (int)$_GET['id'])) || (empty($subMenuVerif)) ){
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
                if(!empty($subMenuVerif)){
                    $view->assign('error', "Ce sous-titre existe déjà");
                }
                if(empty($_POST['titre'])){
                    $view->assign('error', "Le titre ne peut pas être vide");
                }
                if(empty($_POST['url'])){
                    $view->assign('error', "L'url ne peut pas être vide");
                }


            } 
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