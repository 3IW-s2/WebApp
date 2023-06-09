<?php
namespace App\Controllers;


use App\Core\View;
use App\Models\Post;
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

    public function DetetePostById()
    {
        $view = new View("Backend/Page/index", "back");
        $postService = new PostService();
        $posts = $postService->getAllsposts();
        $view->assign('posts', $posts);
    }

    public function AddPost()
    {
        $view = new View("Backend/Page/add", "back");
        if(isset($_POST['submit']))
        {
        $post = new Post();
        $post->setTitle($_POST['title']);
        $post->setContent($_POST['content']);
        $post->setSlug($_POST['slug']);
        $post->setStatus('1');
        $post->setAuthor($_SESSION['user']);
       
        $postService = new PostService();
        $posts = $postService->addPost($post);

        }
    }

    public function  deletePost()
    {
       if(isset($_GET['id']))
       {
        $post = new Post();
        $post->setId($_GET['id']);
        $postService = new PostService();
        $posts = $postService->DetetePostById($post);
        header('Location: /admin/page/index');
       }
    }

    public function editPost()
    {
        $view = new View("Backend/Page/edit", "back");
        if(isset($_GET['id']))
        {
            $post = new Post();
            $post->setId($_GET['id']);
            $postService = new PostService();
            $posts = $postService->getPostById($post);
            $view->assign('posts', $posts);
        }
        if(isset($_POST['submit']))
        {
            $post = new Post();
            $post->setId($_GET['id']);
            $post->setTitle($_POST['title']);
            $post->setContent($_POST['content']);
            $post->setSlug($_POST['slug']);
            $post->setStatus('1');
            $post->setAuthor($_SESSION['user']);
            $postService = new PostService();
            $posts = $postService->updatePost($post);
            header('Location: /admin/page/index');
        }
    }


    public function pendingPost()
    {
        if (isset($_GET['id'])){
            $post = new Post();
            $post->setId($_GET['id']);
            $postService = new PostService();
            $posts = $postService->pendingPost($post);
            header('Location: /admin/page/index');
        }
    }

    public function publishPost()
    {
        if (isset($_GET['id'])) {
            $post = new Post();
            $post->setId($_GET['id']);
            $postService = new PostService();
            $posts = $postService->publishPost($post);
            header('Location: /admin/page/index');
        }
    }
    

}