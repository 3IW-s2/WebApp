<?php
namespace App\Services;

use App\Models\Comment;
use App\Models\Article;
use App\Repositories\CommentRepository;
use App\Core\Database;
use App\Core\Error;
use App\Core\Security;

class CommentService extends Database 
{
    private $commentRepository;

    public function __construct(Error $error)
    {
        parent::__construct($error);
        $this->commentRepository = new CommentRepository();
    }

    public function findAll()
    {
        return $this->commentRepository->findAll();
    }

    public function  getCommentById(Comment $comment)
    {
        return $this->commentRepository->getCommentById($comment);
    }

    public function getCommentsByArticleId(Article $article)
    {
        return $this->commentRepository->getCommentsByArticleId($article);
    }

    public function deleteCommentArticleBySlug(Article $article)
    {
        $this->commentRepository->deleteCommentArticleBySlug($article);
    }

    public function deleteCommentArticleById(Article $article)
    {
        $this->commentRepository->deleteCommentArticleById($article);
    }

    public function deleteComment(Comment $comment)
    {
        $this->commentRepository->deleteComment($comment);
    }

    public function getCommentArticleBySlug(Article $article)
    {
        return $this->commentRepository->getCommentArticleBySlug($article);
    }

    public function addComment (Comment $comment)
    {
        $this->commentRepository->addComment($comment);
    }

    public function reportComment(Comment $comment)
    {
        $this->commentRepository->reportComment($comment);
    }

    public function getSignalById(Comment $comment)
    {
        return $this->commentRepository->getSignalById($comment);
    }



   
}