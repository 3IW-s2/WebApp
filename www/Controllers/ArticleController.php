<?php

namespace App\Controllers;

use App\Core\Error;
use App\Core\Security;
use App\Core\Mail;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Core\View;
use App\Core\Database;
use App\Services\ArticleService;
use App\Core\Session;
use App\Core\Menu;
use App\Services\CommentService;
use App\Services\UserService;

use PDO;



class ArticleController
{
    private $menu;
    private $article ;
    private $commentService;
    private $userService;
    public function __construct()
    {
        $this->menu = new Menu();
        $this->article = new ArticleService();
        $this->commentService =new CommentService(new Error());
        $this->userService = new UserService(new Error());
    }

    public function previewArticle(){
        $error = new Error();
        $security = new Security($error);
       

        $article = new Article();
        $article->setSlug($_GET['slug']);
        $ArtcileService = new ArticleService();
        $articles = $ArtcileService->getArticleBySlug($article);

        if($articles == false){
            $error->setCode(404);
            $error->addError("Article introuvable");
            header('Location: /');
        }

        $view = new View("Frontend/Article/index", "front");
        $view->assign('articles', $articles);
        $menuss = $this->menu->getAllLink();
        $view->assign("menus", $menuss[0]);
        $view->assign("sousmenus", $menuss[1]);

        
        $comments = $this->commentService->getCommentArticleBySlug($article);
        $user = new User(new Error() );
        $user = $user->setId($comments[0]['user_id']);
        $user = $this->userService->getUserById($user);
        if($user != false){
            $user = $user['firstname'].' '.$user['lastname'];
        }else{
            $user = 'Utilisateur supprimer';
        }
        
        $view->assign('user', $user);
        $view->assign('comments', $comments);

        if ($articles == false){
            $error->setCode(404);
            $error->addError("Article introuvable");
            header('Location: /');
        }

        if (isset($_POST['submit'])){
            if (empty($_POST['content'])){
                $error->addError("Veuillez remplir le champ");
                $view->assign('errors', $error->getErrors());
                
            }
            if ($error->hasErrors()){
                $view->assign('errors', $error->getErrors());
               
            }
           
            $comment = new Comment( new Error());
            $userService = new UserService(new Error());
            $user = new User(new Error());
            $user = $user->setEmail($_SESSION['user']);
            $user = $userService->getUserIdByEmail($user);
            $comment->setContent(strip_tags($_POST['content']));
            $comment->setArticleId($articles['id']);
            $comment->setUserId($user);
            $comment->setStatus(10);
            $this->commentService->addComment($comment);
            unset($_POST);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
      
           

        }
       if(isset($_POST['signaler'])){
              $comment = new Comment(new Error());
              $comment->setId($_POST['id']);
              $infoComment = $this->commentService->getCommentById($comment);   
              $userId = $infoComment['user_id'];
              $user = new User(new Error());
              $user = $user->setId($userId);
              $user = $this->userService->findById($user);
              $this->commentService->reportComment($comment);
              $email = $user['email'];
              $mail = new Mail( $email , 'Commentaire signaler', 'Votre commentaire a ete signale');
              $mail->send();
              unset($_POST);
              header('Location: ' . $_SERVER['REQUEST_URI']);
              exit();
       }
    }

    public function pendingArticle(){
        if (isset($_GET['id'])){
            $article = new Article();
            $article->setId($_GET['id']);
            $ArtcileService = new ArticleService();
            $articles = $ArtcileService->pendingArticle($article);
            header('Location: /admin/article/index');
        }
    }
    public function showArticle()
    {
        $view = new View("Backend/Article/index", "back");
        $ArtcileService = new ArticleService();
        $articles = $ArtcileService->findAll();
        $view->assign('articles', $articles);
    }

    public function publishArticle ()
    {
        if (isset($_GET['id'])) {
            $ArtcileService = new ArticleService();
            $article = new Article();
            $article->setId($_GET['id']);
            $ArtcileService->publishArticle($article);
            header('Location: /admin/article/index');
        }
    }

    public function addArticle()
    {
        $view = new View("Backend/Article/add", "back");
        $ArtcileService = new ArticleService();
        $articles = $ArtcileService->findAll();
        $view->assign('articles', $articles);

        if (isset($_POST['submit'])) {
            $article = new Article();
            $article->setTitle($_POST['title']);
            $article->setContent($_POST['content']);
            $article->setAuthor($_SESSION['user']);
            $article->setSlug($_POST['slug']);
            $ArtcileService->createArticle($article);
            header('Location: /admin/article/index');
        }
    }

    public function deleteArticle()
    {
        if (isset($_GET['id'])) {
            $ArtcileService = new ArticleService();
            $article = new Article();
            $article->setId($_GET['id']);
            $ArtcileService->deleteArticle($article);
            $this->commentService->deleteCommentArticleById($article);
            header('Location: /admin/article/index');
        }
    }

    public function editArticle()
    {
    if (isset($_GET['id'])) {
        $view = new View("Backend/Article/edit", "back");
        $ArtcileService = new ArticleService();
        $article = new Article();
        $article->setId($_GET['id']);
        $articles = $ArtcileService->getArticleById($article);
        $view->assign('articles', $articles);
        
        $date =new \DateTime (date('Y-m-d H:i:s'));
        $date = $date->format('Y-m-d');

        
       
            if (isset($_POST['submit'])) {
                $article = new Article();
                $article->setId($_GET['id']);
                $article->setTitle($_POST['title']);
                $article->setContent($_POST['content']);
                $article->setSlug($_POST['slug']);
                //$article->setupdate_at($date->format('Y-m-d'));
                $ArtcileService->updateArticle($article) ;
                
                header('Location: /admin/article/index');
            }

         }
    }


    
}