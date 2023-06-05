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
    public function getCommentsByArticleId(int $post_id ): array
    {
        $db = Database::getInstance($post_id);

        $query = "SELECT * FROM comments WHERE post_id = :post_id AND status = true";
        $statement = $db->query($query);
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

    public function insertComment(Comment $comment):void
    {
        $db = Database::getInstance();

        $query = "INSERT INTO comments (comment, status, post_id, user_id, created_at, updated_at) VALUES (:comment, :status, :post_id, :user_id, NOW(), NOW())";
        $params = [
            'comment' => $comment->getComment(),
            'status' => $comment->getStatus(),
            'post_id' => $comment->getArticleId(),
            'user_id' => $comment->getUserId()
        ];
        $statement = $db->query($query, $params);
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

}
