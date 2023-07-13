<?php
namespace App\Repositories;

use App\Core\Configuration\DatabaseConfiguration;
use App\Services\ArticleTypeService;
use App\Core\Database;
use App\Models\ArticleType;
use App\Models\Article;
use App\Core\Error;
use PDO;
use Exception;

class ArticleTypeRepository
{
    private $db;
    private $table;

    public function __construct()
    {
        $this->article_table = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_"."articles";
        $this->type_article_table = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_"."article_types";
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->type_article_table} ";
        $statement = $this->db->query($query);
        $article_types = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $article_types;
    }

    public function deleteArticleType(ArticleType $articleType , Article $article)
    {
       $query_1 ="DELETE FROM {$this->article_table} WHERE category_id = :category_id";
        $params_1 = [
              'category_id' => $article->getCategoryId(),
         ];
        $stmt_1 = $this->db->query($query_1 , $params_1);

        $query_2 ="DELETE FROM {$this->type_article_table} WHERE id = :id";
        $params_2 = [
              'id' => $articleType->getId(),
         ];

        $stmt_2 = $this->db->query($query_2 , $params_2);

    }


}