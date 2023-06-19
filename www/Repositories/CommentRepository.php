<?php

namespace App\Repositories;

use App\Services\CommentService;
use App\Core\Database;
use App\Models\Comment;
use App\Core\Mail;
use App\Core\Error;
use PDO;
use Exception;

class CommentRepository extends Database 
{
    public function getCommentById(int $id): array
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM comments WHERE id = :id";
        $params = [
            'id' => $id
        ];
        $statement = $db->query($query, $params);
        $comment = $statement->fetch(PDO::FETCH_ASSOC);

        return $comment;
    }
    public function getCommentsByArticleId(int $article_id): array
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM comments WHERE article_id = :article_id AND status = true";
        $params = [
            'article_id' => $article_id
        ];
        $statement = $db->query($query, $params);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    public function getAllComments(): array
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM comments";
        $statement = $db->query($query);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    public function insertComment(Comment $comment): bool
    {
        $db = Database::getInstance();

        $query = "INSERT INTO comments (content, status, article_id, user_id, created_at, updated_at) VALUES (:content, :status, :article_id, :user_id, NOW(), NOW())";
        $params = [
            'content' => $comment->getComment(),
            'status' => $comment->getStatus() == true ? 1 : 0,
            'article_id' => $comment->getArticleId(),
            'user_id' => $comment->getUserId()
        ];
        $statement = $db->query($query, $params);

        return true;
    }

    public function delete(int $id)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM comments WHERE id = :id";
        $params = [
            'id' => $id
        ];
        $statement = $db->query($query, $params);
    }

    public function updateComment(Comment $comment): void
    {
        $db = Database::getInstance();

        $query = "UPDATE comments SET status = :status, updated_at = NOW() WHERE id = :id";
        $params = [
            'id' => $comment->getId(),
            'status' => $comment->getStatus() == true ? 1 : 0
        ];
        $statement = $db->query($query, $params);
    }

    public function signalComment(array  $comment): bool
    {
        $db = Database::getInstance();

        $query = "UPDATE comments SET signaled = :signaled, updated_at = NOW() WHERE id = :id";
        $params = [
            'id' => $comment['id'],
            'signaled' => $comment['signaled'] + 1
        ];
        $statement = $db->query($query, $params);

        return true;
    }

}
