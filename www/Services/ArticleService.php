<?php 
namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Core\Error;
use App\Core\Security;
use App\Core\Database;
use PDO;
use Exception;

class ArticleService
{

    private $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

    public function findAll()
    {
        return $this->articleRepository->findAll();
    }

    public function findAllByCategorie($id)
    {
        return $this->articleRepository->findAllByCategorie($id);
    }

    public function findAllByUser($id)
    {
        return $this->articleRepository->findAllByUser($id);
    }

    public function findOne($id)
    {
        return $this->articleRepository->findOne($id);
    }

    public function createArticle(Article $article)
    {
        $this->articleRepository->createArticle($article);
    }
    
    public function updateArticle(Article $article)
    {
        $this->articleRepository->updateArticle($article);
    }

    public function deleteArticle(Article $article)
    {
        $this->articleRepository->deleteArticle($article);
    }

    public function publishArticle(Article $article)
    {
        $this->articleRepository->publishArticle($article);
    }

    public function getArticleBySlug( Article $article)
    {   
     
        return $this->articleRepository->getArticleBySlug($article);
    }

    public function pendingArticle(Article $article)
    {
        return $this->articleRepository->pendingArticle($article);
    }

}