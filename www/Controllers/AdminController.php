<?php
namespace App\Controllers;


use App\Core\Error;
use App\Models\User;
use App\Core\View;
use App\Core\Database;
use App\Services\UserService;
use App\Core\Session;
use PDO;



class AdminController
{

    public function index()
    {
        $view = new View("Backend/index", "back");
   

    }

}