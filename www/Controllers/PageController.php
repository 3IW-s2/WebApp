<?php
namespace App\Controllers;


use App\Core\View;
use App\Models\User;
use App\Services\PostService;
use App\Core\Database;
use App\Core\Error;


class PageController  
{
    public function showPost()
    {
        $view = new View("Backend/Page/index", "back");
        $postService = new PostService();
        $posts = $postService->getAllsposts();
        $view->assign('posts', $posts);
    }

}