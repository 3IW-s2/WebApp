<?php

namespace App\Controllers;

use App\Core\View;
use App\Services\MenuService;
use App\Services\ArticleService;
use App\Services\CommentaireService;
use App\Controllers\BaseController;
use App\Core\Error;
use App\Core\Menu;
use App\Models\User;
use App\Core\Dump;
use App\Core\Database;
use App\Services\UserService;
use App\Pluggins\Ip;
use App\Repositories\Pluggins\IpRepository;


class Main Extends BaseController
{
   /*  public function home(): void
    {
        $timestamp = time();
        $newTimestamp = strtotime('+2 hours', $timestamp);
        $date = date('Y-m-d H:i:s', $newTimestamp);
        $menuService = new MenuService();
        $menus = $menuService->activeLink();
        $sousmenus = $menuService->findAllParent();
      

        $pseudo = "Prof";
        $view = new View("Main/home", "front");
        $view->assign("menus", $menus);
        $view->assign("sousmenus", $sousmenus);
    } */

    /* public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        echo "Page à propos";
    } */


    public function profile():void
    {
        /* tout pour les stats */
        $newIpRepository = new IpRepository();
        $newIp = new Ip();
        $newIpRepository = $newIpRepository->getAllIp();
        $exist = false;
        if(!empty($newIpRepository)){
           
            foreach($newIpRepository as $ip){
                if($newIp->getIp() == $ip){
                    $exist == true;
                   // break;
                }
            }
            if($exist = false){
                $ipRepo = new IpRepository();
                $ipRepo->AddNewIp($newIp->getIp());
            }
            
        }else{
            $ipRepo = new IpRepository();
            $ipRepo->AddNewIp($newIp->getIp());
        }

        $menuService = new MenuService();
        $menus = $menuService->activeLink();
        $sousmenus = $menuService->findAllParent();
        $view = new View("Main/profile", "front");
        $view->assign("menus", $menus);
        $view->assign("sousmenus", $sousmenus);

        $error = new Error();
        $user  = new User($error);
        $user->setEmail($_SESSION["user"]);
        $userService = new UserService();
        $user = $userService->findByEmail($user);
        $view->assign("user", $user);
        $user_admin = $this->assignMenuVariables()['user_admin'];
        $view->assign("user_admin", $user_admin);

        if (isset($_POST["delete"])) {
            $userId = new User($error);
            $userId->setId($_POST["id"]);
            $userService->deleteUserById($userId);
            header("Location: /logout");
        }

    }
}