<?php
namespace App\Repositories;


use App\Core\Configuration\DatabaseConfiguration;
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
    private $table;

    public function __construct()
    {
        $this->table = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_".'posts';
        $this->db = Database::getInstance();
    }


    public function getAllPosts(): array
    {    

        $query = "SELECT * FROM {$this->table}";
        $statement = $this->db->query($query);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getAllPostsActive()
    {
        $query = "SELECT * FROM posts WHERE status = '1' ";
        $statement = $this->db->query($query);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getAllSlug()
    {    

        $query = "SELECT slug FROM {$this->table}";
        $statement = $this->db->query($query);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }
    public function getPostBySlugBy(Post $post)
    {  
            $query = "SELECT * FROM {$this->table} WHERE slug = :slug";
            $params = [
                'slug' => $post->getSlug()
            ];
            $statement = $this->db->query($query, $params);
            $post = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $post;
    }

    public function getPostBySlugVerif(Post $post)
    {  

        $query = "SELECT * FROM {$this->table} WHERE slug = :slug ";
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

    public function getPostBySlug(Post $post)
    {  

        $query = "SELECT * FROM {$this->table} WHERE slug = :slug AND status = '1'";
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

        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $post;
    }


    public function DetetePostById(Post $post)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);

    }

    public function AddPost(Post $post)
    {


        $query = "INSERT INTO {$this->table} (/* title, */ author ,content, status, slug,image_path) VALUES (/* :title, */ :author , :content, :status, :slug, :image_path)";
        $params = [
            //'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'content' => $post->getContent(),
            'status' => $post->getStatus(),
            'slug' => $post->getSlug(),
            'image_path' => $post->getImage_path()
        ];
        $statement = $this->db->query($query, $params);
    }

    public function updatePost(Post $post)
    {

        $query = "UPDATE {$this->table} SET /* title = :title, */ author = :author, content = :content, status = :status, slug = :slug ,image_path = :image_path WHERE id = :id";
        $params = [
            //'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'content' => $post->getContent(),
            'status' => $post->getStatus(),
            'slug' => $post->getSlug(),
            'id' => $post->getId(),
            'image_path' => $post->getImage_path()
        ];
        $statement = $this->db->query($query, $params);
    }


    public function pendingPost(Post $post)
    {

        $query = "UPDATE {$this->table} SET status = '5' WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
    }

    public function publishPost(Post $post)
    {

        $query = "UPDATE {$this->table} SET status = '1' WHERE id = :id";
        $params = [
            'id' => $post->getId()
        ];
        $statement = $this->db->query($query, $params);
    }
   
}