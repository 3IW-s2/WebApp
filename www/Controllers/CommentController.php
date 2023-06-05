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
         $view = new View("Backend/Comment/index", "back");
         $error = new Error();
         $commentService = new CommentService($error);
         $comments = $commentService->getAllComment();
         $view->assign('comments', $comments);
        
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

       $error = new Error();
       $view = new View("Backend/Comment/edit", "back");

       if(isset($_GET['id'])){
          $id = $_GET['id'];
       

       if(isset($_POST['submit'])){
           $status = $_POST['status'] == 'true' ? true : false;
        

       $comment = new Comment($error);
       $comment->setStatus($status);
       $comment->setId($id);

       $commentService = new CommentService();
       $comments = $commentService->updateComment($comment);


       header('Location: /admin/comment/index');

       }
     }


    }

}