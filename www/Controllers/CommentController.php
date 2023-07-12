<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Core\View;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use App\Core\Mail;
use App\Core\Error;

class CommentController 
{
    private $error ;
    public function __construct()
    {
        $this->error = new Error();
    }
    public function showComments():void
    {
        $commentService = new CommentService( $this->error);
        $comments = $commentService->findAll();
        $view = new View("Backend/Comment/index", "back");
        $view->assign('comments', $comments);
    }

    public function DeleteComment()
    {
        $comment = new Comment( $this->error);
        $comment->setId($_GET['id']);
        $commentService = new CommentService( $this->error);
        $commentService->deleteComment($comment);
        $comments = $commentService->findAll();
        $view = new View("Backend/Comment/index", "back");
        $view->assign('comments', $comments);
    }
}