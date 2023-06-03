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

}