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
        header("Location: /admin/ArticleType/index");
    }

    public function addArticleType()
    {
        $view = new View("Backend/ArticleType/add", "back");
        if(isset($_POST['submit'])){
            $articleType = new ArticleType( $this->error);
            $articleType->setName($_POST['name']);
            $articleTypeService = new ArticleTypeService();
            $arldy_type = $articleTypeService->findByName($articleType);
            if($arldy_type == false){
                 if(!empty($_POST['name'])){
                    $articleTypeService->addArticleType($articleType);
                    header("Location: /admin/articletype/index");
                 }else{
                    $view->assign('error', "Article type name is empty");
                 }
                   
            }else{
                $view->assign('error', "Article type already exist");
            }
           
        }
 
    }

    public function  editArticleType()
    {
        $view = new View("Backend/ArticleType/edit", "back");
        $newArticleType = new ArticleType( $this->error);
        $newArticleType->setId($_GET['id']);
        $allTypes = new ArticleTypeService();
        $articleType = $allTypes->findByID( $newArticleType);
        $view->assign('articleType', $articleType);
        if(isset($_POST['submit'])){
            $articleType = new ArticleType( $this->error);
            $articleType->setId($_GET['id']);
            $articleType->setName($_POST['name']);
            $articleTypeService = new ArticleTypeService();
            $arldy_type = $articleTypeService->findByName($articleType);
            if($arldy_type == false){
                if(!empty($_POST['name'])){
                    $articleTypeService->editArticleType($articleType);
                    header("Location: /admin/articletype/index");
                }else{
                    $view->assign('error', "Article type name is empty");
                }
            }else if( (!empty($_POST['name']) &&  $arldy_type['id'] == $_GET['id'])){
                $articleTypeService->editArticleType($articleType);
                header("Location: /admin/articletype/index");
            }
            else{
                $view->assign('error', "Article type already exist");
            }
        }
    }
}