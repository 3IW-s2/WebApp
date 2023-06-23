<?php
namespace App\Controllers;

use App\Core\Error;
use App\Models\Article;
use App\Models\Comment;
use App\Core\View;
use App\Models\User;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use App\Services\ArticleService;
use App\Services\CommentService;
use App\Core\Mail;
use App\Core\Session;
use App\Core\Database;
use App\Services\UserService;

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

    public function showCommentsByPostId($id)
    {
        $view = new View("Main/post", "front");
        $error = new Error();
        $commentService = new CommentService($error);

        $comments = $commentService->getCommentsByArticleId($id);
        /*foreach ($comments as $comment) {
            $userRepo = new UserRepository();
            $User = new User($error);
            $User->setId($comment['user_id']);
            $user = $userRepo->getUserById($User);
            $comment['user_id'] = $user['firstname']." ".$user['lastname'];
        }*/
        $view->assign('comments', $comments);
    }

    public function addComment()
    {
        $error = new Error();
        $error2 = new Error();
        $error3 = new Error();

        $userRepo = new UserRepository();



        if (isset($_GET['slug']) && isset($_GET['user_email'])) {
            $article_slug = $_GET['slug'];
            $user_email = $_GET['user_email'];
        }

        $userService = new UserService($error2);
        $articleService = new ArticleService($error3);
        $user = $userRepo->getUserByEmail($user_email);
        $ArticleService = new ArticleService();
        $Article = new Article();
        $Article->setSlug($article_slug);
        $article = $ArticleService->getArticleBySlug($Article);

         $content = $_POST['content'];
         $user_id = $user['id'];
    
         $comment = new Comment($error);
         $comment->setContent($content);
         $comment->setArticleId($article['id']);
         $comment->setUserId($user_id);
         $comment->setStatus(false);
    
         $commentService = new CommentService($error);

         $comments = $commentService->registerComment($comment);

         if(!$comments){
             $_SESSION['comment'] = false;
         }else{
             $_SESSION['comment'] = true;
         }
        header('Location: /article/'.$article_slug);

    }

    public function updateComment()
    {

        $error = new Error();
        $view = new View("Backend/Comment/edit", "back");

        if (isset($_GET['id'])) {
            $id = $_GET['id'];


            if (isset($_POST['submit'])) {
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

       public function signalComment()
       {
           $error = new Error();

           if (isset($_GET['id']) && isset($_GET['article_slug'])) {
               $id = (int)$_GET['id'];
               $article_slug = $_GET['article_slug'];
              }

           $commentService = new CommentService($error);
           $userService = new UserService($error);
           $comment = $commentService->getCommentById($id);
           $comments = $commentService->signalComment($comment);

           if(!$comments){
               header("Location:/article/".$article_slug."?signal=false");
           }

           $error2 = new Error();
           $newComment = new Comment($error2);

           $comment = $commentService->getCommentById($id);


           if($comment['signaled'] >= 10){
               $newComment->setStatus(false);
               $newComment->setId($id);
               $commentService->updateComment($newComment);
               $userId = $comment['user_id'];
               $User = new User($error);
                $User->setId($userId);
               $user = $userService->getUserById($User);
               $mail = new mail($user['email'], "Votre commentaire a été supprimé", "Votre commentaire a été supprimé car il a été signalé plus de 10 fois");
               $mail->send();
           }

           if(!$comments){
               $_SESSION['signal'] = false;
           }else{
               $_SESSION['signal'] = true;
           }

           header('Location: /article/'.$article_slug);
       }


}
