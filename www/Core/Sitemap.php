<?php
namespace App\Core;

use App\Core\View;
use App\Repositories\ArticleRepository;
use App\Repositories\PostRepository;




class Sitemap
{
    public function generate()
    {
        $view = new View("Sitemap/sitemap", "sitemap");
        $view->assign("articles", $this->getArticles());
        $view->assign("posts", $this->getPosts());
    }

    private function getArticles()
    {
        $articleRepository = new ArticleRepository();
        return $articleRepository->findAllActive() ?? [];
    }

    private function getPosts()
    {
        $postRepository = new PostRepository();
        return $postRepository->getAllPostsActive() ?? [];
    }
}
