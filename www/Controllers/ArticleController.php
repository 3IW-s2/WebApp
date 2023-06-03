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
}