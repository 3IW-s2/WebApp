<?php

namespace App\Repositories;

use App\Services\CommentService;
use App\Core\Database;
use App\Models\Comment;
use App\Core\Error;
use PDO;
use Exception;

class CommentRepository extends Database 
{
    private $error;
    private $db;
    private $table = 'comments_2';
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->error = new Error();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $statement = $this->db->query($query);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    public function getCommentById(Comment $comment)
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM  {$this->table} WHERE id = :id";
        $params = [
            'id' => $comment->getId()
        ];
        $statement = $db->query($query, $params);
        $comment = $statement->fetch(PDO::FETCH_ASSOC);

        return $comment;
    }
  
}