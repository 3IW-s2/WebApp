<?php

namespace App\Repositories;

use App\Services\CommentService;
use App\Models\Article;
use App\Core\Database;
use App\Models\Comment;
use App\Core\Error;
use PDO;
use Exception;

class CommentRepository extends Database 
{
    private $error;
    private $db;
    private $table = 'comments';
    private $article_table = 'articles';
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->error = new Error();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table} ";
        $statement = $this->db->query($query);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    public function getCommentById(Comment $comment)
    {
        $query = "SELECT * FROM  {$this->table} WHERE id = :id";
        $params = [
            'id' => $comment->getId()
        ];
        $statement = $this->db->query($query, $params);
        $comment = $statement->fetch(PDO::FETCH_ASSOC);

        return $comment;
    }

    public function getCommentsByArticleId( Article $article)
    {
        $query = "SELECT * FROM {$this->table} WHERE article_id = :article_id";
        $params = [
            'article_id' => $article->getId()
        ];
        $statement = $this->db->query($query, $params);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;

    }

    public function getCommentArticleBySlug (Article $article)
    {
        $query_1 = "SELECT id FROM {$this->article_table} WHERE slug = :slug";
        $params =[
            'slug' => $article->getSlug()
        ];
        $statement = $this->db->query($query_1, $params);
        $articleId = $statement->fetchAll(PDO::FETCH_ASSOC);
        $query_2 = "SELECT * FROM {$this->table} WHERE  article_id = :article_id AND status BETWEEN '10' AND '20'";
        $params = [
            'article_id' => $articleId[0]['id']
        ];
        $statement = $this->db->query($query_2, $params);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $comments;
    }

    public function deleteCommentArticleBySlug (Article $article)
    {
        $query_1 = "SELECT id FROM {$this->article_table} WHERE slug = :slug";
        $params =[
            'slug' => $article->getSlug()
        ];
        $statement = $this->db->query($query_1, $params);
        $articleId = $statement->fetchAll(PDO::FETCH_ASSOC);
        $query_2 = "DELETE FROM {$this->table} WHERE  article_id = :article_id";
        $params = [
            'article_id' => $articleId[0]['id']
        ];
        $statement = $this->db->query($query_2, $params);
    }

    public function deleteCommentArticleById(Article $article)
    {
        $query = "DELETE FROM {$this->table} WHERE article_id = :article_id";
        $params = [
            'article_id' => $article->getId()
        ];
        $statement = $this->db->query($query, $params);
    }

    public function deleteComment(Comment $comment)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $comment->getId()
        ];
        $statement = $this->db->query($query, $params);
    }

    public function addComment(Comment $comment)
    {
        $query = "INSERT INTO {$this->table} (content, created_at, updated_at, article_id, user_id, status) 
                  VALUES (:content, NOW() + INTERVAL '2 hour', NOW() + INTERVAL '2 hour', :article_id, :user_id, 10)";
        $params = [
            'content' => $comment->getContent(),
            'article_id' => $comment->getArticleId(),
            'user_id' => $comment->getUserId()
        ];
        $statement = $this->db->query($query, $params);
    }
    


    public function reportComment (Comment $comment)
    {
         $query = "UPDATE {$this->table} SET status = CAST(status AS INTEGER) + 1 WHERE id = :id";
            $params = [
                'id' => $comment->getId()
            ];
            $statement = $this->db->query($query, $params);

    }

    public function getSignalById(Comment $comment)
    {
        $query = "SELECT status FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $comment->getId()
        ];
        $statement = $this->db->query($query, $params);
        $signal = $statement->fetch(PDO::FETCH_ASSOC);

        return $signal;
    }
  
}