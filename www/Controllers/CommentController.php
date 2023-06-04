<?php
namespace App\Controllers;

use App\Core\Error;
use App\Models\Comment;
use App\Core\View;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use App\Core\Database;

class CommentController 
{
    public function showComments():void
    {
         $view = new View("Backend/Comment/comment", "back");
         $error = new Error();
         $commentService = new CommentService($error);
         $comments = $commentService->getAllComment();
         $view->assign('comments', $coments);
        
    }

    public function addComment()
    {
         $content = $_POST['content'];
         $post_id = $_POST['post_id'];
         $user_id = $_POST['user_id'];
         $status = false;
    
         $comment = new Comment();
         $comment->setContent($content);
         $comment->setPostId($post_id);
         $comment->setUserId($user_id);
         $comment->setStatus($status);
    
         $commentService = new CommentService($error);
         $comments = $commentService->registerComment($comment);

    }

    public function updateComment()
    {

       $status = $_POST['status'];
       $id = $_POST['id'];

       $comment = new Comment();
       $comment->setStatus($status);
       $comment->setId($id);

       $commentService = new CommentService($error);
       $comments = $commentService->updateComment($comment);


}