<?php
namespace App\Controllers;


use App\Core\Error;
use App\Core\Security;
use App\Core\Mail;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Core\View;
use App\Core\Database;
use App\Services\ArticleService;
use App\Core\Session;
use App\Core\Menu;
use App\Services\CommentService;
use App\Services\UserService;
use App\Services\PostService;
use App\Repositories\Pluggins\IpRepository;
use App\Repositories\FrontRepository;
use App\Models\Front;




class AdminController
{
    private $article ;
    private $commentService;
    private $userService;
    private $error;
    private $menu;
    private $page ;
    private $ip;

    public function __construct()
    {
        $this->article = new ArticleService();
        $this->commentService =new CommentService(new Error());
        $this->userService = new UserService(new Error());
        $this->error = new Error();
        $this->menu = new Menu();
        $this->page = new PostService();
        $this->ipRepo = new IpRepository();
        
    }

    public function index()
    {
        $userAll = $this->userService->getAllUser();
        $articleAll = $this->article->findAll();
        $commentAll = $this->commentService->findAll();
        $menu = $this->menu->getAllLink();
        $page = $this->page->getAllsposts();


        $usersRemoved = $this->userService->getAllUserRemoved();
        $userAct = $this->userService->getAllUserAct();
        $userPend = $this->userService->getAllUserPending();
        $userOnline = $this->userService->getAllUserOnline();

        $ip = $this->ipRepo->getAllIp();

        $view = new View("Backend/index", "back");
        $view->assign('users', $userAll);
        $view->assign('usersRemoved', $usersRemoved);
        $view->assign('userPend', $userPend);
        $view->assign('userAct', $userAct);
        $view->assign('userOnline', $userOnline);
        $view->assign('articles', $articleAll);
        $view->assign('comments', $commentAll);
        $view->assign('menus', $menu);
        $view->assign('pages', $page);
        $view->assign('ip', $ip);
        
   
    }
    public function template(){
        $view = new View("Backend/template", "back");

        if(isset($_POST['submit'])){
            $front = new Front();
            $front->setTemplate($_POST['template']);
            $front->setId(1);
            $frontRepo = new FrontRepository();
            $frontRepo->changeTemplate($front);

        }
    }

}