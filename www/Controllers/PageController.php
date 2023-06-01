<?php
namespace App\Controllers;


use App\Core\View;
use App\Models\User;
use App\Services\UserService;
use App\Core\Error;

class PageController 
{
    public function showPost()
    {
        $view = new View("Frontend/Post/show");
    }

}