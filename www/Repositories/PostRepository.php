<?php
namespace App\Repositories;


use App\Services\PostService;
use App\Core\Database;
use App\Models\Post;
use App\Core\Mail;
use App\Core\Error;
use App\Core\Security;
use PDO;
use Exception;

class  PostRepository  extends Database 
{


    public function getAllPosts(): array
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM posts";
        $statement = $db->query($query);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getPostBySlug(Post $post)
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM posts WHERE slug LIKE :slug";
        $params = [
            'slug' => $post->getSlug()
        ];
        $statement = $db->query($query, $params);
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        
        $error = new Error();
        $security = new Security($error);
        $security->check404($post);
        return $post;
    } 


    public function DetetePostById(Post $post)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM posts WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $db->query($query, $params);
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        
       /*  $error = new Error();
        $security = new Security($error);
        $security->check404($post); */
        return $post;
    }
   
}