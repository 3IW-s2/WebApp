<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Front;
use App\Repositories\FrontRepository;
use App\Core\Error;

class FrontController
{
    private $error;
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
        if(isset($_POST['submit']))
        {
            $view = new View("Backend/Front/edit", "back");
            $error2 = new Error();

            $fontRepository = new FrontRepository();
            $front = new Front();
            $Oldfront = $fontRepository->getFrontManagement();

            $front->setFont($_POST['font']);
            $front->setFontWeight($_POST['font_weight']);
            $front->setPrimaryColor($_POST['primary_color']);
            $front->setLogo($_FILES['logo']['name'] ?? $Oldfront['logo']);
            $front->setId($_GET['id']);

            if(isset($_FILES['logo']))
            {

                $tmpName = $_FILES['logo']['tmp_name'];
                $name = $_FILES['logo']['name'];
                $size = $_FILES['logo']['size'];
                $error = $_FILES['logo']['error'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                $extensions = ['jpg', 'png', 'jpeg'];
                $maxSize = 2000000;

                if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                    move_uploaded_file($tmpName, './public/upload/'.$name);
                }
                else{
                    $error2->addError("Une erreur est survenue lors de l'upload de l'image");
                }

            }

            $fontRepository->updateFrontManagement($front);

            //check if error or success
            if($error2->hasErrors()){
                $view->assign("errors", $error2->getErrors());
            }
            else{
                $view->assign("success", "Front modifié avec succès");
            }

            header("Location: /admin/front/edit");

        }

    }
}