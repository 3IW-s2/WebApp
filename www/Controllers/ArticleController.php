<?php

namespace App\Controllers;

use App\Core\Error;
use App\Core\Security;
use App\Models\Article;
use App\Core\View;
use App\Core\Database;
use App\Services\ArticleService;
use App\Core\Session;
use App\Services\CommentService;
use PDO;



class ArticleController
{
    public function previewArticle(){
        $error = new Error();
        $security = new Security($error);

        $ArticleService = new ArticleService();
        $Article = new Article();
        $Article->setSlug($_GET['slug']);
        $article = $ArticleService->getArticleBySlug($Article);
        if ($article == false){
            $error->setCode(404);
            $error->addError("Article introuvable");
            header('Location: /');
        }

        $error2 = new Error();
        $commentService = new CommentService($error2);
        $comments = $commentService->getCommentsByArticleId($article['id']);
        if(isset($_SESSION['signal'])){
            if (!$_SESSION['signal']){
                $errors[] = "Il y a eu un problème avec le signalement du commentaire, veuillez réessayez plus tard.";
            }
            else{
                $errors[] = "Le commentaire a été signalé.";
            }
            unset($_SESSION["signal"]);
        }
        if (isset($_SESSION['comment']) ){
            if(!$_SESSION['comment']){
                $errors[] = "Il y a eu un problème avec l'ajout du commentaire, veuillez réessayer plus tard.";
            }
            else{
                $errors[] = "Votre commentaire a été ajouté, il passera en revu par l'administrateur du site";
            }
            unset($_SESSION["comment"]);
        }
        $view = new View("Main/post", "front");
        $view->assign('comments', $comments);
        $view->assign('article', $article);
        if(isset($errors)){
            $view->assign('errors', $errors);
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
            header('Location: /admin/article/index');
        }
    }
}