<?php
namespace App\Repositories;

use App\Core\Configuration\DatabaseConfiguration;
use App\Services\ArticleService;
use App\Core\Database;
use App\Models\Article;
use App\Core\Mail;
use App\Core\Error;
use App\Core\Security;
use PDO;
use Exception;

class ArticleRepository
{

    private $db;
    private $table;

    public function __construct()
    {
        $this->table = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_"."articles";
        $this->admin_preferences = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_"."admin_preferences";
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->query($query);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

     public function findAllActive()
    {
        $query = "SELECT * FROM {$this->table} WHERE status = '1' ORDER BY created_at DESC";
        $stmt = $this->db->query($query);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    } 

    public function findAllActiveByCategoryId(Article $article)
    {
        $query = "SELECT * FROM {$this->table} WHERE status = '1' AND category_id = :category_id ORDER BY created_at DESC";
        $params = [
            'category_id' => $article->getCategoryId(),
        ];
        $stmt = $this->db->query($query , $params);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

   /*  public function findAllActive($page = 1, $perPage = 3)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM {$this->table} WHERE status = '1' ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";
        $stmt = $this->db->query($query);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    } */

    public function createArticle(Article $article){
       
        $query = "INSERT INTO {$this->table} (title, content, created_at, updated_at , author , status , slug , category_id) VALUES (:title, :content, NOW(), NOW() , :author , :status , :slug , :category_id)";
        $params = [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'author' => $article->getAuthor(),
            'status' => 5,
            'slug' => $article->getSlug(),
            'category_id' => $article->getCategoryId(),

        ];
        $stmt = $this->db->query($query , $params);
    }

    public function updateArticle(Article $article){
       
        $query = "UPDATE {$this->table} SET title = :title, content = :content, slug= :slug , category_id= :category_id WHERE id = :id";
        $params = [
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'slug' => $article->getSlug(),
            'category_id' => $article->getCategoryId(),
        ];
        $stmt = $this->db->query($query , $params);
    }

    public function deleteArticle(Article $article){
       
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $article->getId(),
        ];
        $stmt = $this->db->query($query , $params);
    }


    public function publishArticle (Article $article){
        $query = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $params = [
            'id' => $article->getId(),
            'status' => 1,
        ];
        $stmt = $this->db->query($query , $params);
    }

    public function getArticleBySlug(Article $article){
        $query = "SELECT * FROM {$this->table} WHERE slug = :slug AND status = '1' ";
        $params = [
            'slug' => $article->getSlug(),
        ];
        $stmt = $this->db->query($query , $params);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article;
    }

    public function getArticleBySlug_(Article $article){
        $query = "SELECT * FROM {$this->table} WHERE slug = :slug ";
        $params = [
            'slug' => $article->getSlug(),
        ];
        $stmt = $this->db->query($query , $params);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article;
    }

    public function pendingArticle( Article $article){
        $query = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $params = [
            'id' => $article->getId(),
            'status' => 5,
        ];
        $stmt = $this->db->query($query , $params);
    }

    public function getArticleById( Article $article){
        $query = "SELECT * FROM {$this->table} WHERE id = :id ";
        $params = [
            'id' => $article->getId(),
        ];
        $stmt = $this->db->query($query , $params);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article;
    }

    //pour la pagination
    public function getPreferences(){
        $query = "SELECT number_article FROM {$this->admin_preferences} WHERE id = 1 ";
        $stmt = $this->db->query($query);
        $preferences = $stmt->fetch(PDO::FETCH_ASSOC);

        return $preferences;
    }

    public function updatePreferences($number_article){
        $query = "UPDATE {$this->admin_preferences} SET number_article = :number_article WHERE id = 1";
        $params = [
            'number_article' => $number_article,
        ];
        $stmt = $this->db->query($query , $params);
    }

}
