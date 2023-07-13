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
}