<?php

namespace App\Controllers;

use App\Services\MenuService;
use App\Services\UserService;
use App\Core\View;
use App\Core\Error;
use App\Models\User;

class BaseController 
{
    public function __construct()
    {   
       BaseController::assignMenuVariables();   
    }

    public static  function assignMenuVariables()
    {
        $menuService = new MenuService();
        $menus = $menuService->activeLink();
        $sousmenus = $menuService->findAllParent();
        $user = new User( new Error());
        $user->setEmail($_SESSION["user"]);
        $userService = new UserService();
        $user = $userService->findByEmail($user);
        $user_admin =  $user['role'];
        $numberArticle = 3;


        return [
            'user_admin' => $user_admin,
            'numberArticle' => $numberArticle,
        ];
        
    }

    public function NormalizerSlug($slug){
        $slug = str_replace(
            array('à', 'â', 'ä', 'á', 'ã', 'å', 'À', 'Â', 'Ä', 'Á', 'Ã', 'Å', 'é', 'è', 'ê', 'ë', 'É', 'È', 'Ê', 'Ë', 'í', 'ì', 'î', 'ï', 'Í', 'Ì', 'Î', 'Ï', 'ð', 'ò', 'ô', 'ö', 'õ', 'ð', 'Ò', 'Ô', 'Ö', 'Õ', 'Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'û', 'ü', 'ý', 'ÿ', 'Ý', 'ç', 'Ç', 'Ñ', 'ñ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'A', 'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'o', 'o', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'y', 'y', 'Y', 'c', 'C', 'N', 'n'),
            $slug
        );
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);

        return $slug;
    }
  


    
}
