<?php
namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use App\Core\Database;
use App\Core\Error;
use App\Core\Security;

class CommentService extends Database 
{
    private $commentRepo;
    private $error;
    protected $checkConnexion;

    public function __construct()
    {
        $this->commentRepo = new CommentRepository();
        $this->error = new Error();
    }

    public function registerComment(Comment $comment): bool
    {
        $commentCreated = $this->commentRepo->register($comment);

        try {
            if ($commentCreated) {
                return true;
            } else {
                $this->error->addError("Une erreur s'est produite lors de l'enregistrement du commentaire");
                return false;
            }
        } catch (\Exception $e) {

            return false;
        }
    }

    public function getAllComment(): array
    {
        return $this->commentRepo->GetAllComments();
    }

    public function getCommentsByPostId(int $post_id)
    {
    
       return  $this->commentRepo->getCommentsByPostId($post_id);
     
    }

    public function updateComment ( Comment $comment)
    {
        return $this->commentRepo->updateComment($comment);
    }

    public function deleteCommentById(int $id): void
    {
        $this->commentRepo->delete($id);
    }

}

