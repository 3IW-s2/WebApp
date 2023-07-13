<?php 
namespace App\Services;

use App\Models\Article;
use App\Models\ArticleType;
use App\Repositories\ArticleTypeRepository;
use App\Core\Error;
use App\Core\Security;
use App\Core\Database;
use PDO;
use Exception;

class ArticleTypeService
{
    private $articleTypeRepository;

    public function __construct()
    {
        $this->articleTypeRepository = new ArticleTypeRepository();
    }

    public function findAll()
    {
        return $this->articleTypeRepository->findAll();
    }

    public function deleteArticleType( ArticleType $article_type ,Article $article)
    {
        $this->articleTypeRepository->deleteArticleType($article_type , $article);
    }

    public function addArticleType(ArticleType $articleType)
    {
        $this->articleTypeRepository->addArticleType($articleType);
    }

    public function findByName(ArticleType $articleType)
    {
        return $this->articleTypeRepository->findByName($articleType);
    }

    public function findByID(ArticleType $articleType)
    {
        return $this->articleTypeRepository->findByID($articleType);
    }

    public function editArticleType(ArticleType $articleType)
    {
        $this->articleTypeRepository->editArticleType($articleType);
    }

    public function getNameById(ArticleType $articleType)
    {
        return $this->articleTypeRepository->getNameById($articleType);
    }
}