<?php

namespace App\Repositories;

use App\Services\CommentRepository;
use App\Core\Database;
use App\Models\User;
use App\Core\Mail;
use App\Core\Error;
use PDO;
use Exception;

class  CommentRepository extends Database 
{
    public function getCommentsByArticleId(int article_id): Comment
        $db = Database::getInstance(article_id);

        $query = "SELECT * FROM comment where article_id = :article_id";
        $statement = $db->query($query);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    public function insertComment(Comment $comment):void
    {
        $db = Database::getInstance();

        $query = "INSERT INTO comment (comment, status, article_id, user_id, created_at, updated_at) VALUES (:comment, :status, :article_id, :user_id, NOW(), NOW())";
        $params = [
            'comment' => $comment->getComment(),
            'status' => $comment->getStatus(),
            'article_id' => $comment->getArticleId(),
            'user_id' => $comment->getUserId()
        ];
        $statement = $db->query($query, $params);
    }

    public function delete(int $id)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM comment WHERE id = :id";
        $params = [
            'id' => $id
        ];
        $statement = $db->query($query, $params);
    }

    public function updateComment(Comment $comment):void
    {
        $db = Database::getInstance();

        $query = "UPDATE comment SET status = :status, updated_at = NOW() WHERE id = :id";
        $params = [
            'id' => $comment->getId(),
            'status' => $comment->getStatus()
        ];
        $statement = $db->query($query, $params);
    }

}
