<?php
namespace App\Controllers;


use App\Core\View;
use App\Models\Post;
use App\Models\History;
use App\Services\PostService;
use App\Services\HistoryService;
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
            $post->setSlug($_POST['slug']);
            $postService = new PostService();
            $posts = $postService->getPostBySlug($post);
           
            if(!empty($post)){
               $error = new Error();
               $error->addError( 'Ce slug existe déjà');
               $view->assign('error', $error);


            }else{
                $post = new Post();
                //$post->setTitle($_POST['title']);
                $post->setContent($_POST['content']);
                $post->setSlug($_POST['slug']);
                $post->setStatus('5');
                $post->setAuthor($_SESSION['user']);
               
                $postService = new PostService();
                $posts = $postService->addPost($post);
                header('Location: /admin/page/index');
            }
        }
       /*  if(isset($_POST['submit']))
        {
        $post = new Post();
       // $post->setTitle($_POST['title']);
        $post->setContent($_POST['content']);
        $post->setSlug($_POST['slug']);
        $post->setStatus('5');
        $post->setAuthor($_SESSION['user']);
       
        $postService = new PostService();
        $posts = $postService->addPost($post);

        } */
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

            $historyModel = new History();
            $historyModel->setEntityId($_GET['id']);
            $historyModel->setEntityType('posts');
            $historyModel->setTableName('posts');

            $historyService = new HistoryService();
            $history = $historyService->getHistoryForEntity($historyModel);
            $view->assign('posts', $posts);
            $view->assign('history', $history); 

           
        }
        if(isset($_POST['submit']))
        {
            $post = new Post();
            $post->setId($_GET['id']);
            //rz$post->setTitle($_POST['title']);
            $post->setContent($_POST['content']);
            $post->setSlug($_POST['slug']);
            $post->setStatus('5');
            $post->setAuthor($_SESSION['user']);

            $data = [
                'id' => $_GET['id'],    
                //'title' => $_POST['title'],
                'content' => $_POST['content'],
                'slug' => $_POST['slug'],
                'status' => '5',
                'author' => $_SESSION['user']
            ];
           

            $postService = new PostService();
            $posts = $postService->updatePost($post);

            $historyModel->setContent(json_encode($data));
            $historyModel->setAction('update');
            $historyService->addHistory($historyModel);
            
            unset($_POST);
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