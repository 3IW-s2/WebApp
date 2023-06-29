<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Front;
use App\Repositories\FrontRepository;
use App\Core\Error;

class FrontController
{
    private $error ;
    public function __construct()
    {
        $this->error = new Error();
    }

    public function getFront()
    {
        $fontRepository = new FrontRepository();
        $front = $fontRepository->getFrontManagement();
        $view = new View("Backend/Front/edit", "back");
        $view->assign("front", $front);

    }

    public function updateFront()
    {
        if(isset($_POST['submit'])){

            $fontRepository = new FrontRepository();
            $front = new Front();

            $front->setFont($_POST['font']);
            $front->setFontWeight($_POST['font_weight']);
            $front->setPrimaryColor($_POST['primary_color']);
            $front->setLogo($_POST['logo']);
            $front->setId($_GET['id']);
            $fontRepository->updateFrontManagement($front);

            header("Location: /admin/front/edit");
        }

    }
}