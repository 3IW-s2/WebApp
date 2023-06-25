<?php
namespace App\Services;

use App\Models\Comment;
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

   
}