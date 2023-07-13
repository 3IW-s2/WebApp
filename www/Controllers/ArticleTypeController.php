<?php

namespace App\Controllers;
use App\Core\Error;
use App\Models\ArticleType;
use App\Models\Article;
use App\Core\View;
use App\Services\ArticleTypeService;


class ArticleTypeController 
{
    private $error ;
    public function __construct()
    {
        $this->error = new Error();
    }
    public function showArticleType():void
    {
        $articleTypeService = new ArticleTypeService( $this->error);
        $articleTypes = $articleTypeService->findAll();
        $view = new View("Backend/ArticleType/index", "back");
        $view->assign('articleTypes', $articleTypes);
    }

    public function DeleteArticleType()
    {
        $article = new Article( $this->error);
        $article->setCategoryId($_GET['id']);        
        $articleType = new ArticleType( $this->error);
        $articleType->setId($_GET['id']);
        $articleTypeService = new ArticleTypeService( $this->error);
        $articleTypeService->deleteArticleType($articleType , $article);
        header("Location: admin/ArticleType/index");
    }
}