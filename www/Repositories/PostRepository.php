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

    private $db;
    private $table = 'posts';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    public function getAllPosts(): array
    {    

        $query = "SELECT * FROM posts";
        $statement = $this->db->query($query);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getPostBySlug(Post $post)
    {  

        $query = "SELECT * FROM posts WHERE slug = :slug AND status = '1'";
        $params = [
            'slug' => $post->getSlug()
        ];
        $statement = $this->db->query($query, $params);
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        
        $error = new Error();
        $error->addError("Article introuvable");
        $security = new Security($error);
        $security->check404($post);
        return $post;
    } 

    public function getPostById(Post $post)
    {

        $query = "SELECT * FROM posts WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $post;
    }


    public function DetetePostById(Post $post)
    {
        $query = "DELETE FROM posts WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);

    }

    public function AddPost(Post $post)
    {

        $query = "INSERT INTO posts (/* title, */ author ,content, status, slug) VALUES (/* :title, */ :author , :content, :status, :slug)";
        $params = [
            //'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'content' => $post->getContent(),
            'status' => $post->getStatus(),
            'slug' => $post->getSlug()
        ];
        $statement = $this->db->query($query, $params);
    }

    public function updatePost(Post $post)
    {

        $query = "UPDATE posts SET title = :title, author = :author, content = :content, status = :status, slug = :slug WHERE id = :id";
        $params = [
            'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'content' => $post->getContent(),
            'status' => $post->getStatus(),
            'slug' => $post->getSlug(),
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
    }


    public function pendingPost(Post $post)
    {

        $query = "UPDATE posts SET status = '5' WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
    }

    public function publishPost(Post $post)
    {

        $query = "UPDATE posts SET status = '1' WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
    }
   
}