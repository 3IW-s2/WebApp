<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Post;
use App\Services\PostService;
use App\Repositories\PostRepository;
use App\Core\Database;
use App\Core\Error;
use App\Core\Menu;

class PostController 
{
    private $menu;
    public function __construct()
    {
        $this->menu = new Menu();
    }

    public function showPost()
    {   $post = new Post();
        $post->setSlug($_GET['slug']);

        $postService = new PostService();
        //var_dump($postService);
        $posts = $postService->getPostBySlug($post);
        $view = new View("Frontend/Post/index", "front");
        $view->assign('posts', $posts);
        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);
    }


}