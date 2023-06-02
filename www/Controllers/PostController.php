<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Post;
use App\Services\PostService;
use App\Repositories\PostRepository;
use App\Core\Database;
use App\Core\Error;

class PostController 
{
    public function showPost()
    {   $post = new Post();
        $post->setSlug($_POST['slug']);

        $postService = new PostService();
        //var_dump($postService);
        $posts = $postService->getPostBySlug($post);
        var_dump($posts);
        die;
        
    }

}