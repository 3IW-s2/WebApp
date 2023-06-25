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

    public function getCommentArticleBySlug(Article $article)
    {
        return $this->commentRepository->getCommentArticleBySlug($article);
    }

   
}