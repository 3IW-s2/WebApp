<?php 
namespace App\Services;

use App\Models\Menu;
use App\Repositories\MenuRepository;
use App\Core\Error;
use App\Core\Security;
use App\Core\Database;
use PDO;
use Exception;

class MenuService
{

    private $menuRepository;

    public function __construct()
    {
        $this->menuRepository = new MenuRepository();
    }

    public function findAll()
    {
        return $this->menuRepository->findAll();
    }

    public function findByTitle( Menu $menu)
    {
        return $this->menuRepository->findByTitle( $menu);
    }

    public function findBySubMenuTitle (Menu $menu)
    {
        return $this->menuRepository->findBySubMenuTitle($menu);
    }

    public function createMenu(Menu $menu){
    
        $this->menuRepository->createMenu($menu);
    }

    public function createSubMenu(Menu $menu){
    
        $this->menuRepository->createSubMenu($menu);
    }

    public function updateMenu(Menu $menu){
    
        $this->menuRepository->updateMenu($menu);
    }

    public function deleteMenu(Menu $menu){
    
        $this->menuRepository->deleteMenu($menu);
    }

    public function findAllParent()
    {
        return $this->menuRepository->findAllParent();
    }

    public function findOneById(Menu $menu)
    {
        return $this->menuRepository->findOneById($menu);
    }

    public function pendingMenu(Menu $menu)
    {
        $this->menuRepository->pendingMenu($menu);
    }

    public function publishMenu(Menu $menu){

        $this->menuRepository->publishMenu($menu);
    }

    public function activeLink(){
        
       return  $this->menuRepository->activeLink();
    }

    public function findAllSubMenu( Menu $menu)
    {
        return $this->menuRepository->findAllSubMenu( $menu);
    }

    public function getAllSubMenu( Menu $menu)
    {
        return $this->menuRepository->getAllSubMenu($menu);
    }

}
