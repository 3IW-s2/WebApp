<?php
namespace App\Core;

use App\Services\MenuService;

class Menu{

    protected $menuService ;

    public function __construct(){
        $this->menuService = new MenuService();
    }

    public function getAllLink(): array
    {
        $menus = $this->menuService->activeLink();
        $sousmenus = $this->menuService->findAllParent();
        return [$menus, $sousmenus];
    }
    
}