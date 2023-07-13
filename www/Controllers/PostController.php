<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Post;
use App\Models\Article;
use App\Services\PostService;
use App\Repositories\PostRepository;
use App\Services\ArticleService;
use App\Services\CommentService;
use App\Services\ArticleTypeService;
use App\Models\Comment;
use App\Core\Database;
use App\Core\Error;
use App\Core\Menu;

class PostController  Extends BaseController
{
    private $menu;
    private $article ;
    public function __construct()
    {
        $this->menu = new Menu();
        $this->article = new ArticleService();
    }

    public function showPost()
    {   $post = new Post();
        $post->setSlug($_GET['slug']);

      

        if($_GET['slug'] == 'article'){
            $postService = new PostService();
            //var_dump($postService);
            $posts = $postService->getPostBySlug($post);
            $view = new View("Frontend/Post/article", "front");
            $view->assign('posts', $posts);
            $menuss = $this->menu->getAllLink();
            $view->assign("menus", $menuss[0]);
            $view->assign("sousmenus", $menuss[1]);
            $articles = $this->article->findAllActive();
            $view->assign('articles', $articles);
            $user_admin = $this->assignMenuVariables()['user_admin'];
            $ArticleService = new ArticleService();
            $admin_preferences = $ArticleService->getPreferences();
            
            if(isset($_POST['numberArticle'])){
                $ArticleServiceNew = new ArticleService();
                $ArticleServiceNew->updatePreferences($_POST['numberArticle']);
                $admin_preferences = $ArticleServiceNew->getPreferences();
            }
            $view->assign("user_admin", $user_admin);
            $view->assign("admin_preferences", $admin_preferences['number_article']);
           
            $error = new Error();
            $commentService = new CommentService($error);
            //$article->setId(1);
            $comments = $commentService->findAll();
          
            $view->assign('comments', $comments);
        }else{

        $postService = new PostService();
        //var_dump($postService);
        $posts = $postService->getPostBySlug($post);
        $view = new View("Frontend/Post/index", "front");
        $view->assign('posts', $posts);
        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);
        $user_admin = $this->assignMenuVariables()['user_admin'];
        $view->assign("user_admin", $user_admin);
        $ArticleService = new ArticleService();
        $admin_preferences = $ArticleService->getPreferences();
        if(isset($_POST['numberArticle'])){
            $ArticleServiceNew = new ArticleService();
            $ArticleServiceNew->updatePreferences($_POST['numberArticle']);
            $admin_preferences = $ArticleServiceNew->getPreferences();
        }
        $view->assign("admin_preferences", $admin_preferences['number_article']);

        $newPost = new Post();
        $newPost->setSlug($_GET['slug']);
        $newPostService = new PostService();
        $postCategory = $newPostService->getpostCategoryIdBySlug($newPost);
        $newArticle = new Article();
        $newArticle->setCategoryId($postCategory['category_id']);
        $articles = $this->article->findAllActiveByCategoryId($newArticle);
        $view->assign('articles', $articles);
    }
    }


}