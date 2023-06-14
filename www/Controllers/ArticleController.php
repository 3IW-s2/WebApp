<?php

namespace App\Controllers;

use App\Core\Error;
use App\Core\Security;
use App\Models\Article;
use App\Core\View;
use App\Core\Database;
use App\Services\ArticleService;
use App\Core\Session;
use PDO;



class ArticleController
{
    public function previewArticle(){
        $error = new Error();
        $security = new Security($error);
       

        $article = new Article();
        $article->setSlug($_GET['slug']);
        $ArtcileService = new ArticleService();
        $articles = $ArtcileService->getArticleBySlug($article);
        if ($articles == false){
            $error->setCode(404);
            $error->addError("Article introuvable");
            header('Location: /');
        }
        var_dump($articles);
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