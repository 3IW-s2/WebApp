<?php

namespace App\Controllers;

use App\Core\Error;
use App\Models\Article;
use App\Core\View;
use App\Core\Database;
use App\Services\ArticleService;
use App\Core\Session;
use PDO;



class ArticleController
{
    public function showArticle()
    {
        $view = new View("Backend/Article/index", "back");
        $ArtcileService = new ArticleService();
        $articles = $ArtcileService->findAll();
        $view->assign('articles', $articles);
    }

    public function addArticle()
    {
        $view = new View("Backend/Article/add", "back");
        $ArtcileService = new ArticleService();
        $articles = $ArtcileService->findAll();
        $view->assign('articles', $articles);

        if (isset($_POST['submit'])) {
            $article = new Article();
            $article->setTitre($_POST['titre']);
            $article->setContenu($_POST['contenu']);
            $article->setDate($_POST['date']);
            $article->setAuteur($_POST['auteur']);
            $article->setCategorie($_POST['categorie']);
            $ArtcileService->createArticle($article);
            header('Location: /admin/article/index');
        }
    }
}