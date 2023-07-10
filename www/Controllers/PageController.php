<?php
namespace App\Controllers;


use App\Core\View;
use App\Models\Post;
use App\Models\History;
use App\Services\PostService;
use App\Services\HistoryService;
use App\Core\Database;
use App\Core\Error;


class PageController  Extends BaseController
{
    private $post;
    private $postService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->post = new Post();

    }
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
         $postverif = new Post();
         $postverif->setSlug($_POST['slug']);
         $postServiceVerif = new PostService(); 
         $postsverif = $postServiceVerif->getPostBySlugBy( $postverif);

         if(empty($postsverif)){
       
                $post = new Post();
            // $post->setTitle($_POST['title']);
                $post->setContent($_POST['content']);
                $post->setSlug($_POST['slug']);
                $post->setStatus('5');
                $post->setAuthor($_SESSION['user']);
                if(isset(($_POST['active'] )))
                {
                    $post->setImage_path('on');
                }
                else
                {
                    $post->setImage_path('off');
                }

                $postService = new PostService();
                $posts = $postService->addPost($post);
                header('Location: /admin/page/index');
            }
            $view->assign('errors', "Slug already exist");     

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
         $postverif = new Post();
         $postverif->setSlug($_POST['slug']);
         $postServiceVerif = new PostService(); 
         $postsverif = $postServiceVerif->getPostBySlugBy( $postverif); 
         if((!empty($postsverif) && $postsverif[0]['id'] == $_GET['id']) || empty($postsverif)){

            $post = new Post();
            $post->setId($_GET['id']);
            //rz$post->setTitle($_POST['title']);
            $post->setContent($_POST['content']);
            $post->setSlug($_POST['slug']);
            $post->setStatus('5');
            $post->setAuthor($_SESSION['user']);
            if(isset(($_POST['active'] )))
            {
                $post->setImage_path('on');
            }
            else
            {
                $post->setImage_path('off');
            }

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
            $view->assign('errors', "Slug already exist");     

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