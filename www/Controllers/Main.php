<?php

namespace App\Controllers;

use App\Core\View;
use App\Services\MenuService;
use App\Services\ArticleService;
use App\Services\CommentaireService;


class Main
{
    public function home(): void
    {
        $timestamp = time();
        $newTimestamp = strtotime('+2 hours', $timestamp);
        $date = date('Y-m-d H:i:s', $newTimestamp);
        $menuService = new MenuService();
        $menus = $menuService->activeLink();
        $sousmenus = $menuService->findAllParent();
      

        $pseudo = "Prof";
        $view = new View("Main/home", "front");
        $view->assign("titleseo", "supernouvellepage");
        $view->assign("menus", $menus);
        $view->assign("sousmenus", $sousmenus);
    }

    /* public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        echo "Page à propos";
    } */

}