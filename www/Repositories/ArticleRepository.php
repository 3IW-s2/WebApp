<?php
namespace App\Repositories;

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
    private $table = "articles";

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->query($query);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

    public function createArticle(Article $article){
       
        $query = "INSERT INTO {$this->table} (title, content, created_at, updated_at , author , status) VALUES (:title, :content, NOW(), NOW() , :author , :status )";
        $params = [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'author' => $article->getAuthor(),
            'status' => 5,

        ];
        $stmt = $this->db->query($query , $params);
    }

    public function updateArticle(Article $article){
       
        $query = "UPDATE {$this->table} SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id";
        $params = [
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'updated_at' => $article->getUpdatedAt(),
            'author' => $article->getAuthor(),
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

    public function pendingArticle( Article $article){
        $query = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $params = [
            'id' => $article->getId(),
            'status' => 5,
        ];
        $stmt = $this->db->query($query , $params);
    }

}
