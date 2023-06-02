<?php
namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Core\Error;
use App\Core\Security;
use App\Core\Database;
use PDO;
use Exception;

class PostService  extends Database 
{
    private $postRepo;

    public function __construct()
    {
        $this->postRepo = new PostRepository();
    }

    public function getAllsposts()
    {
        return $this->postRepo->getAllPosts();
    }

    public function getPostBySlug(Post $post)
    {   
        return $this->postRepo->getPostBySlug($post);
    }

    public function DetetePostById(Post $post)
    {   
        return $this->postRepo->DetetePostById($post);
    }

    public function AddPost(Post $post)
    {   
        return $this->postRepo->AddPost($post);
    }

    public function updatePost(Post $post)
    {   
        return $this->postRepo->updatePost($post);
    }

    public function getPostById(Post $post)
    {   
        return $this->postRepo->getPostById($post);
    }
}