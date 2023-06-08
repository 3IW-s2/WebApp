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

}
